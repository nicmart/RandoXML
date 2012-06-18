<?php
/**
 * Set up the class autoloader
 */
spl_autoload_register(function ($class) {
    if (0 === strpos(ltrim($class, '/'), 'nicmart\Random')) {
        if (file_exists($file = __DIR__.'/../'.substr(str_replace('\\', '/', $class), strlen('nicmart\Random')).'.php')) {
            require_once $file;
        }
    }
});