<?php

return apply_filters( 'wpplgnblrplt_settings_config', array(
    array(
        'id'     => 'general',
        'title'  => 'General Settings',
        'fields' => array(
            array(
                'id'          => 'text_example',
                'type'        => 'text',
                'title'       => __( 'Text example', 'wp-plugin-boilerplate-domain' ),
                'description' => __( 'Just an example settings that do nothing', 'wp-plugin-boilerplate-domain' ),
                'placeholder' => __( 'Put something here', 'wp-plugin-boilerplate-domain' ),
            ),
            array(
                'id'          => 'textarea_example',
                'type'        => 'textarea',
                'title'       => __( 'Textarea example', 'wp-plugin-boilerplate-domain' ),
                'description' => __( 'Just an example settings that do nothing.', 'wp-plugin-boilerplate-domain' ),
            ),
        ),

    ),
    array(
        'id'     => 'advanced',
        'title'  => 'Advanced',
        'fields' => array(
            array(
                'id'    => 'checkbox_example',
                'type'  => 'checkbox',
                'title' => 'Enable something important',
            ),
            array(
                'id'      => 'select_example',
                'type'    => 'select',
                'title'   => 'Options example',
                'options' => array(
                    'option1' => 'Option 1',
                    'option2' => 'Option 2',
                ),
            ),
        ),
    ),
) );
