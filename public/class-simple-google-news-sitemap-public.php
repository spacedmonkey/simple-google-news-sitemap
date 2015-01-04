<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.jonathandavidharris.co.uk
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
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string $plugin_name The name of the plugin.
	 * @var      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 *
	 */
	public function init() {
		add_rewrite_rule('sitemap_news\.xml$', 'index.php?'.$this->plugin_name.'=1', 'top' );
	}

	/**
	 *
	 */
	public function template_redirect() {
		if ( get_query_var( $this->plugin_name ) === '1' ) {
			include 'partials/simple-google-news-sitemap-public-display.php';
			exit();
		}
	}

	/**
	 * Hook into redirect_canonical to stop trailing slashes on sitemap.xml URLs
	 *
	 * @param string $redirect The redirect URL currently determined.
	 *
	 * @return bool|string $redirect
	 */
	public function canonical( $redirect ) {
		$site_map = get_query_var( $this->plugin_name );
		if ( ! empty( $site_map ) ) {
			return false;
		}

		return $redirect;
	}

	/**
	 * @param $query
	 */
	public function pre_get_posts( $query ) {

		if ( !is_admin() && $query->is_main_query() && isset($query->query_vars[$this->plugin_name]) && $query->query_vars[$this->plugin_name] == '1') {


			$query->set( 'post_type', 'post' );

			$query->set( 'date_query', array(
					array(
						'column' => 'post_date_gmt',
						'after'  => '2 days ago',
					)
				)
			);
			$query->set( 'posts_per_page', 1000 );

		}
	}

	/**
	 * @param $content_type
	 * @param $type
	 *
	 * @return mixed
	 */
	public function feed_content_type( $content_type, $type ) {
		if($type == $this->plugin_name){
			$content_type = 'text/xml';
		}

		return $content_type;

		return $content_type;
	}

	/**
	 * @param $query_vars
	 *
	 * @return array
	 */
	public function query_vars( $query_vars ) {
		$query_vars[] = $this->plugin_name;

		return $query_vars;
	}
}
