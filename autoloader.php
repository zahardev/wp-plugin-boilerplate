<?php
/**
 * Plugin autoloader
 *
 * @package WP_Plugin_Boilerplate
 * */

spl_autoload_register(
    function ( $class ) {
        // Use it only for the plugin classes, skip other searches.
        if ( false === strpos( $class, 'WP_Plugin_Boilerplate' ) ) {
            return;
        }

        $path_parts = explode( '\\', $class );

        $path_parts[0] = 'app'; // the root is app folder.

        foreach ( $path_parts as $k => $v ) {
            $v                = mb_strtolower( str_replace( '_', '-', $v ) );
            $path_parts[ $k ] = $v;
        }

        $file_name = end( $path_parts );

        if ( false !== array_search( 'interfaces', $path_parts, true ) ) {
            $file_name = 'interface-' . $file_name . '.php';
        } elseif ( false !== array_search( 'traits', $path_parts, true ) ) {
            $file_name = 'trait-' . $file_name . '.php';
        } else {
            array_splice( $path_parts, 1, 0, 'classes' );
            $file_name = 'class-' . $file_name . '.php';
        }

        $path_parts[ count( $path_parts ) - 1 ] = $file_name;

        $fully_qualified_path = trailingslashit( __DIR__ ) . implode( '/', $path_parts );

        if ( file_exists( $fully_qualified_path ) ) {
            include_once $fully_qualified_path;
        }
    }
);
