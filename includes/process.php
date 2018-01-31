<?php

function throwException($err_no, $err_str, $err_file, $err_line) {
    $enabled_errors = (bool)($err_no & ini_get('error_reporting'));

    if(in_array($err_no, array(E_USER_ERROR, E_RECOVERABLE_ERROR)) && $enabled_errors) {
        throw new Exception($err_str, 0, $err_no, $err_file, $err_line);
    } elseif($enabled_errors) {
        error_log($err_str);
        return false;
    }
}
set_error_handler('throwException');

function outputErrorMessage($ex) {
    global $config;

    if($config['debug']) {
        logMessage(sprintf("%s %s in %s(%s)%s%s",
            $ex->getMessage(),
            error_get_last()['message'],
            $ex->getFile(),
            $ex->getLine(),
            '<span class="hr"></span><strong>Stack trace follows:</strong><br />',
            str_replace("\n", "<br />", $ex->getTraceAsString())),
        'error');
    } else {
        logMessage(sprintf("%s $s in %s(%s)",
            $ex->getMessage(),
            error_get_last()['message'],
            $ex->getFile(),
            $ex->getLine()),
        'error');
    }
}

$data = array(
    'path'           => $config["repository"],
    'modname'        => $_POST["modname"],
    'modauthor'      => $_POST["modauthor"],
    'modslug'        => $_POST["modslug"],
    'version'        => $_POST["modversion"],
    'mcversion'      => $_POST["mcversion"],
    'use_mcversion'  => isset($_POST["use-mc-version"]) ? true : false,
    'files'          => $_FILES["file"],
    'modtype'        => $_POST["type"],
    'otherfield'     => isset($_POST["otherfield"]) ? $_POST["otherfield"] : ""
);

if($config['debug']) {
    logMessage("<strong>Submitted POST Data:</strong><br />
        Path: {$data['path']}<br />
        Name: {$data['modname']}<br />
        Author: {$data['modauthor']}<br />
        Slug: {$data['modslug']}<br />
        Version: {$data['version']}<br />
        Version: {$data['mcversion']} (Use: {$data['use_mcversion']})<br />
        Destination: {$data['modtype']}<br />
        Other field: {$data['otherfield']}<br />"
    );
}

$final_path = $data['path'] . $data['modslug'] . '/';
$up_version = $data['version'];

if($data['modtype'] == "other") {
    $update = array('modtype' => $data['otherfield']);
    $data = array_merge($data, array_intersect_key($update, $data));
}

if($data['use_mcversion'] && !empty($data['mcversion'])) {
    $up_version = sprintf('mc%s-%s', $data['mcversion'], $data['version']);
}

// One last validation check.
if(empty($data['path']) ||
    empty($data['modslug']) ||
    empty($data['version']) ||
    empty($data['files'])) {
    // Somehow the jquery validation missed something.
    // This error should never be seen.
    logMessage('Invalid null fields detected. Path, modslug, version, and file cannot be null.', 'error', true);
}

try {
    makeDirectory($final_path);
    @chmod($final_path, $config['dir_mode']);
} catch(Exception $x) {
    outputErrorMessage($x);
}

try {
    if(!packageFiles($final_path)) throw new Exception(lang('debug_zip_err', true));
        if($config['upload_only']) logMessage(lang('debug_upload_only', true), 'info');

        // Everything went well with the file upload
        logMessage(lang('success_msg', true), 'success');
} catch(Exception $x) {
    outputErrorMessage($x);
}

try {
    if(update_db($db, $data, $final_path . $data['modslug'] . '-' . $up_version . '.zip'))
        // Everything went well with the database update
        logMessage(lang('success_db', true), 'success');
} catch(Exception $x) {
    outputErrorMessage($x);
}

function debug($exception) {
    return sprintf('%s<span class="hr"></span><strong>Stack trace follows:</strong><br />%s',
        $exception->getMessage(),
        $exception->getTraceAsString()
    );
}

function makeDirectory($path) {
    if(!is_dir($path)) {
        try {
            @mkdir($path);
        } catch(Exception $x) {
            outputErrorMessage($x);
        }
    }
}

$final_path = $data['path'] . $data['modslug'] . '/';

function packageFiles($path) {
    global $config, $data, $up_version;

    // If the file is already a zip file, simply move it to the proper directory
    // Zip file should start with 0x504b ("PK")
    $fhandle = fopen($data['files']['tmp_name'], "r");
    $metadata = fread($fhandle, 2);
    $file_name = sprintf('%s-%s.zip', $data['modslug'], $up_version);
    $file_out = $path . $file_name;

    if($metadata === "PK" && substr($data['files']['name'], -4) === ".zip") {
        try {
            if(!@move_uploaded_file($data['files']['tmp_name'], $file_out)) return false;
        } catch (Exception $x) {
            outputErrorMessage($x);
        }
    
        if($config['debug']) {
            logMessage(lang('debug_is_zip', true, $file_out));
        }
    } else {
        // Create a temporary path to hold the file while
        // the proper directory structure is built around it.
        $temp_path = $path . $data['modtype'] . '/';
        makeDirectory($temp_path);
        try {
            if(!@move_uploaded_file($data['files']['tmp_name'], $temp_path . $data['files']['name'])) return false;
        } catch (Exception $x) {
            outputErrorMessage($x);
        }

        if($config['debug']) {
            logMessage(lang('debug_is_not_zip', true, $temp_path));
        }

        try {
            @createZip($temp_path, $file_out, true);
        } catch (Exception $x) {
            outputErrorMessage($x);
        }

        fclose($fhandle);

        // Remove temp directory
        if(file_exists($temp_path)) {
            foreach (scandir($temp_path) as $file) {
                if($file == '.' || $file == '..') continue;
                unlink($temp_path . $file);
            }
            if(!rmdir($temp_path)) return false;
        }
    }

    if(file_exists($file_out)) {
        chmod($file_out, $config['file_mode']);
        return true;
    }
}

function createZip($src, $dst, $include_dir = false) {
    if(!extension_loaded('zip')) throw new Exception(lang('debug_php_no_zip', true));

    try {
        @file_exists($src);
    } catch (Exception $x) {
        outputErrorMessage(lang('debug_no_src_file', true, $src));
    }

    if(file_exists($dst)) {
        unlink($dst); //exception
    }

    $zip = new ZipArchive();
    if(!$zip->open($dst, ZIPARCHIVE::CREATE)) {
        return false;
    }

    if(is_dir($src)) {
        // The files we want are within a directory.
        // Go do the thing.
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($src),
            RecursiveIteratorIterator::SELF_FIRST
        );

        /*
        | If include_dir is set to true, this part is run
        | to include the file's parent directory.
        |
        | If it is false, the entire directory structure is
        | discarded and only the file is used.
        */
        if($include_dir) {
            $src = trim($src, '/');
            // Get name of parent directory of mod file.
            $dir_array = explode('/', $src);
            $parent_dir = $dir_array[count($dir_array) - 1];

            // Rebuild file path without the last directory
            $src = '/' . substr($src, 0, strrpos($src, '/') + 1);
            $zip->addEmptyDir($parent_dir);
        }

        // Add the file in directory to the zip file.
        foreach($files as $file) {
            // Ignore the . and .. files from a Unix-based filesystem.
            if(in_array(substr($file, strrpos($file, '/') + 1), array('.', '..'))) continue;

            $file = realpath($file);

            $zip->addFromString($parent_dir . '/' . basename($file), file_get_contents($file));
        }
    } else {
        // Source is file; just stream the file contents into a new zip file.
        $zip->addFromString(basename($src), file_get_contents($file));
    }

    if($config['debug']) logMessage(lang('debug_zip_saved', true, $dst));
    
    return $zip->close();
}

?>