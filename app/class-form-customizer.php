<?php

namespace WP_Plugin_Boilerplate;

use WP_Plugin_Boilerplate\Interfaces\Singleton;
use WP_Plugin_Boilerplate\Traits\Singleton as SingletonTrait;


/**
 * Class Controller
 */
class Controller implements Singleton {

	use SingletonTrait;

	const ASSETS_VERSION = '0.1';

	/**
	 * Init function
	 */
	public function init() {
		if ( is_admin() ) {
			return;
		}

		$this->init_styles();
		$this->do_something_amazing();
	}

	public function do_something_amazing() {

	}


	public function enqueue_styles() {
		wp_enqueue_style(
			'stripe-payments-custom-fields.css',
			DDDDD_PLUGIN_URL . '/assets/css/wp-plugin-boilerplate.css', [],
			self::ASSETS_VERSION
		);
	}

	private function init_styles() {
		add_action( 'init', [ $this, 'enqueue_styles' ] );
	}
}
