<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8e08b3dc7acf23a1beed5a22349d99d0
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8e08b3dc7acf23a1beed5a22349d99d0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8e08b3dc7acf23a1beed5a22349d99d0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8e08b3dc7acf23a1beed5a22349d99d0::$classMap;

        }, null, ClassLoader::class);
    }
}