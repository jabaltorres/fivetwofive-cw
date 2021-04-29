<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1b10295a90c7faaa17f00f3f821bb1dc
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Fivetwofive\\FivetwofiveTheme\\' => 29,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Fivetwofive\\FivetwofiveTheme\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Fivetwofive\\FivetwofiveTheme\\Config\\Config' => __DIR__ . '/../..' . '/inc/Config/Config.php',
        'Fivetwofive\\FivetwofiveTheme\\Config\\Typography' => __DIR__ . '/../..' . '/inc/Config/Typography.php',
        'Fivetwofive\\FivetwofiveTheme\\Customize\\Customize' => __DIR__ . '/../..' . '/inc/Customize/Customize.php',
        'Fivetwofive\\FivetwofiveTheme\\Customize\\Customize_Select2_Control' => __DIR__ . '/../..' . '/inc/Customize/Customize_Select2_Control.php',
        'Fivetwofive\\FivetwofiveTheme\\Icons\\Icons' => __DIR__ . '/../..' . '/inc/Icons/Icons.php',
        'Fivetwofive\\FivetwofiveTheme\\Init' => __DIR__ . '/../..' . '/inc/Init.php',
        'Fivetwofive\\FivetwofiveTheme\\Interfaces\\Component_Interface' => __DIR__ . '/../..' . '/inc/Interfaces/Component_Interface.php',
        'Fivetwofive\\FivetwofiveTheme\\Interfaces\\Templating_Component_Interface' => __DIR__ . '/../..' . '/inc/Interfaces/Templating_Component_Interface.php',
        'Fivetwofive\\FivetwofiveTheme\\Post\\Post' => __DIR__ . '/../..' . '/inc/Post/Post.php',
        'Fivetwofive\\FivetwofiveTheme\\Styles\\CSS' => __DIR__ . '/../..' . '/inc/Styles/CSS.php',
        'Fivetwofive\\FivetwofiveTheme\\Styles\\Styles' => __DIR__ . '/../..' . '/inc/Styles/Styles.php',
        'Fivetwofive\\FivetwofiveTheme\\Template\\Template' => __DIR__ . '/../..' . '/inc/Template/Template.php',
        'Fivetwofive\\FivetwofiveTheme\\Template_Tags' => __DIR__ . '/../..' . '/inc/Template_Tags.php',
        'Fivetwofive\\FivetwofiveTheme\\Theme\\Theme' => __DIR__ . '/../..' . '/inc/Theme/Theme.php',
        'Fivetwofive\\FivetwofiveTheme\\Widgets\\Widgets' => __DIR__ . '/../..' . '/inc/Widgets/Widgets.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1b10295a90c7faaa17f00f3f821bb1dc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1b10295a90c7faaa17f00f3f821bb1dc::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1b10295a90c7faaa17f00f3f821bb1dc::$classMap;

        }, null, ClassLoader::class);
    }
}
