<?php
/**
 * @package SentapuaTheme
 */

namespace SentapuaTheme\Theme;

class Filters extends ThemeBaseController
{

    public function register()
    {

        add_filter( 'mime_types', [ $this , 'sentapua_mimes' ] );

    }

    function sentapua_mimes( $existing_mimes )
    {

        $existing_mimes['json'] = 'text/json';
        $existing_mimes['lic'] = 'text/lic';

        return $existing_mimes;

    }

}