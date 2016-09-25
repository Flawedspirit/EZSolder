<?php

return array(

/*
|------------------------------------------------------------------------------
| Base URL
|------------------------------------------------------------------------------
|
| This is used by the application to properly generate URLs. You should set
| this to the root of your application. If this is not set, EZSolder will
| attempt to detect it by itself.
|
 */

'url' => '',

/*
|------------------------------------------------------------------------------
| Debug Mode
|------------------------------------------------------------------------------
|
| Set this to true to enable debug mode. When debug mode is enabled, error
| messages will show detailed errors and stack traces. If disabled, a generic
| error message is shown.
|
| NOTICE: This setting may represent a security risk. Make sure it is set to
|         false in a production environment.
|
 */

'debug' => false,

/*
|------------------------------------------------------------------------------
| Upload Only
|------------------------------------------------------------------------------
|
| If set to true, the application will upload the file and place it in the
| desired directory, but will not update the database.
|
| NOTICE: This setting may represent a security risk. Make sure it is set to
|         0 in a production environment.
|
 */

'upload_only' => false,

/*
|------------------------------------------------------------------------------
| Application Locale
|------------------------------------------------------------------------------
|
| This determines the desired locale that will be used by the localization
| service. At this time, the only locale supported is 'en_US', at least until
| more translations are completed.
|
| For more information, send me a message at admin@flawedspirit.com!
|
 */

'locale' => 'en_US',

/*
|------------------------------------------------------------------------------
| Fallback Locale
|------------------------------------------------------------------------------
|
| This is the locale that the application will fall back on if the desired
| locale file is missing. If the fallback is also missing, the application
| will not function and you will have to re-download it.
|
 */

'fallback_locale' => 'en_US',

/*
|------------------------------------------------------------------------------
| Solder Repository
|------------------------------------------------------------------------------
|
| This is the path to where Solder expects the Minecraft resource files to
| be. Please use the absolute path from the root of your webserver. Also make
| sure the group responsible for operating your webserver (usually www-data)
| has write permissions to the Solder repository.
|
| NOTICE: You must INCLUDE a trailing slash.
|
 */

'repository' => '',

/*
|------------------------------------------------------------------------------
| File Mode
|------------------------------------------------------------------------------
|
| The permission to assign new files. It is best to leave this setting as
| its default unless you know what you're doing.
|
 */

'file_mode' => 0644,

/*
|------------------------------------------------------------------------------
| Directory Mode
|------------------------------------------------------------------------------
|
| The permission to assign new directories. It is best to leave this setting
| as its default unless you know what you're doing.
|
 */

'dir_mode' => 0775,

/*
|------------------------------------------------------------------------------
| Database
|------------------------------------------------------------------------------
|
| This is where the database connection is set up. Currently, the only
| database supported is mysql.
|
| If you opted to use table prefixes when you installed Solder, make sure to
| enter it here.
|
 */

'database' => array(
    'hostname' => 'localhost',
    'database' => '',
    'username' => '',
    'password' => '',
    'prefix'   => ''
)

);

?>