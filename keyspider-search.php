<?php

/**
 *
 * @link              Keyspider
 * @since             1.1.0
 * @package           Keyspider_Search
 *
 * Plugin Name:       Keyspider Search
 * Plugin URI:        https://docs.keyspider.io/docs/integrate-keyspider-search-on-your-wordpress-website/
 * Description:       The Keyspider Site Search WordPress plugin is a refined, customizable, and more relevant search engine that replaces the default WordPress search.
 * Version:           1.1.0
 * Author:            Keyspider
 * Author URI:        Keyspider.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       keyspider-search
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.1.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'KEYSPIDER_SEARCH_VERSION', '1.1.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-keyspider-search-activator.php
 */
function activate_keyspider_search() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-keyspider-search-activator.php';
	Keyspider_Search_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-keyspider-search-deactivator.php
 */
function deactivate_keyspider_search() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-keyspider-search-deactivator.php';
	Keyspider_Search_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_keyspider_search' );
register_deactivation_hook( __FILE__, 'deactivate_keyspider_search' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-keyspider-search.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_keyspider_search() {

	$plugin = new Keyspider_Search();
	$plugin->run();

}
run_keyspider_search();
