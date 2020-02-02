<?php

namespace CF\Core;

use CF\CrowdFavoriteAbstract;

/**
 * Class BackwardCompatibility
 * @package CH\Core
 */
class BackwardCompatibility extends CrowdFavoriteAbstract
{
    /**
     * @var bool
     */
    private $passed = true;

    /**
     * BackwardCompatibility constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if (!$this->phpVersionIsOK() || !$this->wpVersionIsOK()) {
            add_action('after_switch_theme', [$this, 'preventSwitchingTheme']);
            add_action('load-customize.php', [$this, 'preventCustomizerLoad']);
            add_action('template_redirect', 'twentytwenty_preview');

            $this->passed = false;
        }
    }

    /**
     * @return bool
     */
    public function check()
    {
        return $this->passed;
    }

    /**
     * Prevent switching theme
     */
    public function preventSwitchingTheme()
    {
        switch_theme(WP_DEFAULT_THEME);

        unset($_GET['activated']);

        add_action('admin_notices', [$this, 'showAdminNotice']);
    }

    /**
     * Prevents the Customizer from being loaded
     */
    public function preventCustomizerLoad()
    {
        wp_die($this->getErrorMessage());
    }

    /**
     * Prevents the Theme Preview from being loaded
     */
    public function preventPreviewLoad()
    {
        if (isset($_GET['preview'])) {
            wp_die($this->getErrorMessage());
        }
    }

    /**
     * Adds a message for unsuccessful theme switch.
     */
    public function showAdminNotice()
    {
        printf('<div class="error"><p>%s</p></div>', $this->getErrorMessage());
    }

    /**
     * Checks if PHP version is ok
     *
     * @return mixed
     */
    private function phpVersionIsOK()
    {
        return version_compare(PHP_VERSION, $this->config->item('requirements')['php_version'], '>=');
    }

    /**
     * Checks if Wordpress version is ok
     *
     * @return mixed
     */
    private function wpVersionIsOK()
    {
        return version_compare($GLOBALS['wp_version'], $this->config->item('requirements')['wp_version'], '>=');
    }

    /**
     * Get error message
     *
     * @return string
     */
    private function getErrorMessage()
    {
        $message = 'Crowd Favorite theme requires at least WordPress version %s and PHP version %s. You are running Wordpress version %s and PHP version %s. Please upgrade and try again.';

        return sprintf(
            __($message, $this->config->item('text_domain')),
            $this->config->item('requirements')['wp_version'],
            $this->config->item('requirements')['php_version'],
            $GLOBALS['wp_version'],
            PHP_VERSION
        );
    }
}
