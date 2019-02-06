<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Post Fields.
 */

Container::make( 'post_meta', 'Header' )
  ->show_on_post_type( 'page' )
  ->set_context( 'advanced' )
  ->set_priority( 'high' )
  ->add_fields( array(
    Field::make( 'complex', 'crb_slides', 'Slides' )
      ->add_fields(array(
        Field::make( 'text', 'crb_slide_title', 'Title' ),
        Field::make( 'textarea', 'crb_slide_content', 'Description' ),
        Field::make( 'text', 'crb_slide_cta_title', 'CTA Title' )
          ->set_width( 50 ),
        Field::make( 'text', 'crb_slide_cta_url', 'CTA URL' )
          ->set_width( 50 ),
        Field::make( 'image', 'crb_slide_image', 'Image' ),
      ) ),
    Field::make( 'select', 'crb_header_size', 'Size' )
      ->add_options( array(
        'small' => 'Small',
        'large' => 'Large',
      ) ),
  ) );

Container::make( 'post_meta', 'Meta' )
  ->show_on_post_type( 'page' )
  ->add_fields( array(
    Field::make( 'text', 'crb_page_title', 'Page Title' ),
    Field::make( 'text', 'crb_meta_description', 'Meta Description' ),
    Field::make( 'image', 'crb_og_image', 'og:image' )
      ->set_value_type( 'url' )
  ) );

Container::make( 'post_meta', 'Details' )
  ->show_on_post_type( 'person' )
  ->add_fields( array(
    Field::make( 'text', 'crb_job_title', 'Job Title' ),
    Field::make( 'checkbox', 'crb_featured', 'Featured Post' )
      ->set_option_value(1),
  ) );

/**
 * Term Fields.
 */

Container::make( 'term_meta', 'Meta' )
  ->show_on_taxonomy( 'person_category' )
  ->add_fields( array(
    Field::make( 'text', 'crb_weight', 'Weight' ),
  ) );

Container::make( 'term_meta', 'Meta' )
  ->show_on_taxonomy( 'faq_category' )
  ->add_fields( array(
    Field::make( 'text', 'crb_weight', 'Weight' ),
  ) );