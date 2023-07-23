<?php
/**
 * Frontend controller
 *
 * @package WP_Plugin_Boilerplate
 * */

namespace WP_Plugin_Boilerplate\Controllers;

use WP_Plugin_Boilerplate\Interfaces\Initiable;
use WP_Plugin_Boilerplate\Interfaces\Singleton;
use WP_Plugin_Boilerplate\shortcodes\Example_Shortcode;
use WP_Plugin_Boilerplate\Traits\Singleton as Singleton_Trait;


/**
 * Class Frontend
 *
 * @since 1.0.0
 */
class Frontend implements Singleton, Initiable {

	use Singleton_Trait;

	/**
	 * Version number
	 *
	 * @var string
	 */
	protected $version;

	/**
	 * Init function
	 */
	public function init() {
		if ( is_admin() ) {
			return;
		}
		$this->version = $this->is_debug_mode() ? time() : WPPLGNBLRPLT_PLUGIN_VERSION;

		$this->enqueue_styles();
		$this->enqueue_scripts();
	}

	/**
	 * Checks if the site is in debug mode or not
	 *
	 * @return bool
	 */
	protected function is_debug_mode() {
		return defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG;
	}

	/**
	 * Enqueues styles
	 * */
	protected function enqueue_styles() {
		add_action(
			'init',
			function () {
				wp_enqueue_style( 'wp-plugin-boilerplate-styles', WPPLGNBLRPLT_PLUGIN_URL . '/assets/css/all.css', array(), $this->version );
			}
		);
	}

	/**
	 * Enqueues scripts
	 * */
	protected function enqueue_scripts() {
		add_action(
			'init',
			function () {
				wp_enqueue_script( 'wp-plugin-boilerplate-scripts', WPPLGNBLRPLT_PLUGIN_URL . '/assets/js/all.js', array( 'jquery' ), $this->version, true );

				wp_localize_script(
					'wp-plugin-boilerplate-scripts',
					'boilerplateData',
					array(
						'ajaxUrl'         => admin_url( 'admin-ajax.php' ),
						'getListNonce'    => wp_create_nonce( Example_Shortcode::NONCE_GET_LIST ),
					)
				);
			}
		);
	}
}
