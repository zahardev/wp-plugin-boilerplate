<?php
/**
 * Plugin config
 *
 * @package WP_Plugin_Boilerplate
 * */

use WP_Plugin_Boilerplate\Controllers\Settings;

return array(
    'example_shortcode' => array(
        'list_title'           => __( 'Example List', 'wp-plugin-boilerplate-domain' ),
        'labels'               => array(
            'name' => __( 'Name', 'wp-plugin-boilerplate-domain' ),
            'date' => __( 'Date', 'wp-plugin-boilerplate-domain' ),
        ),
    ),
    'settings' => array(
        array(
            'title'     => __( 'Plugin Boilerplate Settings', 'wp-plugin-boilerplate-domain' ),
            'menu_slug' => Settings::MANAGER_SETTINGS_URL,
            'page_slug' => Settings::MANAGER_SETTINGS_URL,
        ),
    ),
    'setting_field_defaults' => array(
        'text' => array(
            'id'          => '',
            'title'       => '',
            'placeholder' => '',
        ),
        'textarea' => array(
            'id'          => '',
            'title'       => '',
            'description' => '',
            'label'       => '',
            'rows'        => 10,
            'cols'        => 60,
        ),
        'button' => array(
            'id'      => '',
            'title'   => '',
            'text'    => '',
            'classes' => 'button',
        ),
        'link' => array(
            'id'      => '',
            'title'   => '',
            'text'    => '',
            'classes' => '',
            'url'     => '',
        ),
    ),
);
