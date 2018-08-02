<?php
/**
 * @package SentapuaTheme
 */

namespace SentapuaTheme\Theme\App;

use SentapuaTheme\Theme\ThemeBaseController;

class License extends ThemeBaseController
{

    public function register()
    {

        $this->register_common_license();

    }

    function common_license($content = [])
    {
        // Data
        $slug = $content['slug'];
        $key = $content['key'];
        $domain_prefix = [ 'http://' , 'https://' , 'http://www.' , 'https://www.' ];
        $domain = str_replace( $domain_prefix , "" , site_url() );
        $base = base64_decode('aHR0cDovL2FnZW5jaWFzZW50YXB1YS5jb20uYnIvd3AtanNvbi93cC92Mi9saWNlbmNhcz9zbHVnPQ==') . $slug;
        $src = json_decode ( file_get_contents( $base ) , true );
        if ( count($src) != 0 || count($src) > 1 ) {
            $project = $src[0];
            $src_slug = $project['slug'];
            $src_url = str_replace( $domain_prefix , "" , $project['acf']['project_url'] );
            $src_key = $project['acf']['project_key'];
            $src_expiration = $project['acf']['license_expiration'];
            $src_status = $project['acf']['project_status'];
            if ( $slug == $src_slug && $domain == $src_url ) {
                if ( $slug == $src_slug && $key == $src_key ){
                    if  ($slug == $src_slug && intval($src_expiration) >= intval(date('Ymd')) ) {
                        if ( $src_status !== 'active' && $src_status == 'suspended' ){
                            if ( ! is_admin() ) {
                                if ( $GLOBALS['pagenow'] != 'wp-login.php' ) {
                                    $this->get_construction_page(true);
                                }
                            }else{
                                add_action('admin_notices', [ $this , 'sentapua_admin_suspended_notice' ] );
                            }
                        }
                    }else{
                        if ( ! is_admin() ) {
                            if ( ! is_user_logged_in() ) {
                                if ( $GLOBALS['pagenow'] != 'wp-login.php' ) {
                                    $this->get_construction_page();
                                }
                            }
                        }else{
                            add_action('admin_notices', [ $this , 'sentapua_admin_expired_notice' ] );
                        }
                    }
                }else{
                    if ( ! is_admin() ) {
                        if ( ! is_user_logged_in() ) {
                            if ( $GLOBALS['pagenow'] != 'wp-login.php' ) {
                                $this->get_construction_page();
                            }
                        }
                    }else{
                        add_action('admin_notices', [ $this , 'sentapua_admin_invalid_notice' ] );
                    }
                }
            }else{
                if ( ! is_admin() ) {
                    if ( ! is_user_logged_in() ) {
                        if ( $GLOBALS['pagenow'] != 'wp-login.php' ) {
                            $this->get_construction_page();
                        }
                    }
                }else{
                    add_action('admin_notices', [ $this , 'sentapua_admin_url_notice' ] );
                }
            }
        }else{
            if ( ! is_admin() ) {
                if ( ! is_user_logged_in() ) {
                    if ( $GLOBALS['pagenow'] != 'wp-login.php' ) {
                        $this->get_construction_page();
                    }
                }
            }else{
                add_action('admin_notices', [ $this , 'sentapua_admin_invalid_notice' ] );
            }
        }
        return true;
    }

    private function register_common_license()
    {
        $file = get_field( 'sentapua_license_key' , 'option' );
        if ( $file != null || $file != '' )
        {
            $license_file = get_field('sentapua_license_key','option');
            $content = json_decode(base64_decode(file_get_contents($license_file['url'])),true);
            $this->common_license($content);
        }else{
            if ( ! is_admin() ) {
                if ( ! is_user_logged_in() ) {
                    if ( $GLOBALS['pagenow'] != 'wp-login.php' ) {
                        $this->get_construction_page();
                    }
                }
            }else{
                add_action('admin_notices', [ $this , 'sentapua_admin_construction_notice' ] );
            }
        }
    }

    private function get_construction_page($suspended = false)
    {

        switch (get_bloginfo('language')){
            case 'pt-BR':
                $locale = get_bloginfo('language');
                break;
            case 'en-US';
                $locale = get_bloginfo('language');
                break;
            default:
                $locale = 'en-US';
                break;
        }

        if ( ! $suspended ) {
            die ( file_get_contents($this->theme_url . 'Sentapua/Theme/App/ConstructionPage/construction_page_' . $locale . '.html') );
        }else{
            die ( file_get_contents($this->theme_url . 'Sentapua/Theme/App/ConstructionPage/suspended_' . $locale . '.html') );
        }

    }

    function sentapua_admin_construction_notice()
    {
        echo '<div class="notice notice-warning" style="padding-top:10px;">' .
            '<strong style="font-size:120%;">' . __('Missing License','sentapua') . '</strong>' .
            '<p>' .
            __('The theme created by <strong>Sentapua Agency</strong> is properly installed, but the license file was not found.' , 'sentapua') .
            __('<br>For the total operation of the website the license file must be selected in <strong>Theme Options > Licenses</strong>.','sentapua') . '</p>' .
            '<p>'. __('The current Website will show the message <strong>"Under Construction"</strong> until the license file selection.','sentapua') . '</p>' .
            '</div>';
    }

    function sentapua_admin_invalid_notice()
    {
        echo '<div class="notice notice-error" style="padding-top:10px;">' .
            '<strong style="font-size:120%;">' . __('Invalid License','sentapua') . '</strong>' .
            '<p>' .
            __('The theme created by <strong>Sentapua Agency</strong> is properly installed, but the license in use is invalid.' , 'sentapua') .
            __('<br>For the total operation of the website the license must be updated in <strong>Theme Options > Licenses</strong>.','sentapua') . '</p>' .
            '<p>'. __('The current Website will show the message <strong>"Under Construction"</strong> until the license update.','sentapua') . '</p>' .
            '</div>';
    }

    function sentapua_admin_url_notice()
    {
        echo '<div class="notice notice-error" style="padding-top:10px;">' .
            '<strong style="font-size:120%;">' . __('Invalid License For This URL','sentapua') . '</strong>' .
            '<p>' .
            __('The theme created by <strong>Sentapua Agency</strong> is properly installed, but the license in use owns another URL.' , 'sentapua') .
            __('<br>For the total operation of the website the license URL must be updated by <strong>Theme Developer</strong>.','sentapua') . '</p>' .
            '<p>'. __('The current Website will show the message <strong>"Under Construction"</strong> until the license update.','sentapua') . '</p>' .
            '</div>';
    }

    function sentapua_admin_expired_notice()
    {
        echo '<div class="notice notice-error" style="padding-top:10px;">' .
            '<strong style="font-size:120%;">' . __('Expired License','sentapua') . '</strong>' .
            '<p>' .
                __('The theme created by <strong>Sentapua Agency</strong> is properly installed, but the license has been expired.' , 'sentapua') .
                __('<br>For the total operation of the website the license must be updated in <strong>Theme Options > Licenses</strong>.','sentapua') . '</p>' .
            '<p>'. __('The current Website will show the message <strong>"Under Construction"</strong> until the license update.','sentapua') . '</p>' .
            '</div>';
    }

    function sentapua_admin_suspended_notice()
    {
        echo '<div class="notice notice-error" style="padding-top:10px;">' .
            '<strong style="font-size:120%;">' . __('License And Website Suspended','sentapua') . '</strong>' .
            '<p>' .
            __('The theme created by <strong>Sentapua Agency</strong> is properly installed, but the license and the website use is suspended.' , 'sentapua') .
            __('<br>Contact the developer for more information about this error.','sentapua') . '</p>' .
            '<p>'. __('The current Website will show a <strong>"Suspension"</strong> message until the license update.','sentapua') . '</p>' .
            '</div>';
    }

}