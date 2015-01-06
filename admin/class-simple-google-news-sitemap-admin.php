<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Simple_Google_News_Sitemap
 * @subpackage Simple_Google_News_Sitemap/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Simple_Google_News_Sitemap
 * @subpackage Simple_Google_News_Sitemap/admin
 * @author     Jonathan Harris <jon@spacedmonkey.co.uk>
 */
class Simple_Google_News_Sitemap_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $plugin_name       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function admin_init(){
		// Register a setting and its sanitization callback
        register_setting(
            'general', // Option group
            $this->plugin_name // Option name
        );
         
        //  Add a new section to a settings page.
        add_settings_section(
            $this->plugin_name, // ID
            __('Google News Sitemaps Options', 'simple-google-news-sitemap'),
            array( $this, 'print_section_info' ), // Callback
            'general'
        );
     	
     	// Add the post_type_slug field to the section of the settings page
        add_settings_field(
            $this->plugin_name, // ID
            __('Limit Post Category', 'simple-google-news-sitemap'),
            array( $this, 'settings_markup' ), // Callback
            'general', // Page
            $this->plugin_name
        );
            
	}

	public function settings_markup(){
		$value = get_option($this->plugin_name, array('sgns_category' => 0));
		wp_dropdown_categories( array('show_option_all' => __('Show all categories', 'simple-google-news-sitemap'),'hide_empty' => 0,'selected' => $value['sgns_category'],'name' => $this->plugin_name.'[sgns_category]') );
	}

	public function print_section_info(){
		_e('Only show posts from this category in the news feed', 'simple-google-news-sitemap');
	}


}
