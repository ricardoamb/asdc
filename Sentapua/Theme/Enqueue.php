<?php
/**
 * @package SentapuaTheme
 */

namespace SentapuaTheme\Theme;

class Enqueue extends ThemeBaseController
{

    public function register()
    {

        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue' ]);

    }

    function enqueue()
    {

        wp_register_style( 'sentapua-style', $this->theme_url . 'assets/css/style.css' , [] , '1.0.0' , 'all' );
        wp_enqueue_style('sentapua-style'); // Enqueue it!

        wp_register_script('conditionizr', $this->theme_url . 'assets/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('modernizr', $this->theme_url  . 'assets/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script( 'sentapua-script', $this->theme_url . 'assets/js/scripts.js' , [] , '1.0.0' , true );
        wp_enqueue_style('sentapua-script'); // Enqueue it!

    }

}