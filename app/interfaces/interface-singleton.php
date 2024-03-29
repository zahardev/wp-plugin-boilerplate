<?php
/**
 * Singleton interface
 *
 * @package WP_Plugin_Boilerplate
 * */

namespace WP_Plugin_Boilerplate\Interfaces;

interface Singleton {
	/**
	 * Function instance
	 * */
	public static function instance();
}
