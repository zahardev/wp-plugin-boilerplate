<?php
/**
 * Configurator file
 *
 * @package WP_Plugin_Boilerplate
 * */

namespace WP_Plugin_Boilerplate\Services;

use WP_Plugin_Boilerplate\Interfaces\Configurable;
use WP_Plugin_Boilerplate\Interfaces\Singleton;
use WP_Plugin_Boilerplate\Traits\Singleton as Singleton_Trait;


/**
 * Class Configurator
 * Handles plugin configuration files
 *
 * @since 1.0.0
 */
class Configurator implements Singleton, Configurable {

	use Singleton_Trait;

	/**
	 * Gets the config
	 *
	 * @return array
	 */
	public function config() {
		return include WPPLGNBLRPLT_PLUGIN_DIR . 'config/config.php';
	}
}
