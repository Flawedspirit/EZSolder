<?php if(!defined('INDEX')) die('Direct access not allowed.');

/*
| Performs a startup check of the application's environment.
| Anything that should be brought to the attention of the user is placed
| into an array of pending notices, which are then displayed to the user.
|
|------------------------------------------------------------------------------
*/

$notices = array(
    'err_no_locales'   => 0,
    'err_not_writable' => 0,
    'err_repo_format'  => 0,
    'err_database_con' => 0,
    'warn_debug_on'    => 0,
    'warn_no_db_calls' => 0,
    'warn_no_locale'   => 0,
    'warn_no_fallbk'   => 0
);
$pending = array();
$autodetect = array();
$no_config = 0;

if(!file_exists('includes/config.php')) {
    $no_config = 1;
} else {
    $config = require 'config.php';

    /*
    | Validates the user's choices for language files, attempting the user's
    | primary, fallback, and finally the default en_US file in that order.
    */

    if(!file_exists('locale/') || !(new FilesystemIterator('locale/'))->valid()) {
        // No language files exist AT ALL, so the app will now DIAF.
        $pending['err_no_locales'] = 1;
    } else {
        if(!file_exists('locale/' . $config['locale'] . '.php')) {
            if(file_exists('locale/' . $config['fallback_locale'] . '.php')) {
                $pending['warn_no_locale'] = 1;
                $lang = include 'locale/' . $config['fallback_locale'] . '.php';
            } else {
                // The final way for the application to save itself.
                $pending['warn_no_fallbk'] = 1;
                $lang = include 'locale/en_US.php';
            }
        } else {
            // Desired file exists; load it into memory.
            $lang = include 'locale/' . $config['locale'] . '.php';
        }
    }

    if(!file_exists($config['repository']) || !is_writable($config['repository'])) {
        $pending['err_not_writable'] = 1;
    }

    if(substr($config['repository'], -1) !== '/') {
        $pending['err_repo_format'] = 1;
    }

    if($config['debug'] == true) {
        $pending['warn_debug_on'] = 1;
    }

    if($config['upload_only'] == true) {
        $pending['warn_no_db_calls'] = 1;
    }

    if(empty($config['url'])) {
        $autodetect['url'] = !empty($_SERVER['HTTPS']) ? 'https://' : 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    }

    $notices = array_merge($notices, array_intersect_key($pending, $notices));
    $config = array_merge($config, array_intersect_key($autodetect, $config));

    require_once 'database.php';
    $db = @db_connect();

}

/**
 * Returns a string based on the user's chosen locale.
 * @param  string   $tag     A tag used to select a particular string.
 * @param  boolean  $no_echo Whether the output should be echoed or 
 *                           returned to the calling function as a string.
 * @param  string[] $replace A string or array of strings to replace
 *                           wildcards in the file (%s).
 * @return string            The string value of the selected tag.
 */
function lang($tag, $no_echo = false, $replace = '') {
    global $lang;

    if($no_echo) return vsprintf($lang[$tag], $replace);
    echo vsprintf($lang[$tag], $replace);
}

/**
 * Logs a message to the current output stream.
 * @param  string  $message    A message to display.
 * @param  string  $level      A logging level.
 * @param  boolean $should_die Whether this message should halt program execution.
 */
function logMessage($message, $level = "debug", $should_die = false) {
    $levels = array(
        'debug'   => 'debug',
        'success' => 'success',
        'info'    => 'info',
        'warn'    => 'warning',
        'error'   => 'error'
    );

    echo sprintf("<div class=\"infobox %s\">", $levels[$level]);
    echo sprintf("<span class=\"icon-%s\"></span><p>%s</p>", $level, $message);
    echo '</div>';

    if($should_die) die();
}

?>