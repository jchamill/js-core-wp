<?php

class JS_Core_Hero_Widget extends SiteOrigin_Widget {

  function __construct() {

    parent::__construct(
      'js-core-hero',
      'Hero',
      array(
        'description' => 'Section with image, headline, description, and cta. Supports multiple slides.',
        'panels_groups' => array('js-core'),
      ),
      array(),
      false,
      plugin_dir_path(__FILE__)
    );
  }

  function get_widget_form() {
    return array(
      'items' => array(
        'type' => 'repeater',
        'label' => 'Items',
        'item_name'  => 'Item',
        'item_label' => array(
          'selector'     => "[name*='title']",
          'update_event' => 'change',
          'value_method' => 'val',
        ),
        'fields' => array(
          'title' => array(
            'type' => 'text',
            'label' => 'Title',
          ),
          'content' => array(
            'type' => 'tinymce',
            'label' => 'Content',
          ),
          'image' => array(
            'type' => 'media',
            'label' => 'Image',
          ),
          'cta' => array(
            'type' => 'section',
            'label' => __( 'Call To Action' ),
            'fields' => array(
              'text' => array(
                'type' => 'text',
                'label' => 'Text',
              ),
              'url' => array(
                'type' => 'text',
                'label' => 'URL',
                'sanitize' => 'url',
              ),
            )
          ),
        ),
      ),
      'jump' => array(
        'type' => 'section',
        'label' => __( 'Jump Link' ),
        'hide' => true,
        'fields' => array(
          'row_id' => array(
            'type' => 'text',
            'label' => 'Row ID',
            'description' => 'You must also enter this "Row ID" on the page builder row you wish to provide a jump link to.',
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

siteorigin_widget_register( 'js-core-hero', __FILE__, 'JS_Core_Hero_Widget' );
