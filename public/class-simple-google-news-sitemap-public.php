<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Simple_Google_News_Sitemap
 * @subpackage Simple_Google_News_Sitemap/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Simple_Google_News_Sitemap
 * @subpackage Simple_Google_News_Sitemap/public
 * @author     Jonathan Harris <jon@spacedmonkey.co.uk>
 */
class Simple_Google_News_Sitemap_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $simple_google_news_sitemap    The ID of this plugin.
	 */
	private $simple_google_news_sitemap;

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
	 * @var      string    $simple_google_news_sitemap       The name of the plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $simple_google_news_sitemap, $version ) {

		$this->simple_google_news_sitemap = $simple_google_news_sitemap;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_Google_News_Sitemap_Public_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_Google_News_Sitemap_Public_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->simple_google_news_sitemap, plugin_dir_url( __FILE__ ) . 'css/simple-google-news-sitemap-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_Google_News_Sitemap_Public_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_Google_News_Sitemap_Public_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->simple_google_news_sitemap, plugin_dir_url( __FILE__ ) . 'js/simple-google-news-sitemap-public.js', array( 'jquery' ), $this->version, false );

	}

}
