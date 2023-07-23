<?php
/**
 * Renderer interface
 *
 * @package WP_Plugin_Boilerplate
 * */

namespace WP_Plugin_Boilerplate\Interfaces;

interface Renderer {
	/**
	 * Function fetch
	 *
	 * Returns the template
	 *
	 * @param string $template Template path.
	 * @param array  $args Args.
	 */
	public function fetch( $template, $args = array() );

	/**
	 * Function render
	 *
	 * Prints the template and returns it
	 *
	 * @param string $template Template path.
	 * @param array  $args args.
	 */
	public function render( $template, $args = array() );
}
