<?php
$bill_fields = array(
    "bill_header", "bill_title", "bill_footer", "bill_admin_email",
);

add_action('admin_menu', 'add_bills_settings_page');

function add_bills_settings_page(){
    global $menuname, $bill_fields;
    
    add_submenu_page($menuname, //Menu ID – Defines the unique id of the menu that we want to link our submenu to. 
                                    //To link our submenu to a custom post type page we must specify - 
                                    //edit.php?post_type=my_post_type
            __('Bills Options'), // Page title
            __('Bills Options'), // Menu title
            'edit_themes', // Capability - see: http://codex.wordpress.org/Roles_and_Capabilities#Capabilities
            'bills_options', // Submenu ID – Unique id of the submenu.
            'bills_options_page' // render output function
        );
    
    if ($_GET['page'] == 'bills_options') {
        if (isset($_REQUEST['action']) and 'save' == $_REQUEST['action']) {
            foreach ($bill_fields as $field) {
                if (isset($_REQUEST[$field])) {
                    if(is_array($_REQUEST[$field])){
                        update_option($field, json_encode($_REQUEST[$field]));
                    }else{
                        update_option($field, $_REQUEST[$field]);
                    }
                } else {
                    delete_option($field);
                }
            }
            header("Location: {$_SERVER['REQUEST_URI']}&saved=true");
            die();
        } 
    }
}
/**
 * Bills settings ouput
 * 
 * @global string $themename
 */
function bills_options_page() {
?>
    <div class="wrap">
        <div class="opwrap" style="margin-top: 10px;" >
            <div class="icon32" id="icon-options-general"></div>
            <h2 class="wraphead">Bills Options</h2>
    <?php
    if (isset($_REQUEST['saved']))
        echo '<div id="message" class="updated fade"><p><strong>Bills Options saved.</strong></p></div>';
    ?>
            <form method="post">
                <h3>Bills Options</h3>
                <table class="form-table">
                    <tr>
                        <th><label for="bill_admin_email">Admin Order Email</label></th>
                        <td>
                            <input type="text" name="bill_admin_email" id="bill_admin_email" value="<?php echo stripslashes(get_settings('bill_admin_email'));?>" class="regular-text" /><br />
                            <span class="description">Địa chỉ email nhận đơn đặt hàng của khách hàng.</span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="bill_header">Bill header</label></th>
                        <td>
                            <input type="text" name="bill_header" id="bill_header" value="<?php echo stripslashes(get_settings('bill_header'));?>" class="regular-text" />
                            <input type="button" id="upload_bill_header_button" class="button button-upload" value="Upload" /><br />
                            <span class="description"></span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="bill_title">Bill title</label></th>
                        <td>
                            <input type="text" name="bill_title" id="bill_title" value="<?php echo stripslashes(get_settings('bill_title'));?>" class="regular-text" /><br />
                            <span class="description"></span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="bill_footer">Bill Footer</label></th>
                        <td>
                            <?php 
                            wp_editor(stripslashes(get_settings('bill_footer')), 'bill_footer', array(
                                'textarea_name' => 'bill_footer',
                            ));
                            ?>
                            <br />
                            <span class="description"></span>
                        </td>
                    </tr>
                </table>
                <div class="submit">
                    <input name="save" type="submit" value="Save changes" class="button button-large button-primary" />
                    <input type="hidden" name="action" value="save" />
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">/* <![CDATA[ */
        jQuery(function($){
            $(".submit input[type='submit']").click(function(){
                tinyMCE.triggerSave();
            });
        });
        /* ]]> */
    </script>
<?php
}
?>