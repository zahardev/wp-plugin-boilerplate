<?php
/**
 * Abstract shortcode class
 *
 * @package WP_Plugin_Boilerplate
 * */

namespace WP_Plugin_Boilerplate\Shortcodes;

use WP_Plugin_Boilerplate\Interfaces\Initiable;
use WP_Plugin_Boilerplate\Interfaces\Singleton;
use WP_Plugin_Boilerplate\Services\Configurator;
use WP_Plugin_Boilerplate\Services\DB_Butler;
use WP_Plugin_Boilerplate\Services\Renderer;

/**
 * Abstract class Abstract_Shortcode
 *
 * @since 1.0.0
 */
abstract class Abstract_Shortcode implements Singleton, Initiable {

    protected function __construct() {
    }

    /**
     * Init function
     */
    public function init() {
        $this->init_shortcode();
        $this->init_ajax();
    }

    /**
     * Inits ajax jobs
     */
    protected function init_ajax() {
    }

    /**
     * Inits the shortcode
     * */
    protected function init_shortcode() {
        add_shortcode(
            $this->shortcode,
            function () {
                return $this->render_shortcode();
            }
        );
    }

    /**
     * Renders the shortcode
     */
    abstract protected function render_shortcode();
}
