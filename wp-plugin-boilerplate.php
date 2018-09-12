<?php
/*
 Plugin Name: {WP_Plugin_Boilerplate}
 Author: Author Name
 Author URI:  https://github.com/zahardoc
 Description: This plugin does something amazing
 License:     GPL2

{WP_Plugin_Boilerplate} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

{WP_Plugin_Boilerplate} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Stripe Payments Custom Fields. If not, see https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html.

*/

if ( ! function_exists( 'add_action' ) ) {
    exit;
}

//change DDDDD to your unique plugin prefix
define( 'DDDDD_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'DDDDD_PLUGIN_BASENAME', plugin_basename(__FILE__));
define( 'DDDDD_PLUGIN_URL', plugins_url('', __FILE__));

require_once __DIR__ . '/app/interfaces/interface-singleton.php';
require_once __DIR__ . '/app/traits/trait-singleton.php';
require_once __DIR__ . '/app/class-form-customizer.php';

\WP_Plugin_Boilerplate\Controller::instance()->init();
