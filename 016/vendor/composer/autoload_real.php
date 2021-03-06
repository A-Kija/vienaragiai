<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit1a5fdf7147d39778003ee5dfc5e6803e
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit1a5fdf7147d39778003ee5dfc5e6803e', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit1a5fdf7147d39778003ee5dfc5e6803e', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit1a5fdf7147d39778003ee5dfc5e6803e::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
