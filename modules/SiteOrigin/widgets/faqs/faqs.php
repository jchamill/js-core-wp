<?php

class JS_Core_Faqs_Widget extends SiteOrigin_Widget {

  function __construct() {

    parent::__construct(
      'js-core-faqs',
      'FAQs',
      array(
        'description' => 'Display frequently asked questions.',
        'panels_groups' => array('js-core'),
      ),
      array(),
      false,
      plugin_dir_path(__FILE__)
    );
  }

  function get_widget_form() {
    return array(
      'categories' => array(
        'type' => 'repeater',
        'label' => 'Categories',
        'item_name'  => 'Categories',
        'item_label' => array(
          'selector'     => "[name*='category']",
          'update_event' => 'change',
          'value_method' => 'val'
        ),
        'fields' => array(
          'category' => array(
            'type' => 'text',
            'label' => 'Category'
          ),
          'faqs' => array(
            'type' => 'repeater',
            'label' => 'FAQs',
            'item_name'  => 'FAQ',
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
            )
          ),
        )
      ),
    );
  }

}

siteorigin_widget_register( 'js-core-faqs', __FILE__, 'JS_Core_Faqs_Widget' );
