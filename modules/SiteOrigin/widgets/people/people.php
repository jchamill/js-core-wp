<?php

class JS_Core_People_Widget extends SiteOrigin_Widget {

  function __construct() {

    parent::__construct(
      'js-core-people',
      'People',
      array(
        'description' => 'Display team members.',
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
      'attachment_size' => array(
        'label' => 'Image size',
        'type' => 'image-size',
        'default' => 'full',
      ),
    );
  }

  public function get_template_variables( $instance, $args ) {
    if( empty( $instance ) ) return array();

    $categories = get_categories(array(
      'taxonomy' => 'person_category',
      'hide_empty' => true,
    ));

    $people = array();
    foreach ($categories as $category) {
      $loop = new WP_Query(array(
        'post_type' => 'person',
        'posts_per_page' => -1,
        'tax_query' => array(array(
          'taxonomy' => 'person_category',
          'field' => 'term_id',
          'terms' => $category->term_id,
        )),
      ));

      $weight = \JS_Core\Modules\Structure::get_term_field( $category->term_id, 'crb_weight' );

      $people[$category->term_id] = array(
        'term_id' => $category->term_id,
        'weight' => $weight,
        'name' => $category->name,
        'loop' => $loop,
      );
    }

    uasort($people, function($a, $b) {
      return $a['weight'] - $b['weight'];
    });

    return array(
      'people' => $people,
    );
  }
}

siteorigin_widget_register( 'js-core-people', __FILE__, 'JS_Core_People_Widget' );
