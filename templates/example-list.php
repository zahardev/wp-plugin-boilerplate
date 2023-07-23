<?php
/**
 * Prints the list of messages
 *
 * @see \WP_Plugin_Boilerplate\shortcodes\Example_Shortcode::render_shortcode()
 *
 * @var string $list_title List title
 * @var string $details_title Message details title
 * @var int $current_page Number of the current page
 * @var int $last_page Number of the last page
 * @var array $labels {
 *      Array of field labels.
 *
 * @type string $name Name
 * @type string $date Date
 * }
 *
 * @package WP_Plugin_Boilerplate
 * @since 1.0.0
 * */

if ( ! function_exists( 'add_action' ) ) {
	exit;
}
?>

<div class="example example-list js-example-list">

	<h2><?php echo esc_html( $list_title ); ?></h2>

	<ul class="example-list__items-list js-list-container" style="display: none">
		<li class="example-list__list-header">
			<div><?php echo esc_html( $labels['name'] ); ?></div>
			<div><?php echo esc_html( $labels['date'] ); ?></div>
		</li>
		<li class="example-list__list-item js-list-item-tmpl" style="display: none">
			<div class="js-name"></div>
			<div class="js-date"></div>
		</li>
	</ul>

	<div class="example-list__pagination js-pagination" style="display: none" data-page="<?php echo esc_html( $current_page ); ?>" data-last-page="<?php echo esc_html( $last_page ); ?>">
		<button class="js-first">«</button>
		<button class="js-prev">‹</button>
		<span class="js-pages-info"></span>
		<button class="js-next">›</button>
		<button class="js-last">»</button>
	</div>

	<div class="example-list__msg js-msg"></div>

	<div class="example-list__details-container js-details-container" style="display: none">
		<h2><?php echo esc_html( $details_title ); ?></h2>
		<div class="example-list__details js-details-tmpl" style="display: none">
			<div class="js-name"><h3><?php echo esc_html( $labels['first_name'] ); ?></h3></div>
			<div class="js-last-name"><h3><?php echo esc_html( $labels['last_name'] ); ?></h3></div>
			<div class="js-email"><h3><?php echo esc_html( $labels['email'] ); ?></h3></div>
			<div class="js-subject"><h3><?php echo esc_html( $labels['subject'] ); ?></h3></div>
			<div class="js-message"><h3><?php echo esc_html( $labels['message'] ); ?></h3></div>
		</div>
	</div>
</div>
