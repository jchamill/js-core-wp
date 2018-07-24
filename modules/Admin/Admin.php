<?php

namespace JS_Core\Modules;

class Admin {
  public function __construct() {
    register_activation_hook( \JS_Core\PLUGIN_FILE, array( $this, 'activate' ) );

    add_action( 'admin_menu', array( $this, 'admin_menu' ), 999 );

    add_filter( 'admin_bar_menu', array( $this, 'customize_greeting' ), 25 );

    add_action( 'admin_enqueue_scripts', array( $this, 'admin_theme_style' ) );

    add_action( 'login_enqueue_scripts', array( $this, 'admin_theme_style' ) );
  }

  public function activate() {
    $this->create_roles();
  }

  public function create_roles() {
    add_role( 'safe_admin', 'Safe Admin', array(
      'delete_other_pages' => true,
      'delete_others_posts' => true,
      'delete_pages' => true,
      'delete_posts' => true,
      'delete_private_pages' => true,
      'delete_private_posts' => true,
      'delete_published_pages' => true,
      'delete_published_posts' => true,
      'edit_others_pages' => true,
      'edit_others_posts' => true,
      'edit_pages' => true,
      'edit_posts' => true,
      'edit_private_pages' => true,
      'edit_private_posts' => true,
      'edit_published_pages' => true,
      'edit_published_posts' => true,
      'manage_categories' => true,
      'manage_links' => true,
      'moderate_comments' => true,
      'publish_pages' => true,
      'publish_posts' => true,
      'read' => true,
      'read_private_pages' => true,
      'read_private_posts' => true,
      'unfiltered_html' => true,
      'upload_files' => true,
      'list_users' => true,
      'promote_users' => true,
      'remove_users' => true,
    ) );
  }

  public function admin_menu() {
    if ( current_user_can( 'safe_admin' ) ) {
      remove_menu_page( 'edit.php' );
      remove_menu_page( 'edit-comments.php' );
    }
  }

  public function customize_greeting( $wp_admin_bar ) {
    $my_account = $wp_admin_bar->get_node( 'my-account' );
    $my_account_title = str_replace( 'Howdy,', 'Hello', $my_account->title );
    $wp_admin_bar->add_node( array(
      'id' => 'my-account',
      'title' => $my_account_title,
    ) );
  }

  public function admin_theme_style() {
    wp_enqueue_style( 'js-admin-theme', plugins_url( 'css/js-admin.css', __FILE__ ) );
  }
}
