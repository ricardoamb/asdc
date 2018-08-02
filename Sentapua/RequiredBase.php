<?php
/**
 * @package SentapuaTheme
 */

$admin_notice_args = [
	'error' => '',
	'title' => '',
	'message' => '',
	'solution' => ''
];

function errors( $title = null , $message = null , $type = 'error' )
{
    if ( ! is_admin() ) {
        // Select the template color
        switch ($type) {
            case 'error':
                $color = '#dc3545';
                break;
            case 'warning':
                $color = '#ffc107';
                break;
            default:
                $color = '#17a2b8';
        }
        $msg = '<div style="text-align:center;color:#333;">' .
            '<img src="https://ricardoamb.github.io/sentapua_error_logo.png" alt="Agência Sentapúa" style="width:300px;height:auto;"/>' .
            '<h2 style="padding-top:20px;border-top:5px solid ' . $color . ';color:' . $color . ';">' . $title . '</h2>' .
            '<p style="color:#333;padding:20px 10% 0 10%;">' . $message . '</p>' .
            '</div>';
        if ( $title !== null && $message !== null ) {
            wp_die( $msg , $title);
        } else {
            $title = __( 'Unexpected Error' , 'sentapua' );
            $message = __( 'An unexpected error occurred. Please verify.' , 'sentapua' );
            wp_die ('<div style="text-align:center;color:#333;">' .
                '<img src="https://ricardoamb.github.io/sentapua_error_logo.png" alt="Agência Sentapúa" style="width:300px;height:auto;"/>' .
                '<h2 style="padding-top:20px;border-top:5px solid ' . $color . ';color:' . $color . ';">' . $title . '</h2>' .
                '<p style="color:#333;padding:20px 10% 0 10%;">' . $message . '</p>' .
                '</div>' , $title);
        }
    }
}

function admin_notice( $error = null , $title = null , $message , $solution = null)
{

	// Select the template color
	switch ($type) {
		case 'error':
			$color = '#dc3545';
			break;
		case 'warning':
			$color = '#ffc107';
			break;
		default:
			$color = '#17a2b8';
	}

	global $admin_notice_args;
	$admin_notice_args['message'] = $message;
	$admin_notice_args['title'] = $title;
	$admin_notice_args['error'] = $error;
	$admin_notice_args['solution'] = $solution;

	add_action('admin_notices', 'show_admin_notice');

}

function show_admin_notice ()
{
	global $admin_notice_args;
	echo '<div class="notice notice-error">' .
	     '<h3 class="error-message" style="font-size:120%;">' . $admin_notice_args['title'] . '</h3>' .
	     '<strong class="error-message">Erro: </strong>' . $admin_notice_args['message'] . '<br>' .
	     '<p style="padding-bottom: 10px;">' . $admin_notice_args['solution'] . '</p>' .
	     '</div>';
}

function sentapua_require_plugins () {

   if ( file_exists( get_template_directory() . '/Sentapua/RequiredPlugins.php' ) )
   {

       require_once get_template_directory() . '/Sentapua/RequiredPlugins.php';

   }

}

function sentapua_get_link() {
    return '<a href="http://agenciasentapua.com.br"><strong>' . __('Sentapua Agency','sentapua') . '</strong></a>';
}