<?php

class JS_Core_Posts_Widget extends SiteOrigin_Widget {

  function __construct() {

    parent::__construct(
      'js-core-posts',
      'Posts',
      array(
        'description' => 'Displays posts in a variety of formats.',
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
          'recent' => __( 'Recent' ),
        )
      ),
      'style' => array(
        'type' => 'select',
        'label' => __( 'Style' ),
        'default' => 'blocks',
        'options' => array(
          'blocks' => __( 'Blocks' ),
          'list' => __( 'List' ),
        )
      ),
      'attachment_size' => array(
        'label' => 'Image size',
        'type' => 'image-size',
        'default' => 'full',
      ),
    );
  }

  public function get_template_variables( $instance, $args ) {
    if ( empty( $instance ) ) return array();

    $posts_per_page = 9;

    if ( $instance['display'] === 'recent' ) {
      $posts_per_page = $instance['style'] === 'list' ? 5 : 3;
    }

    $args = array(
      'posts_per_page' => $posts_per_page,
      'orderby' => 'publish_date',
      'order' => 'DESC',
    );

    if ( $instance['display'] === 'all' ) {
      $args['paged'] = get_query_var('paged') ? get_query_var('paged') : 1;
    }

    $loop = new WP_Query( $args );

    return array(
      'loop' => $loop,
    );
  }
}

siteorigin_widget_register( 'js-core-posts', __FILE__, 'JS_Core_Posts_Widget' );
