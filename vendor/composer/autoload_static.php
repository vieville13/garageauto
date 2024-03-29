<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6d79bf6ad6fea2b699c07bafc0a2a3ce
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Root\\Garageauto\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Root\\Garageauto\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6d79bf6ad6fea2b699c07bafc0a2a3ce::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6d79bf6ad6fea2b699c07bafc0a2a3ce::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6d79bf6ad6fea2b699c07bafc0a2a3ce::$classMap;

        }, null, ClassLoader::class);
    }
}
