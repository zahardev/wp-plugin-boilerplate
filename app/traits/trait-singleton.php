<?php
/**
 * Trait for using singleton functionality
 *
 * @package WP_Plugin_Boilerplate
 * */

namespace WP_Plugin_Boilerplate\Traits;

/**
 * Trait Singleton
 *
 * @since 1.0.0
 */
trait Singleton {

    /**
     * Class instance.
     *
     * @var self $instance
     * */
    private static $instance;

    /**
     * Protect instance constructor.
     */
    private function __construct() {
    }

    /**
     * Returns the class instance.
     *
     * @return $this
     * */
    public static function instance( ...$params ) {
        if ( empty( static::$instance ) ) {
            static::$instance = new static( ...$params );
        }

        return static::$instance;
    }
}
