<?php

namespace __WP_Plugin_Boilerplate__\Traits;


/**
 * Trait Singleton
 * @package Importer_From_Maxsite
 */
trait Singleton {

	private static $instance;

	/**
	 * API constructor.
	 */
	private function __construct() {
	}

    /**
     * @return $this
     * */
	public static function instance() {
		if ( empty( static::$instance ) ) {
			static::$instance = new static;
		}

		return static::$instance;
	}
}
