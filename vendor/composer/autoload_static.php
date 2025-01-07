<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf158ca8491c76367e132f777222414f8
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitf158ca8491c76367e132f777222414f8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf158ca8491c76367e132f777222414f8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf158ca8491c76367e132f777222414f8::$classMap;

        }, null, ClassLoader::class);
    }
}
