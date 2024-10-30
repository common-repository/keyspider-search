<?php
/**
 * Keyspider search configuration admin template.
 *
 * @var \Keyspider\Admin\Page $this
 */
?>

<div class="wrap">

    <?php include('common/header.php'); ?>

    <div class="keyspider-admin">
        <div class="main-content">

            
            <div class="config-card">
                <?php if ( null == get_option('keyspider_api_key') ): ?>
                    
                    <p>
                      <?php  _e('Find your API Key at the Mapping section of the Keyspider search dashboard. Please refer <b><a href="https://docs.keyspider.io/docs/api-key/" target="_new">Documentation</b></a> for more.', 'keyspider-search'); ?>
                    </p>

                    <hr>
                <?php endif; ?>

                
                
                <p><?php  _e("Enter your Organization ID and API key in the field below and click Submit to get started.", 'keyspider-search'); ?></p>
                <form name="keyspider_settings" method="post" action="<?php echo \esc_url(\admin_url()); ?>">
                    <?php wp_nonce_field('keyspider-ajax-nonce'); ?>
                    <input type="hidden" name="action" value="keyspider_set_api_key">
                    <table class="form-table">

                            <tr>
                                <th scope="row"><label for="keyspider_organization_id">Organization ID</label></th>
                                <td><input class="regular-text" type="text" id="keyspider_organization_id" name="keyspider_organization_id" value="<?php echo esc_attr(get_option('keyspider_organization_id')); ?>"  autocomplete="off"/></td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="keyspider_api_key">API Key</label></th>
                                <td><input class="regular-text" type="text" id="keyspider_api_key" name="keyspider_api_key" value="<?php echo esc_attr(get_option('keyspider_api_key')); ?>"  autocomplete="off" /></td>
                            </tr>

                            <tr>
                                <th scope="row"><label for="keyspider_search_page">Search Page Path/Slug</label></th>
                                <td><input class="regular-text" type="text" id="keyspider_search_page" name="keyspider_search_page" value="<?php echo esc_attr(get_option('keyspider_search_page')); ?>"  autocomplete="off" /></td>
                            </tr>

                            <tr>
                                <th scope="row"></th>
                                <td><input type="submit" name="Submit" value="Submit" class="button-primary" /></td>
                            </tr>

                    </table>
                            
                       
                </form>

                <?php
                 if ( @$_REQUEST['success'] == true ): ?>
                    <div class="success">
                        <div class="notice notice-success is-dismissible"> 
                            <p><strong><?php _e('Configuration settings saved.', 'keyspider-search') ?></strong></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ( isset($_REQUEST['error'])): ?>
                    <div class="warning">
                        <div class="notice notice-warning is-dismissible"> 
                            <p><strong><?php _e('Something went wrong, Please try again.', 'keyspider-search') ?></strong></p>
                        </div>
                    </div>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
</div>
