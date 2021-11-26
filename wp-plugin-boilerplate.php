<?php
/**
 * Plugin Name: __WP_Plugin_Boilerplate__
 * Version: 0.0.1
 * Description: This plugin does something amazing
 * Text Domain: __text_domain__
 * Author: Author Name
 * Author URI:  https://github.com/zahardev
 */

use __WP_Plugin_Boilerplate__\App;

if ( ! function_exists( 'add_action' ) ) {
    exit;
}

//todo: rename folder wp-plugin-boilerplate and file wp-plugin-boilerplate.php
//todo: replace PBLRPLT with your unique plugin prefix in all the plugin files
//todo: replace __WP_Plugin_Boilerplate__ with your plugin name in all the plugin files
define( 'PBLRPLT_PLUGIN_VERSION', '0.0.1');
define( 'PBLRPLT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'PBLRPLT_PLUGIN_BASENAME', plugin_basename(__FILE__));
define( 'PBLRPLT_PLUGIN_URL', plugins_url('', __FILE__));

require_once 'wp-autoloader.php';

App::instance()->init();
