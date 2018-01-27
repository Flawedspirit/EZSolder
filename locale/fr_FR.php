<?php 

return array(
    'rtl'               => false, // Not currently used. It's on the to do list! Possibly.
    'subtitle'          => "&quot;Parce que vous pr&eacute;f&eacute;rez <em>jouer</em> &agrave; votre paquet du modification.&quot;",
    'introduction'      => "<strong>Welcome to EZSolder!</strong>%sThere are just a couple things to go over. First up, this application is provided &quot;as-is&quot; without warranty of any kind, whether express or implied.%sSecond, I of course make sure the program doesn't delete your files or kill your database, but you should make a backup of your Solder database and repository <em>before</em> using EZSolder, to make sure it works properly for your setup. I cannot be held liable for possible damages this application may cause. In short, <em>caveat utilitor</em>.%sAnd finally, this application uses cookies. They cannot be used to track or identify you in any way; they're just here to enable some basic housekeeping functions.%s",
    'err_not_writable'  => "The repository at <strong>%s</strong> is not writable by this application. You must fix this before EZSolder will function properly.",
    'err_repo_format'   => "The Solder repository path supplied in your configuration file must include a trailing forward slash.",
    'err_database_con'  => "(%s) Unable to connect to the database: %s",
    'warning_debug_on'  => "Debug mode is currently <strong>on</strong>. If this application is running in a production environment, it is recommended you set this option to false.",
    'warning_app_mode'  => "The upload_only flag is currently set to <strong>true</strong>. If this application is running in a production environment, it is recommended you set this option to false.",
    'warning_no_locale' => "No locale file for <strong>%s</strong> is currently available. Falling back to %s.",
    'warning_no_fallbk' => "The primary and fallback locale files are both missing or damaged. Falling back to en_US as a last resort.",
    'help_new_only'     => "Doit &ecirc;tre entr&eacute; si vous ajoutez un <strong>nouveau</strong> mod au le d&eacute;p&ocirc;t.",
    'help_dest'         => "Si autre a &eacute;t&eacute; s&eacute;lectionn&eacute; ci dessus, entrez un nom de r&eacute;pertoire; e.g. liteconfig, resourcepacks, etc.",
    'help_required'     => "Doit <strong>toujours</strong> &ecirc;tre entr&eacute;.",
    'help_repo'         => "Ceci peut &ecirc;tre chang&eacute; dans le fichier de configuration.",
    'label_repo'        => "Le r&eacute;pertoire de Solder",
    'label_name'        => "Nom du mod",
    'label_author'      => "Auteur(s) du mod",
    'label_slug'        => "Slug du mod",
    'label_version'     => "Version mod",
    'label_files'       => "T&eacute;l&eacute;charger un fichier",
    'label_dest'        => "Destination",
    'label_dest_other'  => "autre",
    'button_upload'     => "T&eacute;l&eacute;charger",
    'button_reset'      => "Nettoyer",
    'button_return'     => "Upload Another",
    'debug_mkdir_err'   => "Could not create directory for uploaded file: %s",
    'debug_zip_err'     => "Could not pack uploaded files in zip file: %s",
    'debug_is_zip'      => "Uploaded file is already a zip file. File transferred to %s.",
    'debug_is_not_zip'  => "Uploaded file is not a zip file. File transferred to temporary directory %s for processing.",
    'debug_php_no_zip'  => "The zip extension is not loaded on this server.",
    'debug_no_src_file' => "The source file at %s could not be found.",
    'debug_zip_saved'   => "Zip archive saved as %s.",
    'debug_upload_only' => "The upload_only flag is currently set to <strong>true</strong>. No changes have been made to the database.",
    'debug_db_err'      => "There was a problem updating the database: %s",
    'success_msg'       => "The mod has been successfully packaged and uploaded to your Solder repository.",
    'success_db'        => "The Solder database has been updated successfully."
);

?>