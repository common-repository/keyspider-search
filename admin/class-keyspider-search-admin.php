<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       Keyspider
 * @since      1.0.0
 *
 * @package    Keyspider_Search
 * @subpackage Keyspider_Search/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Keyspider_Search
 * @subpackage Keyspider_Search/admin
 * @author     Keyspider <Keyspider>
 */
class Keyspider_Search_Admin {

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
     * @var string
     */
    const MENU_TITLE = 'Keyspider Search';

    /**
     * @var string
     */
    const MENU_SLUG  = 'keyspider-search';

    /**
     * @var string
     */
    const MENU_ICON  = 'assets/keyspider_logo_menu.png';


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		\add_action('admin_menu', [$this, 'addMenu']);

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/keyspider-search-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/keyspider-search-admin.js', array( 'jquery' ), $this->version, false );

	}


	/**
     * Add the Keyspider search entry to the admin menu.
     */
    public function addMenu()
    {
        if (\current_user_can('manage_options')) {
          \add_menu_page(self::MENU_TITLE, SELF::MENU_TITLE, 'manage_options', SELF::MENU_SLUG, [$this, 'getContent'], $this->getIconUrl());
        }
    }

    /**
     * Display admin page content.
     */
    public function getContent()
    {
        if (\current_user_can('manage_options')) {


        	$this->renderTemplate('authorize.php');


            /*$isAuth = $this->getConfig()->getApiKey() && $this->getClient() !== null;

            if($this->error) {
                $this->renderTemplate('error.php');
            } else if (!$isAuth) {
                $this->renderTemplate('authorize.php');
            } else if (!$this->getConfig()->getEngineSlug() || null === $this->engine) {
                $this->renderTemplate('choose-engine.php');
            } else {
                $this->renderTemplate('controls.php');
            }*/
        }
    }


	/**
     * Return menu icon URL.
     *
     * @return string
     */
    private function getIconUrl()
    {
        return \plugins_url(self::MENU_ICON, __DIR__ . '/../keyspider-search.php');
    }

    /**
     * Locate and render a template.
     *
     * @param string $templateFile
     */
    private function renderTemplate($templateFile)
    {
        include(sprintf("%s/%s", $this->getTemplateDir(), $templateFile));
    }

    /**
     * Get the template directory.
     *
     * @return string
     */
    private function getTemplateDir()
    {
        return sprintf("%s/templates", __DIR__);
    }

}
