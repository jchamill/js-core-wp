<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Post Fields.
 */

Container::make( 'post_meta', 'Header' )
  ->show_on_post_type( 'page' )
  ->add_fields( array(
    Field::make( 'rich_text', 'crb_header_content', 'Content' ),
  ) );

Container::make( 'post_meta', 'Meta' )
  ->show_on_post_type( 'page' )
  ->add_fields( array(
    Field::make( 'text', 'crb_page_title', 'Page Title' ),
    Field::make( 'text', 'crb_meta_description', 'Meta Description' ),
    Field::make( 'image', 'crb_og_image', 'og:image' )
      ->set_value_type( 'url' )
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