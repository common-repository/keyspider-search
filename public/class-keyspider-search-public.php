<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       Keyspider
 * @since      1.0.0
 *
 * @package    Keyspider_Search
 * @subpackage Keyspider_Search/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Keyspider_Search
 * @subpackage Keyspider_Search/public
 * @author     Keyspider <Keyspider>
 */
class Keyspider_Search_Public {

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
     * List of sub-components that will be initialized by the plugins.
     * @var array
     */
    private $components = [
        \Keyspider\Wordpress\Search\PageTemplate::class,
    ];

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->registerComponents();
		$this->createKeyspiderSearchform();

	}

	/**
     * Instantiate all sub-components required by the plugin.
     *
     */
    private function registerComponents()
    {
        foreach ($this->components as $component) {
            new $component();
        }
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
		 * defined in Keyspider_Search_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Keyspider_Search_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/keyspider-search-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Keyspider_Search_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Keyspider_Search_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/keyspider-search-public.js', array( 'jquery' ), $this->version, false );

	}



	/**
	 * Insert the Keyspider install JavaScript in wp_footer for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	function keyspider_footer_scripts(){

		/**
		 * This function is used for global script insert.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Keyspider_Search_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Keyspider_Search_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		/*Keyspider organizationId and API key*/
		$organizationId = get_option('keyspider_organization_id');
  		$apiKey = get_option('keyspider_api_key');
  		$keyspider_search_page = site_url().get_option('keyspider_search_page');
  		

  		/*Parsing in Keyspider JS library*/
  		wp_register_script( 'keyspider-js-footer', false);
		wp_enqueue_script( 'keyspider-js-footer' );
		wp_add_inline_script( 'keyspider-js-footer', 'window.addEventListener("load", function () {
		window.searchInit && window.searchInit("'. esc_js($apiKey) .'", "'. esc_js($organizationId) .'", "'. esc_js($keyspider_search_page) .'","q");
		window.searchOnlyInit && window.searchOnlyInit("'. esc_js($apiKey) .'", "'. esc_js($organizationId) .'", "'. esc_js($keyspider_search_page) .'","q");
		});');

	}


	/**
     * Creating shortcode for Keyspider search form.
     *
     */
    private function createKeyspiderSearchform()
    {
        
		function keyspider_searchform() { 
		 
		// form html tags, it will use by keyspider library script and override HTML form
		$search_form = '<div class="dashboard-search"></div>
					<div class="dashboard-search-results"></div>
					<div class="dashboard-search-pagination"></div>'; 
		 
		return $search_form;
		} 
		// register shortcode
		add_shortcode('keyspidersearch', 'keyspider_searchform'); 


		function keyspider_searchform_widget() { 
		 
		// form html tags, it will use by keyspider library script and override HTML form
		$search_form = '<div class="dashboard-search-only"></div>'; 
		 
		return $search_form;
		} 
		// register shortcode
		add_shortcode('keyspidersearchform', 'keyspider_searchform_widget'); 

    }




}
