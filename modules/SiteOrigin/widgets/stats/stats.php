<?php

class JS_Core_Stats_Widget extends SiteOrigin_Widget {

  function __construct() {

    parent::__construct(
      'js-core-stats',
      'Stats',
      array(
        'description' => 'Display statistical data.',
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
        'label' => 'Stats',
        'item_name'  => 'Stat',
        'item_label' => array(
          'selector'     => "[name*='subject']",
          'update_event' => 'change',
          'value_method' => 'val'
        ),
        'fields' => array(
          'prefix' => array(
            'type' => 'text',
            'label' => 'Prefix'
          ),
          'number' => array(
            'type' => 'text',
            'label' => 'Number'
          ),
          'suffix' => array(
            'type' => 'text',
            'label' => 'Suffix'
          ),
          'subject' => array(
            'type' => 'text',
            'label' => 'Subject'
          ),
        )
      ),
    );
  }
}

siteorigin_widget_register( 'js-core-stats', __FILE__, 'JS_Core_Stats_Widget' );
