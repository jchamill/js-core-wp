<?php

namespace JS_Core\Modules;

class SiteOrigin {
  public function __construct() {
    add_filter( 'siteorigin_panels_widget_dialog_tabs', array( $this, 'widget_tabs' ), 20 );

    add_filter( 'siteorigin_panels_widgets', array( $this, 'remove_widgets' ) );

    add_filter( 'siteorigin_panels_row_style_fields', array( $this, 'row_fields' ) , 15 );

    add_filter( 'siteorigin_panels_row_style_css', array( $this, 'row_style_css' ), 15, 2 );

    add_filter( 'siteorigin_panels_widget_style_fields', array( $this, 'widget_fields' ) , 15 );

    add_filter( 'siteorigin_panels_widget_style_attributes', array( $this, 'widget_style_attributes' ), 10, 2 );

    add_filter( 'siteorigin_panels_before_row', array( $this, 'before_row' ), 10, 2 );

    add_filter( 'siteorigin_panels_after_row', array( $this, 'after_row' ), 10, 2 );

    add_action( 'plugins_loaded', array( $this, 'load_widgets' ) );
  }

  public function load_widgets() {

    if ( ! class_exists( 'SiteOrigin_Widget' ) ) {
      return;
    }

    require_once( \JS_Core\PLUGIN_DIR . 'modules/SiteOrigin/widgets/hero/hero.php' );
    require_once( \JS_Core\PLUGIN_DIR . 'modules/SiteOrigin/widgets/posts/posts.php' );
    require_once( \JS_Core\PLUGIN_DIR . 'modules/SiteOrigin/widgets/people/people.php' );
    require_once( \JS_Core\PLUGIN_DIR . 'modules/SiteOrigin/widgets/faqs/faqs.php' );
    require_once( \JS_Core\PLUGIN_DIR . 'modules/SiteOrigin/widgets/logos/logos.php' );
    require_once( \JS_Core\PLUGIN_DIR . 'modules/SiteOrigin/widgets/cards/cards.php' );
    require_once( \JS_Core\PLUGIN_DIR . 'modules/SiteOrigin/widgets/stats/stats.php' );
    require_once( \JS_Core\PLUGIN_DIR . 'modules/SiteOrigin/widgets/callout/callout.php' );
    require_once( \JS_Core\PLUGIN_DIR . 'modules/SiteOrigin/widgets/section-header/section-header.php' );
  }

  public function widget_tabs( $tabs ) {
    $tabs[] = array(
      'title' => __( 'JS Core', 'js-core' ),
      'filter' => array(
        'groups' => array( 'js-core' )
      )
    );

    return $tabs;
  }

  public function remove_widgets( $widgets ) {
    unset($widgets['WP_Widget_Archives']);
    unset($widgets['WP_Widget_Media_Audio']);
    unset($widgets['WP_Widget_Calendar']);
    unset($widgets['WP_Widget_Categories']);
    unset($widgets['WP_Nav_Menu_Widget']);
    unset($widgets['WP_Widget_Media_Image']);
    unset($widgets['WP_Widget_Meta']);
    unset($widgets['WP_Widget_Pages']);
    unset($widgets['WP_Widget_RSS']);
    unset($widgets['WP_Widget_Recent_Comments']);
    unset($widgets['WP_Widget_Recent_Posts']);
    unset($widgets['WP_Widget_Search']);
    unset($widgets['SiteOrigin_Panels_Widgets_PostLoop']);
    unset($widgets['SiteOrigin_Panels_Widgets_PostContent']);
    unset($widgets['SiteOrigin_Panels_Widgets_Layout']);
    unset($widgets['WP_Widget_Tag_Cloud']);
    unset($widgets['WP_Widget_Text']);
    unset($widgets['WP_Widget_Media_Video']);

    return $widgets;
  }

  public function row_fields( $fields ) {
    // New fields.
    $fields['so_wrapper_id'] = array(
      'name'        => __( 'Row ID' ),
      'type'        => 'text',
      'group'       => 'attributes',
      'description' => __( 'A custom ID on the row.' ),
      'priority'    => 4,
    );

    $fields['so_wrapper_class'] = array(
      'name'        => __( 'Row Class' ),
      'type'        => 'text',
      'group'       => 'attributes',
      'description' => __( 'A CSS class on the row.' ),
      'priority'    => 5,
    );

    $fields['so_default_padding'] = array(
      'name' => __('Default Padding'),
      'type' => 'select',
      'group' => 'layout',
      'default' => 'top-bottom-padding',
      'options' => array(
        'top-bottom-padding' => __('Top and Bottom'),
        'top-only-padding' => __('Top Only'),
        'bottom-only-padding' => __('Bottom Only'),
        'no-padding' => __('None'),
      ),
      'priority' => 7,
    );

    $fields['so_row_layout'] = array(
      'name' => __( 'Row Layout' ),
      'type' => 'select',
      'group' => 'layout',
      'default' => 'so-width-large',
      'options' => array(
        'so-width-large' => __( 'Large' ),
        'so-width-medium' => __( 'Medium' ),
        'so-width-small' => __( 'Small' ),
        'so-width-full' => __( 'Full Width' ),
      ),
      'priority' => 10,
    );

    $fields['so_background'] = array(
      'name' => __( 'Background Style' ),
      'type' => 'select',
      'group' => 'design',
      'options' => array(
        '' => __( 'None' ),
        'so-bg-light-gray' => __('Light Gray'),
        'so-bg-dark-gray' => __('Dark Gray'),
      ),
      'priority' => 1,
    );

    $fields['so_light_text'] = array(
      'name'        => __('Light Text'),
      'type'        => 'checkbox',
      'group'       => 'design',
      'description' => __('Lighter text to show on a darker background.'),
      'priority'    => 10,
    );

    $fields['so_top_style'] = array(
      'name' => __( 'Top Style' ),
      'type' => 'select',
      'group' => 'design',
      'options' => array(
        '' => __( 'None' ),
        'so-top-border-gray' => __('Gray Border'),
      ),
      'priority' => 11,
    );

    $fields['so_bottom_style'] = array(
      'name' => __( 'Bottom Style' ),
      'type' => 'select',
      'group' => 'design',
      'options' => array(
        '' => __( 'None' ),
        'so-bottom-border-gray' => __('Gray Border'),
      ),
      'priority' => 12,
    );

    // Remove fields.
    if ( isset($fields['id']) ) {
      unset($fields['id']);
    }
    if ( isset($fields['class']) ) {
      unset($fields['class']);
    }
    if ( isset($fields['row_stretch']) ) {
      unset($fields['row_stretch']);
    }
    if ( isset($fields['background']) ) {
      unset($fields['background']);
    }
    if ( isset($fields['background_display']) ) {
      unset($fields['background_display']);
    }
    if ( isset($fields['border_color']) ) {
      unset($fields['border_color']);
    }

    // Update fields.
    if ( isset($fields['background_display']) ) {
      $fields['background_display']['default'] = 'cover';
    }

    return $fields;
  }

  public function row_style_css( $css, $style ) {
    // Remove background images from panel-row-style div, we handle ourselves.
    $css['background-image'] = false;

    return $css;
  }

  public function widget_fields( $fields ) {

    $fields['so_widget_padding'] = array(
      'name' => __('Default Padding'),
      'type' => 'select',
      'group' => 'layout',
      'default' => 'no-padding',
      'options' => array(
        'top-bottom-padding' => __('Top and Bottom'),
        'top-only-padding' => __('Top Only'),
        'bottom-only-padding' => __('Bottom Only'),
        'no-padding' => __('None'),
      ),
      'priority' => 7,
    );

    $fields['so_widget_width'] = array(
      'name' => __( 'Width' ),
      'type' => 'select',
      'group' => 'layout',
      'default' => 'so-widget-width-full',
      'options' => array(
        'so-widget-width-large' => __( 'Large' ),
        'so-widget-width-medium' => __( 'Medium' ),
        'so-widget-width-small' => __( 'Small' ),
        'so-widget-width-full' => __( 'Full Width' ),
      ),
      'priority' => 10,
    );

    $fields['so_widget_top_style'] = array(
      'name' => __( 'Top Style' ),
      'type' => 'select',
      'group' => 'design',
      'options' => array(
        '' => __( 'None' ),
        'so-top-border-gray' => __('Gray Border'),
      ),
      'priority' => 12,
    );

    $fields['so_widget_bottom_style'] = array(
      'name' => __( 'Bottom Style' ),
      'type' => 'select',
      'group' => 'design',
      'options' => array(
        '' => __( 'None' ),
        'so-bottom-border-gray' => __('Gray Border'),
      ),
      'priority' => 14,
    );

    unset( $fields['background'] );
    unset( $fields['border_color'] );
    unset( $fields['font_color'] );
    unset( $fields['link_color'] );

    return $fields;
  }

  function widget_style_attributes( $attributes, $style ) {

    if ( !empty( $style['so_widget_padding'] ) ) {
      $attributes['class'][] = esc_attr( $style['so_widget_padding'] );
    }

    if ( !empty( $style['so_widget_width'] ) ) {
      $attributes['class'][] = esc_attr( $style['so_widget_width'] );
    }

    if ( !empty( $style['so_widget_top_style'] ) ) {
      $attributes['class'][] = esc_attr( $style['so_widget_top_style'] );
    }

    if ( !empty( $style['so_widget_bottom_style'] ) ) {
      $attributes['class'][] = esc_attr( $style['so_widget_bottom_style'] );
    }

    return $attributes;
  }

  public function before_row( $grid_index, $attributes ) {
    $classes = array('so-row');
    $row_id = '';
    $bg_image = '';

    if( !empty( $attributes['style']['so_light_text'] ) ) {
      $classes[] = 'so-light-text';
    }
    if ( !empty( $attributes['style']['so_wrapper_id'] ) ) {
      $row_id = esc_attr( $attributes['style']['so_wrapper_id'] );
    }
    if ( !empty( $attributes['style']['so_wrapper_class'] ) ) {
      $classes[] = esc_attr($attributes['style']['so_wrapper_class']);
    }
    if ( !empty( $attributes['style']['so_row_layout'] ) ) {
      $classes[] = esc_attr($attributes['style']['so_row_layout']);
    }
    if ( !empty( $attributes['style']['so_background'] ) ) {
      $classes[] = esc_attr($attributes['style']['so_background']);
    }
    if ( !empty( $attributes['style']['so_top_style'] ) ) {
      $classes[] = esc_attr($attributes['style']['so_top_style']);
    }
    if ( !empty( $attributes['style']['so_bottom_style'] ) ) {
      $classes[] = esc_attr($attributes['style']['so_bottom_style']);
    }
    if ( !empty( $attributes['style']['so_default_padding'] ) ) {
      $classes[] = esc_attr($attributes['style']['so_default_padding']);
    }
    if ( !empty( $attributes['style']['background_image_attachment'] ) ) {
      $bg_image = self::get_attachment_image_src( $attributes['style']['background_image_attachment'], 'full' );
    }

    $id = '';
    if ( ! empty( $row_id ) ) {
      $id = ' id="' . $row_id . '"';
    }

    $style = '';
    if ( ! empty( $bg_image ) ) {
      $style = ' style="background-image:url(' . ( is_array( $bg_image ) ? esc_url( $bg_image[0] ) : esc_url( $bg_image ) ) . ');"';
    }

    return '<div' . $id . ' class="' . implode(' ', $classes) . '"' . $style . '><div class="container">';
  }


  function after_row( $grid_index, $grid_attributes ) {
    return '</div></div>';
  }

  public static function get_style_attrs($attrs) {
    $style = '';
    foreach ($attrs as $attr => $value) {
      $style .= $attr . ':' . $value . ';';
    }
    return $style;
  }

  /**
   * This function is a duplicate directly from the SiteOrigin plugin.
   */
  public static function get_attachment_image_src( $image, $size = 'full' ){
    if( empty( $image ) ) {
      return false;
    }
    else if( is_numeric( $image ) ) {
      return wp_get_attachment_image_src( $image, $size );
    }
    else if( is_string( $image ) ) {
      preg_match( '/(.*?)\#([0-9]+)x([0-9]+)$/', $image, $matches );
      return ! empty( $matches ) ? $matches : false;
    }
  }

}
