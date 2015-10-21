<?php

/**
 * Adds a Google news sitemap to your WordPress site
 *
 * @link              http://www.jonathandavidharris.co.uk
 * @since             1.0.4
 * @package           Simple_Google_News_Sitemap
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Google News Sitemap
 * Plugin URI:        https://github.com/spacedmonkey/simple-google-news-sitemap
 * Description:       Adds a Google news sitemap to your WordPress site.
 * Version:           1.1.1
 * Author:            Jonathan Harris
 * Author URI:        http://www.jonathandavidharris.co.uk/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       simple-google-news-sitemap
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-simple-google-news-sitemap-activator.php
 */
function activate_simple_google_news_sitemap() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-google-news-sitemap-activator.php';
	Simple_Google_News_Sitemap_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-simple-google-news-sitemap-deactivator.php
 */
function deactivate_simple_google_news_sitemap() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-google-news-sitemap-deactivator.php';
	Simple_Google_News_Sitemap_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_simple_google_news_sitemap' );
register_deactivation_hook( __FILE__, 'deactivate_simple_google_news_sitemap' );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-simple-google-news-sitemap.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_simple_google_news_sitemap() {

	$plugin = new Simple_Google_News_Sitemap();
	$plugin->run();

}
run_simple_google_news_sitemap();
