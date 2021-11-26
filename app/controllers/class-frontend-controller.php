<?php

namespace __WP_Plugin_Boilerplate__\Controllers;

use __WP_Plugin_Boilerplate__\Interfaces\Singleton;
use __WP_Plugin_Boilerplate__\Traits\Singleton as SingletonTrait;


/**
 * Class App
 */
class Frontend_Controller implements Singleton {

    use SingletonTrait;

    /**
     * Init function
     */
    public function init() {
        if ( is_admin() ) {
            return;
        }

        $this->init_styles();
    }


    public function enqueue_styles() {
        wp_enqueue_style(
            'stripe-payments-custom-fields.css',
            PBLRPLT_PLUGIN_URL . '/assets/css/wp-plugin-boilerplate.css', [],
            PBLRPLT_PLUGIN_VERSION
        );
    }

    private function init_styles() {
        add_action( 'init', [ $this, 'enqueue_styles' ] );
    }
}
