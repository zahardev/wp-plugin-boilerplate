<?php

namespace __WP_Plugin_Boilerplate__;

use __WP_Plugin_Boilerplate__\Controllers\Frontend_Controller;
use __WP_Plugin_Boilerplate__\Interfaces\Singleton;
use __WP_Plugin_Boilerplate__\Traits\Singleton as SingletonTrait;


/**
 * Class App
 */
class App implements Singleton {

	use SingletonTrait;

	/**
	 * Init function
	 */
	public function init() {
		Frontend_Controller::instance()->init();
	}
}
