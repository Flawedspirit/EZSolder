<?php if(!defined('INDEX')) die('Direct access is not allowed.');

class EZSolder {
    public static function init($config) {
        global $lang;
        /*
        | Performs a startup check of the application's environment.
        | Anything that should be brought to the attention of the user is placed
        | into an array of pending notices, which are then displayed to the user.
        |
        |------------------------------------------------------------------------------
        */
        if(!file_exists(INDEX . '/locale') || !(new FileSystemIterator(INDEX . '/locale'))->valid()) {
            // No language files exist AT ALL, so the app will DIAF.
            die('No language files exist!');
        } else {
            $lang = include INDEX . "/locale/" . $config['locale'] . '.php';
        }
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
    public static function lang($tag, $no_echo = false, $replace = '') {
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
    public static function logMessage($message, $level = "debug", $should_die = false) {
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
}

?>