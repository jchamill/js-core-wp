<?php

class JS_Core_Example_Widget extends SiteOrigin_Widget {

  function __construct() {

    parent::__construct(
      'js-core-example',
      'Example',
      array(
        'description' => 'An example of a custom widget.',
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
            'type' => 'tinymce',
            'label' => 'Content'
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
      'display' => array(
        'type' => 'select',
        'label' => __( 'Display' ),
        'default' => 'template-b',
        'options' => array(
          'template-a' => __( 'Template A' ),
          'template-b' => __( 'Template B' ),
        )
      ),
      'attachment_size' => array(
        'label' => 'Image size',
        'type' => 'image-size',
        'default' => 'full',
      ),
    );
  }

  /**
   * Use this hook to provide various hooks needed for this widget.
   */
  function initialize() {}

  /**
   * Use this hook if you need to provide logic on which template to select.
   */
  function get_template_name( $instance ) {
    switch ( $instance['display'] ) {
      case 'template-a':
        $name = 'template-a';
        break;
      default:
        $name = 'default';
    }
    return $name;
  }

  public function get_template_variables( $instance, $args ) {
    if( empty( $instance ) ) return array();

    // Put necessary logic here to get variables.
    $sample = 'dynamic data';

    return array(
      'sample' => $sample,
    );
  }
}

siteorigin_widget_register( 'js-core-example', __FILE__, 'JS_Core_Example_Widget' );
