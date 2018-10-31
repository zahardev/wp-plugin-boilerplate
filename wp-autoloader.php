<?php

spl_autoload_register( function ( $class ) {
	$file_path = explode( '\\', $class );

	$file_path[0] = 'app'; //the first element is always just application name - the folder is app

	foreach ( $file_path as $k => $v ) {
		$v               = mb_strtolower( str_replace( '_', '-', $v ) );
		$file_path[ $k ] = $v;
	}

	$file_name = end( $file_path );

	if ( false !== array_search( 'interfaces', $file_path ) ) {
		$file_name = 'interface-' . $file_name . '.php';
	} elseif ( false !== array_search( 'traits', $file_path ) ) {
		$file_name = 'trait-' . $file_name . '.php';
	} else {
		$file_name = 'class-' . $file_name . '.php';
	}

	$file_path[ count( $file_path ) - 1 ] = $file_name;


	$fully_qualified_path = trailingslashit( __DIR__ ) . implode( '/', $file_path );

	if ( stream_resolve_include_path( $fully_qualified_path ) ) {
		include_once $fully_qualified_path;
	}
} );
