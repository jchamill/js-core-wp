<?php

class JS_Core_Section_Header_Widget extends SiteOrigin_Widget {

  function __construct() {

    parent::__construct(
      'js-core-section-header',
      'Section Header',
      array(
        'description' => 'Display a prominent heading.',
        'panels_groups' => array('js-core'),
      ),
      array(),
      false,
      plugin_dir_path(__FILE__)
    );
  }

  function get_widget_form() {
    return array(
      'headline_1' => array(
        'type' => 'text',
        'label' => 'Headline 1',
      ),
      'headline_2' => array(
        'type' => 'text',
        'label' => 'Headline 2',
      ),
    );
  }
}

siteorigin_widget_register( 'js-core-section-header', __FILE__, 'JS_Core_Section_Header_Widget' );
