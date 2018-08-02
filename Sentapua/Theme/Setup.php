<?php
/**
 * @package SentapuaTheme
 */

namespace SentapuaTheme\Theme;

class Setup extends ThemeBaseController
{

    public function register()
    {

        add_action( 'after_setup_theme', [ $this, 'sentapua_setup' ]);

    }

    function sentapua_setup()
    {
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );
        // Let WordPress manage the document title.
        add_theme_support( 'title-tag' );
        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );
        // Images Sizes
        add_image_size( 'sentapua-featured-image', 2000, 1200, true );
        add_image_size( 'sentapua-thumbnail-avatar', 100, 100, true );
        // Switch default core markup for search form, comment form, and comments to output valid HTML5.
        add_theme_support( 'html5',
            [
                'comment-list',
                'comment-form',
                'search-form',
                'gallery',
                'caption'
            ]
        );
        // Enable support for Post Formats.
        add_theme_support( 'post-formats',
            [
//                'aside',
//                'image',
                'video',
//                'quote',
//                'link',
                'gallery',
//                'audio'
            ]
        );
    }
}