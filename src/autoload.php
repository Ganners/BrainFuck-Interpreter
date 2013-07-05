<?php
/**
 * Our autoloader, based on namespace naming
 * conventions with folders this should auto
 * load any class that's called.
 */
function brainFuckAutoload($class) {
    $filePath = str_replace('\\', '/', $class);
    $file = __DIR__ . "/{$filePath}.php";
    require($file);
}

spl_autoload_register('brainFuckAutoload');