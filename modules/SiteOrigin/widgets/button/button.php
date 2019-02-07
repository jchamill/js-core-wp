<?php

class JS_Core_Button_Widget extends SiteOrigin_Widget {

  function __construct() {

    parent::__construct(
      'js-core-button',
      'Button',
      array(
        'description' => 'Creates a styled button.',
        'panels_groups' => array('js-core'),
      ),
      array(),
      false,
      plugin_dir_path(__FILE__)
    );
  }

  function get_widget_form() {
    return array(
      'title' => array(
        'type' => 'text',
        'label' => 'Title'
      ),
      'url' => array(
        'type' => 'text',
        'label' => 'URL',
        'sanitize' => 'url'
      ),
      'style' => array(
        'type' => 'select',
        'label' => __( 'Style' ),
        'options' => array(
          'btn' => __( 'Primary' ),
          'btn btn-clear' => __( 'Secondary' ),
          'btn-arrow' => __( 'Arrow' ),
        ),
      ),
    );
  }
}

siteorigin_widget_register( 'js-core-button', __FILE__, 'JS_Core_Button_Widget' );
