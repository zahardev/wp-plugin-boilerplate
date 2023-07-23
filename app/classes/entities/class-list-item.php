<?php
/**
 * Message entity
 *
 * @package WP_Plugin_Boilerplate
 * */

namespace WP_Plugin_Boilerplate\Entities;

/**
 * Class Message
 * Represents the message
 * Note: protected properties will not be sent to the frontend
 *
 * @since 1.0.0
 */
class List_Item {

	/**
	 * Id
	 *
	 * @var int
	 * */
	protected $id;

	/**
	 * First name
	 *
	 * @var string
	 * */
	public $name;

	/**
	 * Date
	 *
	 * @var string
	 * */
	public $date;

	/**
	 * Constructor
	 * Propagates all the properties from the given array
	 *
	 * @param array $properties Array of message properties.
	 */
	public function __construct( $properties ) {
		foreach ( get_object_vars( $this ) as $k => $v ) {
			if ( isset( $properties[ $k ] ) ) {
				$this->$k = $properties[ $k ];
			}
		}
	}
}
