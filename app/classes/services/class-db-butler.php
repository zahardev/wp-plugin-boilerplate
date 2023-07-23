<?php
/**
 * Database butler service
 *
 * @package WP_Plugin_Boilerplate
 * */

namespace WP_Plugin_Boilerplate\Services;

use WP_Plugin_Boilerplate\Entities\List_Item;
use WP_Plugin_Boilerplate\Interfaces\Singleton;
use WP_Plugin_Boilerplate\Traits\Singleton as Singleton_Trait;


/**
 * Class DB_Butler
 * Handles database: creates custom table, sets and gets data
 *
 * @since 1.0.0
 */
class DB_Butler implements Singleton {

	use Singleton_Trait;

	const EXAMPLE_TABLE = 'example_list';

	/**
	 * Db entity
	 *
	 * @var \wpdb
	 * */
	private $db;

	/**
	 * Stores results of total messages number
	 *
	 * @var int
	 * */
	private $messages_count;

	/**
	 * DB_Butler constructor.
	 */
	private function __construct() {
		global $wpdb;
		$this->db = $wpdb;
	}

	/**
	 * Adds new message
	 *
	 * @param string $first_name First name.
	 * @param string $last_name Last name.
	 * @param string $email Email.
	 * @param string $subject Subject.
	 * @param string $message Message.
	 *
	 * @return int|false The number of rows inserted, or false on error.
	 * @throws \Exception If any of the fields is empty.
	 */
	public function add_item( $first_name, $last_name, $email, $subject, $message ) {
		// Let's check that each item is not empty.
		foreach ( get_defined_vars() as $k => $arg ) {
			if ( ! $arg ) {
				/* Translators: %s: field name */
				throw new \Exception( sprintf( __( 'Error! Field %s is not valid.', 'wp-plugin-boilerplate-domain' ), $k ) );
			}
		}

		$date = gmdate( 'Y-m-d H:i:s' );

		return $this->db->insert(
			$this->get_example_table_name(),
			compact( 'first_name', 'last_name', 'email', 'subject', 'message', 'date' )
		);
	}

	/**
	 * Gets message item
	 *
	 * @param int $id Message id.
	 *
	 * @return List_Item
	 * @throws \Exception In case of the DB error.
	 */
	public function get_item( $id ) {
		$query = sprintf(
			'
            SELECT * FROM `%s` WHERE id="%d"
        ',
			$this->get_example_table_name(),
			$id
		);

		$item = $this->db->get_row( $query, ARRAY_A );

		if ( ! empty( $this->db->last_error ) ) {
			throw new \Exception( __( 'Error! Could not get details.', 'wp-plugin-boilerplate-domain' ) );
		}

		return new List_Item( $item );
	}

	/**
	 * Gets message items
	 *
	 * @param int $per_page How many items per page to obtain.
	 * @param int $page Page number.
	 *
	 * @return List_Item[]
	 * @throws \Exception In case of the DB error.
	 */
	public function get_list( $per_page, $page ) {
		$offset = ( $page - 1 ) * $per_page;

		$query = sprintf(
			'SELECT SQL_CALC_FOUND_ROWS * FROM `%s` ORDER BY id DESC LIMIT %d OFFSET %d',
			$this->get_example_table_name(),
			$per_page,
			$offset
		);

		$results = $this->db->get_results( $query, ARRAY_A );

		if ( ! empty( $this->db->last_error ) ) {
			throw new \Exception();
		}

		$items = array();

		foreach ( $results as $item ) {
			$items[] = new List_Item( $item );
		}

		$this->messages_count = $this->db->get_var( 'SELECT FOUND_ROWS()' );

		return $items;
	}

	/**
	 * Gets total number of messages
	 *
	 * @return int Number of messages.
	 */
	public function count_messages() {
		if ( is_null( $this->messages_count ) ) {
			$query                = sprintf( 'SELECT count(*) FROM `%s`', $this->get_example_table_name() );
			$this->messages_count = $this->db->get_var( $query );
		}

		return $this->messages_count;
	}

	/**
	 * Creates messages table on plugin activation
	 *
	 * @return array Strings containing the results of the various update queries.
	 */
	public function create_example_table() {
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		$create = sprintf(
			"
            CREATE TABLE `%s` (
              `id` bigint UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              `name` VARCHAR(255) NOT NULL,
              `date` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ",
			$this->get_example_table_name()
		);

		return dbDelta( $create );
	}

    /**
     * @return bool
     */
    public function insert_example_data(){
        $values = [];

        for ( $i = 1; $i <= 30; $i ++ ) {
            $date     = date( 'Y-m-d H:i', strtotime( "-$i days" ) );
            $values[] = "(\"Name $i\",\"$date\")";
        }

        $insert = sprintf(
            "INSERT INTO `%s` (`name`, `date`) VALUES %s;",
            $this->get_example_table_name(),
            implode( ',', $values )
        );

        $res = $this->db->query( $insert );
        return $res;
    }

    public function delete_example_table(){
        $drop = sprintf(
            "DROP TABLE `%s`",
            $this->get_example_table_name()
        );

        $this->db->query( $drop );
    }

	/**
	 * Gets the messages table name
	 *
	 * @return string Table name.
	 */
	protected function get_example_table_name() {
		return $this->db->prefix . self::EXAMPLE_TABLE;
	}
}
