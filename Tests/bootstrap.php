<?php

$vendorDir = __DIR__.'/../../../../../vendor';
require_once $vendorDir.'/symfony/src/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();

$loader->register();

spl_autoload_register(function($class)
{
    $path = __DIR__;
    if (0 === strpos($class, 'Kwattro\\MarkdownBundle\\')) {
        $path = implode('/', array_slice(explode('\\', $class), 2)).'.php';
        require_once __DIR__.'/../'.$path;
        return true;
    }
});

?>