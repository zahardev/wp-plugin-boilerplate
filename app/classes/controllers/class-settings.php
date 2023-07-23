<?php

namespace WP_Plugin_Boilerplate\Controllers;

use WP_Plugin_Boilerplate\Entities\Settings_Tab;
use WP_Plugin_Boilerplate\Interfaces\Initiable;
use WP_Plugin_Boilerplate\Interfaces\Singleton;
use WP_Plugin_Boilerplate\Services\Renderer;

use WP_Plugin_Boilerplate\Traits\Singleton as SingletonTrait;

/**
 * Class Settings
 * @package WP_Plugin_Boilerplate
 */
class Settings implements Singleton, Initiable {

    use SingletonTrait;

    const MANAGER_SETTINGS_URL = 'wpplgnblrplt_settings';

    const DEFAULT_TAB = 'general';


    /**
     * @var array $settings
     */
    protected $settings;

    /**
     * @var Renderer
     * */
    protected $renderer;

    /**
     * @var array
     * */
    protected $config;

    /**
     * @param Renderer $renderer
     * @param array $config
     */
    public function __construct( $renderer, $config ){
        $this->renderer = $renderer;
        $this->config = $config;
    }


    public function init() {
        add_filter( 'plugin_action_links_' . WPPLGNBLRPLT_PLUGIN_BASENAME, array( $this, 'add_plugin_links' ) );
        add_action( 'admin_menu', array( $this, 'add_settings_pages' ) );
        add_action( 'admin_init', array( $this, 'init_setting_tabs' ) );
        add_action( 'wpplgnblrplt_tab_settings', array( $this, 'provide_settings_tab' ) );
        add_filter( 'pre_update_option_' . self::MANAGER_SETTINGS_URL, array( $this, 'fix_option_rewrite' ), 10, 2 );

        return $this;
    }

    /**
     * @param $value
     * @param $old_value
     *
     * @return array
     */
    public function fix_option_rewrite( $value, $old_value ) {
        if ( is_array( $old_value ) && is_array( $value ) ) {
            return array_merge( $old_value, $value );
        }

        return $value;
    }

    /**
     * @param Settings_Tab $tab
     */
    public function provide_settings_tab( $tab ) {
        $args = array(
            'id'    => 'wpplgnblrplt_settings_tab',
            'value' => $tab->id,
            'type' => 'hidden',
        );

        $this->render_settings_field( $args );
    }

    /**
     * @param array $links
     *
     * @return array
     */
    public function add_plugin_links( $links ) {
        $settings_link = $this->renderer->fetch( 'link', [
            'href'  => admin_url( 'options-general.php?page=' . self::MANAGER_SETTINGS_URL ),
            'label' => 'Settings',
        ] );

        array_unshift( $links, $settings_link );

        return $links;
    }

    /**
     * Add settings page.
     */
    public function add_settings_pages() {
        $pages = $this->get_setting_pages_config();

        foreach ( $pages as $page ) {
            add_options_page(
                $page['title'],
                $page['title'],
                'manage_options',
                $page['menu_slug'],
                function () use ( $page ) {
                    $this->render_settings_page( $page['page_slug'] );
                }
            );
        }
    }

    /**
     * @return array[]
     */
    protected function get_setting_pages_config() {
        return array(
            array(
                'title'     => __( 'Plugin Boilerplate Settings', 'wp-plugin-boilerplate-domain' ),
                'menu_slug' => self::MANAGER_SETTINGS_URL,
                'page_slug' => self::MANAGER_SETTINGS_URL,
            ),
        );
    }

    public function init_setting_tabs() {

        if ( ! $this->is_plugin_settings_page() ) {
            return;
        }

        $current_tab_name = $this->get_current_tab();

        $tabs = $this->get_tabs();

        register_setting( self::MANAGER_SETTINGS_URL, self::MANAGER_SETTINGS_URL );

        $current_tab = $tabs[ $current_tab_name ];

        add_settings_section( self::MANAGER_SETTINGS_URL, '', null, self::MANAGER_SETTINGS_URL );

        foreach ( $current_tab->fields as $field ) {
            $settings = $this->get_settings( $current_tab_name );
            if ( isset( $settings[ $field['id'] ] ) ) {
                $val = $settings[ $field['id'] ];
            } else {
                $val = '';
            }

            $this->add_settings_field( $field, $val );
        }
    }

    protected function is_plugin_settings_page() {
        if ( self::MANAGER_SETTINGS_URL === filter_input( INPUT_GET, 'page' ) ||
             self::MANAGER_SETTINGS_URL === filter_input( INPUT_POST, 'option_page' )
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param string $id
     * @param string $title
     * @param callable|null $callback
     */
    protected function add_settings_section( $id, $title, $callback = null ) {
        add_settings_section( $id, $title, $callback, self::MANAGER_SETTINGS_URL );
    }


    protected function add_settings_field( $args, $value ) {
        $field_name = $this->get_settings_field_name( $args['id'] );
        $field_id   = $this->get_settings_field_id( $args['id'] );
        add_settings_field(
            $field_id,
            array_key_exists( 'title', $args ) ? $args['title'] : '',
            array( $this, 'render_settings_field' ),
            self::MANAGER_SETTINGS_URL,
            self::MANAGER_SETTINGS_URL,
            array_merge( $args, array( 'value' => $value, 'name' => $field_name, 'id' => $field_id ) )
        );
    }

    public function render_settings_field( $args ) {
        $defaults            = $this->config['setting_field_defaults'];
        $type                = $args['type'];
        $field_type_defaults = array_key_exists( $type, $defaults ) ? $defaults[ $type ] : array();
        $args = wp_parse_args( $args, $field_type_defaults );
        $args = apply_filters( 'wpplgnblrplt_render_field_args', $args );

        $this->renderer->render( 'settings/fields/' . $args['type'], $args );
    }

    /**
     * @param string $field_id
     *
     * @return string
     */
    protected function get_settings_field_name( $field_id ) {
        return sprintf( '%s[%s][%s]', self::MANAGER_SETTINGS_URL, $this->get_current_tab(), $field_id );
    }

    /**
     * @param string $field_id
     *
     * @return string
     */
    protected function get_settings_field_id( $field_id ) {
        return sprintf( '%s_%s_%s', self::MANAGER_SETTINGS_URL, $this->get_current_tab(), $field_id );
    }

    /**
     * @return string
     */
    protected function get_current_tab() {
        $post_tab = filter_input( INPUT_POST, 'wpplgnblrplt_settings_tab' );

        $tab = $post_tab ?: filter_input( INPUT_GET, 'tab' );

        return $tab ?: self::DEFAULT_TAB;
    }

    /**
     * @return array|mixed
     */
    public function get_settings( $tab = '' ) {
        $tab = $tab ?: $this->get_current_tab();
        if ( isset( $this->settings[ $tab ] ) ) {
            return $this->settings[ $tab ];
        }
        $settings = get_option( self::MANAGER_SETTINGS_URL );

        $this->settings = $settings;

        return isset( $this->settings[ $tab ] ) ? $this->settings[ $tab ] : null;
    }


    /**
     * @return Settings_Tab[]
     */
    protected function get_tabs() {
        $tabs        = $this->get_tab_settings();
        $tab_objects = array();

        foreach ( $tabs as $tab ) {
            $tab_objects[ $tab['id'] ] = new Settings_Tab( $tab );
        }

        return $tab_objects;
    }


    /**
     * @return array
     */
    protected function get_tab_settings() {
        return require WPPLGNBLRPLT_PLUGIN_DIR . '/config/settings.php';
    }

    /**
     * @param string $page_slug
     */
    public function render_settings_page( $page_slug ) {
        $tabs        = $this->get_tabs();
        $current_tab = $this->get_current_tab();

        $current_tab = $tabs[ $current_tab ];

        $settings_title = $this->get_settings_title();

        $this->renderer->render( 'settings/settings.php', compact( 'page_slug', 'tabs', 'current_tab', 'settings_title' ) );
    }

    protected function get_settings_title() {
        return __( 'Plugin Boilerplate Settings', 'wp-plugin-boilerplate-domain' );
    }
}
