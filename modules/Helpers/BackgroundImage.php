<?php

namespace JS_Core\Helpers;

class BackgroundImage {
  private static $instance = null;
  private static $index = 0;
  private $config = array();

  private function __construct() {
    $this->add_inline_css();
  }

  public static function get_instance() {
    if ( self::$instance == null ) {
      self::$instance = new BackgroundImage();
    }
    return self::$instance;
  }

  public function print_inline_css() {
    $css = '';

    foreach ( $this->config as $config ) {
      if ( isset( $config['selector'], $config['image'] ) ) {
        $thumbnail = wp_get_attachment_image_src( $config['image'], 'thumbnail' );
        $medium = wp_get_attachment_image_src( $config['image'], 'medium' );
        $large = wp_get_attachment_image_src( $config['image'], 'large' );
        $css .= $config['selector'] . '{background-image: url(' . $thumbnail[0] . ');}';
        $css .= '@media only screen and (min-width:720px){';
        $css .= $config['selector'] . '{background-image: url(' . $medium[0] . ');}';
        $css .= '}';
        $css .= '@media only screen and (min-width:1100px){';
        $css .= $config['selector'] . '{background-image: url(' . $large[0] . ');}';
        $css .= '}';
      }
    }

    print '<style type="text/css" media="all">' . $css . '</style>';
  }

  public function add_image( $config ) {
    $this->config[] = $config;
  }

  public function add_inline_css() {
    add_action( 'wp_footer', array( $this, 'print_inline_css' ), 12 );
  }

  public function get_next_index() {
    return self::$index++;
  }
}