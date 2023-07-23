/**
 * Webpack config file
 *
 * @package WP_Plugin_Boilerplate
 * */

const mix = require( 'laravel-mix' );

mix.setPublicPath( 'assets' )
	.js( 'src/js/app.js', 'js/all.js' )
	.sass( 'src/scss/app.scss', 'css/all.css' )
	.options(
		{
			processCssUrls: false
		}
	)
	.disableNotifications();
