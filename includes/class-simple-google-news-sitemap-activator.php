<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.spacedmonkey.com
 * @since      1.0.0
 *
 * @package    Simple_Google_News_Sitemap
 * @subpackage Simple_Google_News_Sitemap/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Simple_Google_News_Sitemap
 * @subpackage Simple_Google_News_Sitemap/includes
 * @author     Jonathan Harris <jon@spacedmonkey.co.uk>
 */
class Simple_Google_News_Sitemap_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		flush_rewrite_rules();
	}

}
