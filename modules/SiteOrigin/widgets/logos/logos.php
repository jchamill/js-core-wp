<?php

class JS_Core_Logos_Widget extends SiteOrigin_Widget {

  function __construct() {

    parent::__construct(
      'js-core-logos',
      'Logos',
      array(
        'description' => 'Displays a group of logos.',
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
        'label' => 'Title',
      ),
      'items' => array(
        'type' => 'repeater',
        'label' => 'Logos',
        'item_name'  => 'Logo',
        'item_label' => array(
          'selector'     => "[name*='title']",
          'update_event' => 'change',
          'value_method' => 'val'
        ),
        'fields' => array(
          'title' => array(
            'type' => 'text',
            'label' => 'Title'
          ),
          'image' => array(
            'type' => 'media',
            'label' => 'Image'
          ),
          'url' => array(
            'type' => 'text',
            'label' => 'URL',
            'sanitize' => 'url'
          ),
        )
      ),
      'attachment_size' => array(
        'label' => 'Image size',
        'type' => 'image-size',
        'default' => 'full',
      ),
    );
  }
}

siteorigin_widget_register( 'js-core-logos', __FILE__, 'JS_Core_Logos_Widget' );
