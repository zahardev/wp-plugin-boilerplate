<?php

namespace WP_Plugin_Boilerplate\Traits;


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

	public static function instance() {
		if ( empty( static::$instance ) ) {
			static::$instance = new static;
		}

		return static::$instance;
	}
}
