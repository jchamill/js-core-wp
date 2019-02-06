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

  public function get_template_variables( $instance, $args ) {
    if( empty( $instance ) ) return array();

    $categories = get_categories(array(
      'taxonomy' => 'faq_category',
      'hide_empty' => true,
    ));

    $faqs = array();
    foreach ($categories as $category) {
      $loop = new WP_Query(array(
        'post_type' => 'faq',
        'posts_per_page' => -1,
        'tax_query' => array(array(
          'taxonomy' => 'faq_category',
          'field' => 'term_id',
          'terms' => $category->term_id,
        )),
      ));

      $weight = \JS_Core\Modules\Structure::get_term_field( $category->term_id, 'crb_weight' );

      $faqs[$category->term_id] = array(
        'term_id' => $category->term_id,
        'weight' => $weight,
        'name' => $category->name,
        'loop' => $loop,
      );
    }

    uasort($faqs, function($a, $b) {
      return $a['weight'] - $b['weight'];
    });

    return array(
      'faqs' => $faqs,
    );
  }
}

siteorigin_widget_register( 'js-core-faqs', __FILE__, 'JS_Core_Faqs_Widget' );
