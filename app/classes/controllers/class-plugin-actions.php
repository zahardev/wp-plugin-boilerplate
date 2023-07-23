<?php
/**
 * Plugin actions controller
 *
 * @package WP_Plugin_Boilerplate
 * */

namespace WP_Plugin_Boilerplate\Controllers;

use WP_Plugin_Boilerplate\Interfaces\Initiable;
use WP_Plugin_Boilerplate\Interfaces\Singleton;
use WP_Plugin_Boilerplate\Services\DB_Butler;
use WP_Plugin_Boilerplate\Services\Renderer;
use WP_Plugin_Boilerplate\Traits\Singleton as Singleton_Trait;


/**
 * Class Plugin_Actions
 */
class Plugin_Actions implements Singleton, Initiable {

	use Singleton_Trait;

    /**
     * @var DB_Butler
     */
    protected $db_butler;

    /**
     * @param DB_Butler $db_butler
     */
    public function __construct( $db_butler ){
        $this->db_butler = $db_butler;
    }

	/**
	 * Init function
	 */
	public function init() {
		if ( ! is_admin() ) {
			return;
		}

		register_activation_hook( WPPLGNBLRPLT_PLUGIN_FILE, array( $this, 'activate' ) );
		register_deactivation_hook( WPPLGNBLRPLT_PLUGIN_FILE, array( $this, 'deactivate' ) );
	}

	/**
	 * Creates custom table on plugin activation
	 */
	public function activate() {
		$this->db_butler->create_example_table();
        $this->db_butler->insert_example_data();
	}

    /**
     * Creates custom table on plugin activation
     */
    public function deactivate() {
        $this->db_butler->delete_example_table();
    }
}
