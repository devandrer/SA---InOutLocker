<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd62c05482639d7b9ce3214a50429d1bc
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

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd62c05482639d7b9ce3214a50429d1bc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd62c05482639d7b9ce3214a50429d1bc::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
