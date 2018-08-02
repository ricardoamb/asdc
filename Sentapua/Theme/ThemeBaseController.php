<?php
/**
 * @package SentapuaTheme
 */

namespace SentapuaTheme\Theme;

class ThemeBaseController
{

    public $theme_path;
    public $theme_url;

    public function __construct()
    {

        $this->theme_path = get_template_directory() . '/';
        $this->theme_url = get_stylesheet_directory_uri() . '/';

    }

}