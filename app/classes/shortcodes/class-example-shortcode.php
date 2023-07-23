<?php
/**
 * Example Shortcode
 *
 * @package WP_Plugin_Boilerplate
 * */

namespace WP_Plugin_Boilerplate\Shortcodes;

use WP_Plugin_Boilerplate\Traits\Singleton as Singleton_Trait;


/**
 * Class Example_Shortcode
 * Use [example_shortcode] shortcode
 *
 * @since 1.0.0
 */
class Example_Shortcode extends Abstract_Shortcode {

	use Singleton_Trait;

	const PER_PAGE = 10;

	const NONCE_GET_LIST = 'get_list_nonce';


	/**
	 * Shortcode
	 *
	 * @var string
	 * */
	protected $shortcode = 'example_shortcode';


	/**
	 * Inits ajax jobs
	 */
	protected function init_ajax() {
		add_action( 'wp_ajax_get_example_list', array( $this, 'get_list' ) );
		add_action( 'wp_ajax_nopriv_get_example_list', array( $this, 'get_list' ) );
	}

	/**
	 * Gets the messages for ajax request
	 *
	 * @throws \Exception In case of the DB error.
	 * */
	public function get_list() {
		try {
			if ( ! wp_verify_nonce( filter_input( INPUT_GET, 'nonce' ), self::NONCE_GET_LIST ) ) {
				throw new \Exception();
			}

			$page     = filter_input( INPUT_GET, 'page', FILTER_VALIDATE_INT );
			$page     = $page ?: 1;
			$list = $this->db_butler->get_list( self::PER_PAGE, $page );

			// Case that there are no items yet.
			if ( empty( $list ) ) {
				wp_send_json_success( array( 'msg' => __( 'There are no items yet.', 'wp-plugin-boilerplate-domain' ) ) );
			}

			wp_send_json_success(
				array(
					'items'     => $list,
					/* Translators: %d: current page, %d: last page */
					'pagesInfo' => sprintf( __( '%1$d of %2$d', 'wp-plugin-boilerplate-domain' ), $page, $this->get_last_page_number() ),
					'pages'     => $this->get_last_page_number(),
				)
			);

		} catch ( \Exception $e ) {
			// Case that there was a DB error.
			wp_send_json_error( __( 'Error! Could not get the list.', 'wp-plugin-boilerplate-domain' ) );
		}
	}

	/**
	 * Renders the shortcode
	 *
	 * @return string
	 */
	protected function render_shortcode() {
		$current_page = filter_input( INPUT_GET, 'pag', FILTER_VALIDATE_INT );
		$last_page    = $this->get_last_page_number();

		// This part is only for administrators.
		$data = array(
			'current_page' => ( $current_page && $current_page <= $last_page ) ? $current_page : 1,
			'last_page'    => $last_page,
		);

		return $this->renderer->fetch( 'example-list', array_merge( $this->config, $data ) );
	}

	/**
	 * Gets last page number (total number of pages)
	 *
	 * @return int Last page number
	 */
	protected function get_last_page_number() {
		return ceil( $this->db_butler->count_messages() / self::PER_PAGE );
	}
}
