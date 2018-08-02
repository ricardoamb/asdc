<?php
/**
 * @package SentapuaTheme
 */

namespace SentapuaTheme\Theme;

class OptionsPages extends ThemeBaseController
{

    public function register()
    {

        $this->general_options();

    }

    private function general_options()
    {

        if( function_exists('acf_add_options_page') && file_exists( $this->theme_path . 'Sentapua/Theme/CustomFields/general_options.php' ) ) {

            acf_add_options_page(
                [
                    'page_title'    => __( 'Sentapua Agency General Options' , 'sentapua' ),
                    'menu_title'    => __( 'Theme Options' , 'sentapua' ),
                    'menu_slug'     => 'sentapua_general_options',
                    'capabilities'  => 'edit_posts',
                    'redirect'      => false,
                    'icon_url'      => 'dashicons-smiley'
                ]
            );

            require_once $this->theme_path . 'Sentapua/Theme/CustomFields/general_options.php';

        }

    }

}