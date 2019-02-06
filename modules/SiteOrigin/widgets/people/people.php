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
      'display' => array(
        'type' => 'select',
        'label' => __( 'Display' ),
        'default' => 'all',
        'options' => array(
          'all' => __( 'All' ),
          'featured' => __( 'Featured' ),
        )
      ),
      'attachment_size' => array(
        'label' => 'Image size',
        'type' => 'image-size',
        'default' => 'full',
      ),
    );
  }

  function get_template_name( $instance ) {
    switch ( $instance['display'] ) {
      case 'featured':
        $name = 'featured';
        break;
      default:
        $name = 'default';
    }
    return $name;
  }

  public function get_template_variables( $instance, $args ) {
    if( empty( $instance ) ) return array();

    if ( $instance['display'] === 'all' ) {
      return $this->get_all_display_template_variables( $instance, $args );
    }

    if ( $instance['display'] === 'featured' ) {
      return $this->get_featured_display_template_variables( $instance, $args );
    }
  }

  protected function get_all_display_template_variables( $instance, $args ) {
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

  protected function get_featured_display_template_variables( $instance, $args ) {
    $args = array(
      'post_type' => 'person',
      'posts_per_page' => 3,
      'orderby' => 'publish_date',
      'order' => 'DESC',
      'meta_query' => array(array(
        'key' => '_crb_featured',
        'value' => 1,
      )),
    );

    return array(
      'loop' => new WP_Query($args),
    );
  }

}

siteorigin_widget_register( 'js-core-people', __FILE__, 'JS_Core_People_Widget' );
