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
use WP_Plugin_Boilerplate\Interfaces\Initiable;
use WP_Plugin_Boilerplate\Interfaces\Singleton;
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
		Plugin_Actions::instance()->init();
		Frontend::instance()->init();
		Example_Shortcode::instance()->init();
	}
}
