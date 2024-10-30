<?php

/**
 * Implementation of the admin actions.
 * 
 *
 */
class Keyspider_Search_Admin_Action 
{

    /**
     * @var string
     */
    private $organization_id;

    /**
     * @var string
     */
    private $api_key;

    /**
     * Constructor.
     */
    public function __construct()
    {

        \add_action('admin_init', function() {
          if (\current_user_can('manage_options')) {
              $this->installHooks();
          }
        });
    }

    /**
     * Install hooks for the admin actions.
     */
    public function installHooks() {
        
        \add_action('admin_action_keyspider_set_api_key', [$this, 'setApiKey']);
       
    }

    /**
     * Admin action used to configure API Key.
     */
    public function setApiKey()
    {
        $redirectParams = [];

        $organization_id = sanitize_text_field(trim($_POST['keyspider_organization_id']));
        $api_key = sanitize_text_field(trim($_POST['keyspider_api_key']));
        $keyspider_search_page = sanitize_text_field(trim($_POST['keyspider_search_page']));
        
        update_option( 'keyspider_organization_id' , $organization_id );
        update_option( 'keyspider_api_key' , $api_key );
        update_option( 'keyspider_search_page' , $keyspider_search_page );


        $redirectParams['success'] = true;
        
        check_ajax_referer('keyspider-ajax-nonce');

        if (null === get_option('keyspider_api_key') ) {
            $redirectParams['error'] = true;
        }

        $this->redirect($redirectParams);
    }

    

    /**
     * Admin action used to reset the config.
     */
    public function clearConfig()
    {
        \check_ajax_referer('keyspider-ajax-nonce');

        $this->getConfig()->reset();
        $this->redirect();
    }

    /**
     * Redirect to Keyspider Admin homepage.
     *
     * @param array $params
     */
    private function redirect($params = [])
    {
        $params['page'] = Keyspider_Search_Admin::MENU_SLUG;
        $redirectUrl = \add_query_arg($params, \admin_url());
        \wp_redirect($redirectUrl);
    }

    
}
