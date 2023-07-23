<?php
/**
 * @var Settings_Tab[] $tabs
 * @var Settings_Tab $current_tab
 * @var string $page_slug
 * @var string $settings_title
 * */

use WP_Plugin_Boilerplate\Entities\Settings_Tab;

?>

<div id="wpplgnblrplt-settings" class="wpplgnblrplt-settings">
    <form action='options.php' method='post'>

        <h1><?php echo esc_html( $settings_title ) ?></h1>

        <ul class="wpplgnblrplt-tabs">
            <?php foreach ( $tabs as $tab ) : ?>
                <li class="wpplgnblrplt-tab <?php echo ( $tab->id === $current_tab->id ) ? 'active' : '' ?>">
                    <a href="<?php echo esc_attr( $tab->get_url() ) ?>"><?php echo esc_html( $tab->title ) ?></a>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php if ( $current_tab->description ): ?>
            <p style="font-size: 16px;"><?php echo esc_html( $current_tab->description ) ?></p>
        <?php endif; ?>

        <?php
        settings_fields( $page_slug );
        do_settings_sections( $page_slug );
        do_action( 'wpplgnblrplt_tab_settings', $current_tab );
        submit_button();
        ?>
    </form>
</div>
