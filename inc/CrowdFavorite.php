<?php

namespace CF;

use CF\Core\BackwardCompatibility;
use WP_Customize_Code_Editor_Control;

class CrowdFavorite extends CrowdFavoriteAbstract
{
    /**
     * Theme initialisation
     */
    public function init()
    {
        if ((new BackwardCompatibility())->check()) {
            add_action('after_setup_theme', [$this, 'setup']);
            add_action('customize_register', [$this, 'extendCustomizer']);
            add_action('widgets_init', [$this, 'setupWidgets']);
            add_action('wp_enqueue_scripts', [$this, 'enqueueScriptsAndStyles']);
            add_action('wp_footer', [$this, 'extendFooter']);
        }
    }

    /**
     * Theme setup
     */
    public function setup()
    {
        //  Make theme available for translation.
        load_theme_textdomain($this->config->item('text_domain'), CF_THEME_DIR . 'inc/Languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');

        // Set post Thumbnail size
        set_post_thumbnail_size(150, 150);

        // Custom image sizes
        add_image_size('thumbnail-square', 350, 350, true);

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(
            [
                'main-menu' => __('Primary', $this->config->item('text_domain'))
            ]
        );

        // Switch default core markup for search form, comment form, and comments to output valid HTML5.
        add_theme_support(
            'html5',
            [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption'
            ]
        );

        // Add support for core custom logo.
        add_theme_support(
            'custom-logo',
            [
                'height' => 45,
                'width' => 190,
                'flex-width' => false,
                'flex-height' => false
            ]
        );

        // Add support for Block Styles.
        add_theme_support('wp-block-styles');

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');
    }


    /**
     * Setup widget areas & register widgets
     */
    public function setupWidgets()
    {
        // NOTHING ATM
    }

    /**
     * Enqueue scripts and styles
     */
    public function enqueueScriptsAndStyles()
    {
        $themeId = $this->config->item('theme')['id'];

        $this->config->load('assets');

        foreach ($this->config->item('assets', 'styles', []) as $style) {
            $style['id'] = ($themeId . '-' . $style['id']);
            call_user_func_array('wp_enqueue_style', array_values($style));
        }

        foreach ($this->config->item('assets', 'scripts', []) AS $script) {
            $script['id'] = ($themeId . '-' . $script['id']);
            call_user_func_array('wp_enqueue_script', array_values($script));
        }
    }

    /**
     * @param \WP_Customize_Manager $customizer
     */
    public function extendCustomizer($customizer)
    {
        $customizer->add_section(
            'custom_js',
            [
                'title' => __('Additional JS', $this->config->item('text_domain')),
                'description' => __('Add your own JS code here.', $this->config->item('text_domain')),
                'priority' => 210
            ]
        );

        $customizer->add_setting(
            'custom_js',
            [
                'type' => 'option'
            ]
        );

        $customizer->add_control(
            new WP_Customize_Code_Editor_Control(
                $customizer,
                sprintf('custom_js[%s]', get_stylesheet()),
                [
                    'label' => __('Header', $this->config->item('text_domain')),
                    'code_type' => 'javascript',
                    'section' => 'custom_js',
                    'settings' => 'custom_js'
                ]
            )
        );
    }

    /**
     * @return void
     */
    public function extendFooter()
    {
        if (!empty($customJs = get_option('custom_js', null)))
        {
            echo sprintf("<script type=\"text/javascript\">\n\t%s\n</script>\n\n", $customJs);
        }
    }

}
