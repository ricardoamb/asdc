<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitca564dbc333ea6e7f082e41c48102471
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SentapuaTheme\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SentapuaTheme\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Sentapua',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitca564dbc333ea6e7f082e41c48102471::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitca564dbc333ea6e7f082e41c48102471::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}