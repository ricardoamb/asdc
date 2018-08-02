<?php
/**
 * @package SentapuaTheme
 */

if ( file_exists( get_template_directory() . '/Sentapua/Plugins/class-tgm-plugin-activation.php') )
{

    require_once get_template_directory() . '/Sentapua/Plugins/class-tgm-plugin-activation.php';

    add_action( 'tgmpa_register', 'sentapua_register_required_plugins' );

}

function sentapua_register_required_plugins()
{

    $plugins = [

        [
            'name'                  => 'Advanced Custom Fields Pro',
            'slug'                  => 'advanced-custom-fields-pro',
            'source'                => 'advanced-custom-fields-pro.zip',
            'required'              => true,
            'version'               => '5.7.1',
            'force_activation'      => true,
            'force_deactivation'    => true,
        ],
        [
            'name'                  => 'Elementor',
            'slug'                  => 'elementor',
            'required'              => true,
            'version'               => '2.1.5',
            'force_activation'      => true,
            'force_deactivation'    => true
        ],
        [
            'name'                  => 'Elementor Pro',
            'slug'                  => 'elementor-pro',
            'source'                => 'elementor-pro.zip',
            'required'              => false,
            'version'               => '2.0.18',
            'force_activation'      => true,
            'force_deactivation'    => true
        ],

    ];

    $config = [
        'id'            => 'sentapua-theme-plugins',     // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path'  => get_template_directory() . '/Sentapua/Plugins/lib/',
        'menu'          => 'tgmpa-install-plugins',      // Menu slug.
        'parent_slug'   => 'plugins.php',                // Parent menu slug.
        'capability'    => 'manage_options',             // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'   => true,                        // Show admin notices or not.
        'dismissable'   => false,                        // If false, a user cannot dismiss the nag message.
        'dismiss_msg'   => '<h3 style="margin: 0 0 15px 0;" class="error-message">Plugins do Tema</h3>',        // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic'  => false,
        'message'       => __( 'This is the list of all required and recommended plugins for the theme runs properly.' , 'sentapua' ) . '<br>',
        'strings'       => [
			'nag_type'                        => 'error', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		]
    ];

    tgmpa( $plugins, $config );

}