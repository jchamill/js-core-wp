<?php

class JS_Core_Callout_Widget extends SiteOrigin_Widget {

  function __construct() {

    parent::__construct(
      'js-core-callout',
      'Callout',
      array(
        'description' => 'Section with image, headline, description, and cta.',
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
      'content' => array(
        'type' => 'tinymce',
        'label' => 'Content'
      ),
      'image' => array(
        'type' => 'media',
        'label' => 'Image'
      ),
      'cta' => array(
        'type' => 'section',
        'label' => __( 'Call To Action' ),
        'fields' => array(
          'text' => array(
            'type' => 'text',
            'label' => 'Text'
          ),
          'url' => array(
            'type' => 'text',
            'label' => 'URL',
            'sanitize' => 'url'
          ),
        )
      ),
      'settings' => array(
        'type' => 'section',
        'label' => __( 'Settings' ),
        'fields' => array(
          'layout' => array(
            'type' => 'select',
            'label' => __( 'Layout' ),
            'options' => array(
              '' => __( 'Image / Content' ),
              'reverse' => __( 'Content / Image' ),
            ),
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

siteorigin_widget_register( 'js-core-callout', __FILE__, 'JS_Core_Callout_Widget' );
