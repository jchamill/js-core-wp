<?php
/**
 * Plugin Name: JS Core
 * Plugin URI: https://www.jacksonspalding.com
 * Description: Wordpress and SiteOrigin Page Builder enhancements.
 * Version: 0.0.1
 * Author: JC Hamill
 * Author URI: http://www.jchamill.com
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

define( 'JS_Core\PLUGIN_FILE', __FILE__ );
define( 'JS_Core\PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once \JS_Core\PLUGIN_DIR . 'modules/Admin.php';
new \JS_Core\Modules\Admin();

require_once \JS_Core\PLUGIN_DIR . 'modules/Structure/Structure.php';
new \JS_Core\Modules\Structure();

require_once \JS_Core\PLUGIN_DIR . 'modules/SiteOrigin/SiteOrigin.php';
new \JS_Core\Modules\SiteOrigin();