<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the dashboard.
 *
 * @link       http://www.spacedmonkey.com
 * @since      1.0.0
 *
 * @package    Simple_Google_News_Sitemap
 * @subpackage Simple_Google_News_Sitemap/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, dashboard-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Simple_Google_News_Sitemap
 * @subpackage Simple_Google_News_Sitemap/includes
 * @author     Jonathan Harris <jon@spacedmonkey.co.uk>
 */
class Simple_Google_News_Sitemap {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Simple_Google_News_Sitemap_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the Dashboard and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'simple-google-news-sitemap';
		$this->version = '1.1.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Simple_Google_News_Sitemap_Loader. Orchestrates the hooks of the plugin.
	 * - Simple_Google_News_Sitemap_i18n. Defines internationalization functionality.
	 * - Simple_Google_News_Sitemap_Admin. Defines all hooks for the dashboard.
	 * - Simple_Google_News_Sitemap_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-simple-google-news-sitemap-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-simple-google-news-sitemap-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-simple-google-news-sitemap-public.php';

		/**
		 * The class responsible for defining all actions that occur in the admin-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-simple-google-news-sitemap-admin.php';

		$this->loader = new Simple_Google_News_Sitemap_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Simple_Google_News_Sitemap_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Simple_Google_News_Sitemap_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the dashboard functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Simple_Google_News_Sitemap_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_init', $plugin_admin, 'admin_init' );

	}


	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Simple_Google_News_Sitemap_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_filter( 'feed_content_type', $plugin_public, 'feed_content_type', 10, 2 );
		$this->loader->add_filter( 'query_vars', $plugin_public, 'query_vars' );
		$this->loader->add_filter( 'redirect_canonical', $plugin_public, 'canonical' );

		$this->loader->add_action( 'init', $plugin_public, 'init', 1 );
		$this->loader->add_action( 'pre_get_posts', $plugin_public, 'pre_get_posts' );
		$this->loader->add_action( 'template_redirect', $plugin_public, 'template_redirect' );

		// Add hock for split_shared_term
		$this->loader->add_action( 'split_shared_term', $this, 'split_shared_term', 10, 4 );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Simple_Google_News_Sitemap_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 *
	 * Support for WordPress 4.2 split terms. 
	 *
	 * @since     1.1.0
	 */
	public function split_shared_term( $old_term_id, $new_term_id, $term_taxonomy_id, $taxonomy ) {
	   	$setting_name = $this->get_plugin_name();
	    $settings = get_option( $setting_name, array() );
	 
	    // Check to see whether the stored category ID is the one that's just been split.
	    if ( isset( $fsettings['sgns_category'] ) && $old_term_id == $fsettings['sgns_category'] && 'category' == $taxonomy ) {
	        // We have a match, so we swap out the old category ID for the new one and resave the option.
	        $settings['sgns_category'] = $new_term_id;
	        update_option( $setting_name, $settings );
	    }
	}


}
