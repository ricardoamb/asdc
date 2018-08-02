<?php
/**
 * @package AgenciaSentapuaTheme
 */

defined( 'ABSPATH' ) or die ( file_get_contents ( 'templates/errors/unauthorized.html') );

load_theme_textdomain('sentapua', get_template_directory() . '/languages');

if ( file_exists( get_template_directory() . '/Sentapua/RequiredBase.php' ) )
{

	require_once 'Sentapua/RequiredBase.php';

	// Check if the Advanced Custom Fields Plugin is Installed and Active and the PHP version is 7 at least
	if ( function_exists('acf_add_options_page') && phpversion() > 7  )
	{
		if ( version_compare( $GLOBALS['wp_version'], '4.9.7', '<' ) ) {
			errors ( __( 'Wordpress Version Deprecated' , 'sentapua' ) , __( '<strong>The Wordpress version in use is deprecated.</strong><br>The Theme needs at least of the version 4.9.7 of Wordpress to work properly.' , 'sentapua' ) );
			admin_notice(
				__( 'Wordpress Version Deprecated' , 'sentapua' ) ,
				__( 'Wordpress Version Deprecated' , 'sentapua' ) ,
				__( '<strong>The Wordpress version in use is deprecated.</strong><br>The Theme needs at least of the version 4.9.7 of Wordpress to work properly.' , 'sentapua' ) ,
				__( 'Update your Wordpress or contact your developer.')
			);
		}else{
			// If is all ok to run the system
			if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) )
			{
				require_once dirname( __FILE__ ) . '/vendor/autoload.php';

				if ( class_exists( 'SentapuaTheme\\Init' ) )
				{
                    SentapuaTheme\Init::Start();

					require 'updater/plugin-update-checker.php';

					$SentapuaUpdateChecker = Puc_v4_Factory::buildUpdateChecker(

						'https://github.com/ricardoamb/asdc/',
						__FILE__,
						'asdc'

					);

					//Optional: If you're using a private repository, specify the access token like this:
					//$SentapuaUpdateChecker->setAuthentication('02f00b1f01ff56f41637692e8cb17550b75801a3');

					//Optional: Set the branch that contains the stable release.
					$SentapuaUpdateChecker->setBranch('stable');
					$SentapuaUpdateChecker->checkForUpdates();

				}

			}else{
				if ( ! is_admin() ) errors( __('Autoload Missing' , 'sentapua') , __( 'The current Autoload file is missing.<br>Contact the <strong>Support</strong>.' , 'sentapua' ) );
			}
		}
	}else{
		if ( function_exists( 'acf_add_options_page' ) )
		{
			// Verify the PHP Version ( 7 Plus is required )
			if ( phpversion() < 7 )
			{
				if ( ! is_admin() ) errors ( __( 'PHP Version Deprecated' , 'sentapua' ) , __( '<strong>The PHP version in use is deprecated.</strong><br>The System needs at least of the version 7.0 to work properly.' , 'sentapua' ) );

				admin_notice(
					__( 'PHP Version Deprecated' , 'sentapua' ) ,
					__( 'PHP Version Deprecated' , 'sentapua' ) ,
					__( '<strong>The PHP version in use is deprecated.</strong><br>The System needs at least of the version 7.0 to work properly.' , 'sentapua' ) ,
					__( 'Update your PHP at your server or contact your host service.')
				);
			}
		}else{
			// Print the install of required plugin and go away
			if ( ! is_admin() ) errors( __( 'Required Plugin Missing' , 'sentapua' ) , __("One or more plugins are required to properly run this theme and it's missing.<br>Please install it in administrative area." , 'sentapua' ) );
			sentapua_require_plugins();

		}
	}
}

