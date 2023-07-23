<?php
/**
 * Plugin Name: WP Plugin Boilerplate
 * Version: 1.0.0
 * Description: This is just a boilerplate for your future amazing plugin
 * Text Domain: wp-plugin-boilerplate-domain
 * Author: Sergiy Zakharchenko
 * Author URI:  https://github.com/zahardev
 */

use WP_Plugin_Boilerplate\App;

if ( ! function_exists( 'add_action' ) ) {
    exit;
}

define( 'WPPLGNBLRPLT_PLUGIN_VERSION', '1.0.0');
define( 'WPPLGNBLRPLT_PLUGIN_FILE', __FILE__ );
define( 'WPPLGNBLRPLT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPPLGNBLRPLT_PLUGIN_BASENAME', plugin_basename(__FILE__));
define( 'WPPLGNBLRPLT_PLUGIN_URL', plugins_url('', __FILE__));

require_once 'autoloader.php';

App::instance()->init();
