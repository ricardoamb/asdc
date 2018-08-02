<?php
/**
 * @package SentapuaTheme
 */

namespace SentapuaTheme;

class Init
{

    public static function get_services()
    {
        return [
        	Theme\App\Update::class,
			Theme\Enqueue::class,
			Theme\Setup::class,
	        Theme\App\Config::class,
            Theme\Filters::class,
            Theme\App\License::class,
            Theme\OptionsPages::class,
        ];
    }

    /**
     * Loop through the classes, initialize them, and call the register() method if it exists
     */
    public static function Start()
    {

        foreach ( self::get_services() as $class)
        {

            $service = self::instantiate( $class );

            if ( method_exists( $service , 'register' ) ){
                $service->register();
            }

        }

    }

    /**
     * Initialize the class
     * @param $class - class from the $service array
     * @return mixed - return the new class instance
     */
    private static function instantiate( $class )
    {

        return new $class;

    }

}