<?php if(!defined('INDEX')) die('Direct access not allowed.');

if($no_config == 1) logMessage('Cannot access the configuration file. This file is required for EZSolder to function. If you just installed this application, make sure you change the configuration settings to suit your needs and rename <strong>config.dist.php</strong> to <strong>config.php.</strong>', 'error', true);

global $db;

// The disclaimer that will show on first start
echo "<div id=\"disclaimer\" class=\"panel info\" style=\"display: none;\">";
echo "<span class=\"icon-info\"></span><p>";
echo lang('introduction', true,  array('<span class="hr"></span>', '<br /><br />', '<br /><br />', '<br /><br /><a id="btn-notice" href="#"><strong>Got it. Let\'s do this!</strong></a>'));
echo "</p></div>";

if($notices['err_no_locales']   == 1) logMessage("The locale files are all missing or damaged. Please re-download the application.", 'error', true);
if($notices['err_database_con'] == 1) logMessage(lang('err_database_con',  true,  array($db[1], $db[2])), 'error');
if($notices['err_not_writable'] == 1) logMessage(lang('err_not_writable',  true,  $config['repository']), 'error');
if($notices['err_repo_format']  == 1) logMessage(lang('err_repo_format',   true), 'error');
if($notices['warn_debug_on']    == 1) logMessage(lang('warning_debug_on',  true), 'warn');
if($notices['warn_no_db_calls'] == 1) logMessage(lang('warning_app_mode',  true), 'warn');
if($notices['warn_no_locale']   == 1) logMessage(lang('warning_no_locale', true,  array($config['locale'], $config['fallback_locale'])), 'warn');
if($notices['warn_no_fallbk']   == 1) logMessage(lang('warning_no_fallbk', true), 'warn');

?>
<div id="val-errors" class="panel error" style="display: none;"><p></p></div>