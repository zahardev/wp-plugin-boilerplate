<?php
/**
 * Renderer class
 *
 * @package WP_Plugin_Boilerplate
 * */

namespace WP_Plugin_Boilerplate\Services;

use WP_Plugin_Boilerplate\Interfaces\Singleton;
use WP_Plugin_Boilerplate\Interfaces\Renderer as Interface_Renderer;
use WP_Plugin_Boilerplate\Traits\Singleton as Singleton_Trait;


/**
 * Class Renderer
 * Renders templates
 *
 * @since 1.0.0
 */
class Renderer implements Interface_Renderer, Singleton {

	use Singleton_Trait;

	/**
	 * Use this function if you don't need to print the template
	 *
	 * @param string $template Path to the template.
	 * @param array  $args Arguments.
	 *
	 * @return string
	 */
	public function fetch( $template, $args = array() ) {
        // @codingStandardsIgnoreStart
		extract( $args );
        // @codingStandardsIgnoreEnd
		$filetype = wp_check_filetype(
			$template,
			array(
				'php'  => 'text/html',
				'html' => 'text/html',
			)
		);
		if ( false === $filetype['ext'] ) {
			$template .= '.php';
		}
		ob_start();
		$path = WPPLGNBLRPLT_PLUGIN_DIR . 'templates/' . $template;

		if ( file_exists( $path ) ) {
			include $path;
			$res = ob_get_clean();
		} else {
			$res = '';
		}

		return $res;
	}

	/**
	 * Use this function if you need to print the template
	 *
	 * @param string $template Path to the template.
	 * @param array  $args Arguments.
	 *
	 * @return string
	 */
	public function render( $template, $args = array() ) {
		$res = $this->fetch( $template, $args );
		echo $res;

		return $res;
	}
}
