<?php

namespace JS_Core\Modules;

class Structure {

  public function __construct() {
    add_action( 'init', array( $this, 'initialize' ) );

    add_action( 'carbon_register_fields', array( $this, 'custom_fields' ) );

    add_filter( 'carbon_map_api_key', array( $this, 'custom_fields_map_key' ) );

    add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
  }

  public function admin_scripts() {
    wp_enqueue_script( 'js-admin-faqs', plugins_url( 'js/js-admin-faqs.js', __FILE__ ) );
  }

  public function initialize() {
    $this->create_post_types();
    $this->register_taxonomies();
  }

  public function create_post_types() {
    $this->create_person_post_type();
    $this->create_faq_post_type();
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
      'taxonomies' => array( 'service' ),
    );

    register_post_type( 'person', array_merge( $defaults, $post_type ) );
  }

  public function create_faq_post_type() {
    $defaults = $this->get_post_type_defaults();

    $post_type = array(
      'labels' => array(
        'name' => __( 'FAQs' ),
        'singular_name' => __( 'Faq' ),
      ),
      'rewrite' => array(
        'slug' => 'faq',
        'with_front' => false,
      ),
      'menu_icon' => 'dashicons-editor-help',
      'taxonomies' => array( 'faq_category' ),
    );

    register_post_type( 'faq', array_merge( $defaults, $post_type ) );
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
      'service',
      array( 'person' ),
      array(
        'label' => __( 'Services' ),
        'rewrite' => array(
          'slug' => 'service',
          'with_front' => false,
        ),
        'hierarchical' => true,
      )
    );

    register_taxonomy(
      'faq_category',
      array( 'faq' ),
      array(
        'label' => __( 'FAQ Categories' ),
        'rewrite' => array(
          'slug' => 'faq-category',
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

  public static function get_field( $name, $type = false, $post_id = false ) {
    if ( ! $post_id ) {
      $post_id = get_the_ID();
    }

    if ( function_exists( 'carbon_get_post_meta' ) ) {
      if ($type) {
        return carbon_get_post_meta( $post_id, $name, $type );
      }
      return carbon_get_post_meta( $post_id, $name );
    }

    return false;
  }

  public static function get_term_field( $term_id, $name, $type = false ) {
    if ( function_exists( 'carbon_get_term_meta' ) ) {
      if ( $type ) {
        return carbon_get_term_meta( $term_id, $name, $type );
      }
      return carbon_get_term_meta( $term_id, $name );
    }

    return false;
  }
}
