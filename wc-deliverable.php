<?php
/**
 * Plugin Name:       wcDeliverable
 * Plugin URI:        https://github.com/sazzadcse/wcDeliverable
 * Description:       wcDeliverable is one of the top wp plugin for Dine-in or Takeaway or Delivery schedule.
 * Version:           1.0.1
 * Author:            wcDeliverable
 * Author URI:        https://github.com/sazzadcse/wcDeliverable
 * License:           GPL-2.0+
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wc-deliverable
 * Domain Path:       /languages
 */


// check base path
if ( ! defined( 'WPINC' ) ) {
    die;
}


define(  'WCDELIVERABLE_VERSION', '1.0.1' );
defined( 'WCDELIVERABLE_PATH' ) or define( 'WCDELIVERABLE_PATH', plugin_dir_path( __FILE__ ) );
defined( 'WCDELIVERABLE_URL' ) or define( 'WCDELIVERABLE_URL', plugin_dir_url( __FILE__ ) );
defined( 'WCDELIVERABLE_BASE_FILE' ) or define( 'WCDELIVERABLE_BASE_FILE', __FILE__ );
defined( 'WCDELIVERABLE_BASE_PATH' ) or define( 'WCDELIVERABLE_BASE_PATH', plugin_basename(__FILE__) );
defined( 'WCDELIVERABLE_IMG_DIR' ) or define( 'WCDELIVERABLE_IMG_DIR', plugin_dir_url( __FILE__ ) . 'assets/img/' );
defined( 'WCDELIVERABLE_CSS_DIR' ) or define( 'WCDELIVERABLE_CSS_DIR', plugin_dir_url( __FILE__ ) . 'assets/css/' );
defined( 'WCDELIVERABLE_JS_DIR' ) or define( 'WCDELIVERABLE_JS_DIR', plugin_dir_url( __FILE__ ) . 'assets/js/' );

require_once WCDELIVERABLE_PATH . 'includes/wcDeliverableUtils.php';
require_once WCDELIVERABLE_PATH . 'includes/wcDeliverableDB.php';
require_once WCDELIVERABLE_PATH . 'backend/class-wcdeliverable-ajax.php';
require_once WCDELIVERABLE_PATH . 'backend/class-wcdeliverable-admin.php';
require_once WCDELIVERABLE_PATH . 'frontend/class-wcdeliverable-frontend-ajax.php';
require_once WCDELIVERABLE_PATH . 'frontend/class-wcdeliverable-frontend.php';