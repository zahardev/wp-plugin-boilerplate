<?php
/**
 * All the magic starts from here
 *
 * @package WP_Plugin_Boilerplate
 * */

namespace WP_Plugin_Boilerplate;

use WP_Plugin_Boilerplate\Controllers\Frontend;
use WP_Plugin_Boilerplate\Controllers\Message_Form;
use WP_Plugin_Boilerplate\Controllers\Plugin_Actions;
use WP_Plugin_Boilerplate\Controllers\Settings;
use WP_Plugin_Boilerplate\Interfaces\Initiable;
use WP_Plugin_Boilerplate\Interfaces\Singleton;
use WP_Plugin_Boilerplate\Services\Configurator;
use WP_Plugin_Boilerplate\Services\DB_Butler;
use WP_Plugin_Boilerplate\Services\Renderer;
use WP_Plugin_Boilerplate\shortcodes\Example_Shortcode;
use WP_Plugin_Boilerplate\Traits\Singleton as Singleton_Trait;


/**
 * Class App
 */
class App implements Singleton, Initiable {

    use Singleton_Trait;

    /**
     * Init function
     */
    public function init() {
        $renderer  = Renderer::instance();
        $config    = Configurator::instance()->config();
        $db_butler = DB_Butler::instance();

        Plugin_Actions::instance( $db_butler )->init();
        Frontend::instance()->init();
        Settings::instance( $renderer, $config )->init();

        Example_Shortcode::instance( $renderer, $db_butler, $config )->init();
    }
}
