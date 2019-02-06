<?php

class JS_Core_Cards_Widget extends SiteOrigin_Widget {

  function __construct() {

    parent::__construct(
      'js-core-cards',
      'Cards',
      array(
        'description' => 'Displays a grid of square cards.',
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
        'label' => 'Items',
        'item_name'  => 'Item',
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
          'content' => array(
            'type' => 'textarea',
            'label' => 'Content'
          ),
          'url' => array(
            'type' => 'text',
            'label' => 'URL',
            'sanitize' => 'url'
          ),
          'image' => array(
            'type' => 'media',
            'label' => 'Image'
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

siteorigin_widget_register( 'js-core-cards', __FILE__, 'JS_Core_Cards_Widget' );
