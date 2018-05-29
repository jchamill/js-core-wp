<?php

namespace JS_Core\Modules;

class Structure {

  public function __construct() {
    add_action( 'init', array( $this, 'initialize' ) );

    add_action( 'carbon_register_fields', array( $this, 'custom_fields' ) );

    add_filter( 'carbon_map_api_key', array( $this, 'custom_fields_map_key' ) );
  }

  public function initialize() {
    $this->create_post_types();
    $this->register_taxonomies();
  }

  public function create_post_types() {
    $this->create_person_post_type();
  }

  public function create_person_post_type() {
    $defaults = $this->get_post_type_defaults();

    $post_type = array(
      'labels' => array(
        'name' => __( 'People' ),
        'singular_name' => __( 'Person' ),
      ),
      'rewrite' => array(
        'slug' => 'people',
        'with_front' => false,
      ),
      'menu_icon' => 'dashicons-groups',
      'taxonomies' => array( 'services' ),
    );

    register_post_type( 'person', array_merge( $defaults, $post_type ) );
  }

  public function get_post_type_defaults() {
    return array(
      'public' => true,
      'has_archive' => false,
      'menu_position' => 25,
      'supports' => array(
        'title',
        'editor',
        'excerpt',
        'author',
        'thumbnail',
        'revisions',
      ),
    );
  }

  public function register_taxonomies() {
    register_taxonomy(
      'services',
      array( 'person' ),
      array(
        'label' => __( 'Services' ),
        'rewrite' => array(
          'slug' => 'services',
          'with_front' => false,
        ),
        'hierarchical' => true,
      )
    );
  }

  public function custom_fields() {
    include_once( \JS_Core\PLUGIN_DIR . 'modules/Structure/includes/fields.php' );
  }

  public function custom_fields_map_key( $current_key ) {
    return 'insert_google_maps_key';
  }
}
