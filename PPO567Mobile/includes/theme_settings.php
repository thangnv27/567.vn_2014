<?php
$menuname = $shortname . "_settings"; // Required

$pages = get_pages();
$page_list = array();
foreach ($pages as $page) {
    $page_list[$page->ID] = $page->post_title;
}
$categories = get_categories();
$category_list = array();
foreach ($categories as $category) {
    $category_list[$category->term_id] = $category->name;
}

$options = array(
    array("name" => "Theo dõi trên mạng xã hội",
        "type" => "title",
        "desc" => "Tùy chỉnh Follow us.",
    ),
    array("type" => "open"),
    array("name" => "Facebook",
        "desc" => "Nhập URL page của bạn trên facebook.",
        "id" => $shortname . "_fbURL",
        "std" => "",
        "type" => "text"),
    array("name" => "Google plus",
        "desc" => "Nhập URL page của bạn trên Google plus.",
        "id" => $shortname . "_googlePlusURL",
        "std" => "",
        "type" => "text"),
    array("name" => "Twitter",
        "desc" => "Nhập URL page của bạn trên Twitter.",
        "id" => $shortname . "_twitterURL",
        "std" => "",
        "type" => "text"),
    array("name" => "Linked In",
        "desc" => "Nhập URL page của bạn trên Linked In.",
        "id" => $shortname . "_linkedInURL",
        "std" => "",
        "type" => "text"),
    array("name" => "Youtube",
        "desc" => "Nhập URL page của bạn trên Youtube.",
        "id" => $shortname . "_youtubeURL",
        "std" => "",
        "type" => "text"),
    array("name" => "Pinterest",
        "desc" => "Nhập URL page của bạn trên Pinterest.",
        "id" => $shortname . "_pinterestURL",
        "std" => "",
        "type" => "text"),
    array("type" => "close"),
    
    array("name" => "Giỏ hàng",
        "type" => "title",
        "desc" => "Tùy chọn giỏ hàng.",
    ),
    array("type" => "open"),
    array("name" => "Số lượng tối đa cho 1 sản phẩm",
        "desc" => "Số lượng tối đa cho 1 sản phẩm trong đơn hàng. Ví dụ: 10",
        "id" => $shortname . "_maxQuantity",
        "std" => '',
        "type" => "text"),
    array("type" => "close"),
    
    array("name" => "Danh mục",
        "type" => "title",
        "desc" => "",
    ),
    array("type" => "open"),
    array("name" => "Giới thiệu",
        "desc" => "Nhập ID danh mục giới thiệu.",
        "id" => $shortname . "_catIntroID",
        "std" => '',
        "type" => "select",
        "options" => $category_list),
    array("name" => "Trợ giúp",
        "desc" => "Nhập ID danh mục trợ giúp.",
        "id" => $shortname . "_catHelpID",
        "std" => '',
        "type" => "select",
        "options" => $category_list),
    array("name" => "Hợp tác",
        "desc" => "Nhập ID danh mục hợp tác.",
        "id" => $shortname . "_catCooperateID",
        "std" => '',
        "type" => "select",
        "options" => $category_list),
    array("type" => "close"),
    
    array("name" => "Pages",
        "type" => "title",
        "desc" => "Tùy chọn trang.",
    ),
    array("type" => "open"),
    array("name" => "Trang mua hàng",
        "desc" => "Nhập ID trang mua hàng.",
        "id" => $shortname . "_pageBuyID",
        "std" => '',
        "type" => "select",
        "options" => $page_list),
    array("type" => "close"),
    
    array("name" => "Banner",
        "type" => "title",
        "desc" => "",
    ),
    array("type" => "open"),
    array("name" => "Embed home",
        "desc" => "Nhúng mã quảng cáo ở trang chủ.",
        "id" => $shortname . "_embedHome",
        "std" => '',
        "type" => "textarea"),
    array("name" => "Embed archive product",
        "desc" => "Nhúng mã quảng cáo ở trang danh mục sản phẩm.",
        "id" => $shortname . "_embedArchiveProduct",
        "std" => '',
        "type" => "textarea"),
    array("type" => "close"),
    
    array("name" => "Hỗ trợ trực tuyến",
        "type" => "title",
        "desc" => "",
    ),
    array("type" => "open"),
    array("name" => "Tư vấn 1",
        "desc" => "Nhập nick yahoo.",
        "id" => $shortname . "_yahoo1",
        "std" => '',
        "type" => "text"),
    array("name" => "Tư vấn 2",
        "desc" => "Nhập nick yahoo.",
        "id" => $shortname . "_yahoo2",
        "std" => '',
        "type" => "text"),
    array("type" => "close"),
    
    array("name" => "Tùy chọn khác",
        "type" => "title",
        "desc" => "Tìm chỉnh website.",
    ),
    array("type" => "open"),
    array("name" => "Header text (Sologan)",
        "desc" => "Dòng text hiển thị ở header",
        "id" => $shortname . "_sologan",
        "std" => '',
        "type" => "text"),
    array("name" => "Facebook App ID",
        "desc" => "Nhập ID App Facebook quản lý comment",
        "id" => $shortname . "_appFBID",
        "std" => '',
        "type" => "text"),
    array("type" => "open"),
    array("name" => "Link DMCA",
        "desc" => "Nhập link DMCA chứng thực website của bạn.",
        "id" => $shortname . "_linkDMCA",
        "std" => '',
        "type" => "text"),
    array("name" => "Hotline",
        "desc" => "Nhập số điện thoại hỗ trợ. Ví dụ: 096.4747.046",
        "id" => $shortname . "_hotline",
        "std" => '',
        "type" => "text"),
    array("name" => "Hotline Footer",
        "desc" => "Nhập số điện thoại hỗ trợ hiển thị ở cuối trang. Ví dụ: 096.4747.046",
        "id" => $shortname . "_hotline_footer",
        "std" => '',
        "type" => "text"),
    array("name" => "Fax",
        "desc" => "Nhập số Fax. Ví dụ: 04 373 40121",
        "id" => $shortname . "_fax",
        "std" => '',
        "type" => "text"),
    array("name" => "Thời gian làm việc",
        "desc" => "",
        "id" => $shortname . "_timeWork",
        "std" => '',
        "type" => "text"),
    array("name" => "Link Fanpage trên facebook",
        "desc" => "URL page facebook. Ví dụ: https://www.facebook.com/ppo.vn",
        "id" => $shortname . "_fbPage",
        "std" => '',
        "type" => "text"),
    array("name" => "Google Analytics",
        "desc" => "Google Analytics. Ví dụ: UA-23200894-1",
        "id" => $shortname . "_gaID",
        "std" => "UA-23200894-1",
        "type" => "text"),
    array("type" => "close"),
);

$fields = array(
    "keywords_meta", "description_meta", "favicon", "sitelogo", 
    "tooltip5", "tooltip6", "tooltip7",
    "contact_info", "footer_info", "hotline", "phone_support", "camket_giaohang", "camket_doihang", "camket_hoantien", "icon_giaohang", "icon_doihang", "icon_hoantien", "icon_dienthoai",
);

/**
 * Add actions
 */
add_action('admin_init', 'theme_settings_init');
add_action('admin_menu', 'add_settings_page');

/**
 * Register settings
 */
function theme_settings_init(){
    register_setting( "theme_settings", "theme_settings");
}

/**
 * Add settings page menu
 */
function add_settings_page(){
    global $themename, $shortname, $menuname, $options, $fields;
    
    add_menu_page(__($themename . ' Settings'), // Page title
            __($themename.' Settings'), // Menu title
            'manage_options', // Capability - see: http://codex.wordpress.org/Roles_and_Capabilities#Capabilities
            $menuname, // menu id - Unique id of the menu
            'theme_settings_page',// render output function
            '', // URL icon, if empty default icon
            null // Menu position - integer, if null default last of menu list
        );
    
    //Add submenu page
    add_submenu_page($menuname, //Menu ID – Defines the unique id of the menu that we want to link our submenu to. 
                                    //To link our submenu to a custom post type page we must specify - 
                                    //edit.php?post_type=my_post_type
            __('Theme Options'), // Page title
            __('Theme Options'), // Menu title
            'edit_themes', // Capability - see: http://codex.wordpress.org/Roles_and_Capabilities#Capabilities
            'theme_options', // Submenu ID – Unique id of the submenu.
            'theme_options_page' // render output function
        );
    
    //add_theme_page("$themename Options", "$themename Options", 'edit_themes', 'theme_options', 'theme_options_page');

    /*-------------------------------------------------------------------------*/
    # Theme general settings
    /*-------------------------------------------------------------------------*/
    if ($_GET['page'] == $shortname . '_settings') {
        if (isset($_REQUEST['action']) and 'save' == $_REQUEST['action']) {
            foreach ($fields as $field) {
                update_option($field, $_REQUEST[$field]);
            }
            foreach ($fields as $field) {
                if (isset($_REQUEST[$field])) {
                    update_option($field, $_REQUEST[$field]);
                } else {
                    delete_option($field);
                }
            }
            header("Location: {$_SERVER['REQUEST_URI']}&saved=true");
            die();
        } 
    }
    /*-------------------------------------------------------------------------*/
    # Theme options processing
    /*-------------------------------------------------------------------------*/
    if ($_GET['page'] == 'theme_options') {
        if (isset($_REQUEST['action']) and 'save' == $_REQUEST['action']) {
            foreach ($options as $value) {
                update_option($value['id'], $_REQUEST[$value['id']]);
            }
            foreach ($options as $value) {
                if (isset($_REQUEST[$value['id']])) {
                    update_option($value['id'], $_REQUEST[$value['id']]);
                } else {
                    delete_option($value['id']);
                }
            }
            header("Location: {$_SERVER['REQUEST_URI']}&saved=true");
            die();
        } else if (isset($_REQUEST['action']) and 'reset' == $_REQUEST['action']) {
            foreach ($options as $value) {
                delete_option($value['id']);
                update_option($value['id'], $value['std']);
            }
            header("Location: {$_SERVER['REQUEST_URI']}&reset=true");
            die();
        }
    }
    
    /*-------------------------------------------------------------------------*/
    # Retitle for first sub-menu
    /*-------------------------------------------------------------------------*/
    global $submenu;
    if(isset($submenu[$shortname . '_settings'][0][0]) and $submenu[$shortname . '_settings'][0][0] == $themename . ' Settings'){
        $submenu[$shortname . '_settings'][0][0] = 'General Settings';
    }
}

/**
 * Remove an Existing Sub-Menu
 */
function remove_settings_submenu($menu_name, $submenu_name) {
    global $submenu;
    $menu = $submenu[$menu_name];
    if (!is_array($menu)) return;
    foreach ($menu as $submenu_key => $submenu_object) {
        if (in_array($submenu_name, $submenu_object)) {// remove menu object
            unset($submenu[$menu_name][$submenu_key]);
            return;
        }
    }          
}

/**
 * Theme general settings ouput
 * 
 * @global string $themename
 */
function theme_settings_page() {
    global $themename;
?>
    <div class="wrap">
        <div class="opwrap" style="margin-top: 10px;" >
            <div class="icon32" id="icon-options-general"></div>
            <h2 class="wraphead"><?php echo $themename; ?> theme general settings</h2>
    <?php
    if (isset($_REQUEST['saved']))
        echo '<div id="message" class="updated fade"><p><strong>' . $themename . ' settings saved.</strong></p></div>';
    ?>
            <form method="post">
                <h3>Site Options</h3>
                <table class="form-table">
                    <tr>
                        <th><label for="keywords_meta">Keywords meta</label></th>
                        <td>
                            <input type="text" name="keywords_meta" id="keywords_meta" value="<?php echo stripslashes(get_settings('keywords_meta'));?>" class="regular-text" />
                            <br />
                            <span class="description">Enter the meta keywords for all pages. These are used by search engines to index your pages with more relevance.</span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="favicon">Favicon</label></th>
                        <td>
                            <input type="text" name="favicon" id="favicon" value="<?php echo stripslashes(get_settings('favicon'));?>" class="regular-text" />
                            <input type="button" id="upload_favicon_button" class="button button-upload" value="Upload" />
                            <br />
                            <span class="description">An icon associated with a particular website, and typically displayed in the address bar of a browser viewing the site.</span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="sitelogo">Logo</label></th>
                        <td>
                            <input type="text" name="sitelogo" id="sitelogo" value="<?php echo stripslashes(get_settings('sitelogo'));?>" class="regular-text" />
                            <input type="button" id="upload_sitelogo_button" class="button button-upload" value="Upload" /><br />
                            <span class="description">Size: 320x80</span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="hotline">Hotline</label></th>
                        <td>
                            <input type="text" name="hotline" id="hotline" value="<?php echo stripslashes(get_settings('hotline'));?>" class="regular-text" />
                            <input type="button" id="upload_hotline_button" class="button button-upload" value="Upload" /><br />
                            <span class="description"></span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="tooltip5">5 lý do bạn nên chọn chúng tôi</label></th>
                        <td>
                            <?php 
                            wp_editor(stripslashes(get_settings('tooltip5')), 'tooltip5', array(
                                'textarea_name' => 'tooltip5',
                            ));
                            ?>
                            <br />
                            <span class="description"></span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="tooltip6">6 cam kết khẳng định chất lượng</label></th>
                        <td>
                            <?php 
                            wp_editor(stripslashes(get_settings('tooltip6')), 'tooltip6', array(
                                'textarea_name' => 'tooltip6',
                            ));
                            ?>
                            <br />
                            <span class="description"></span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="tooltip7">7 ngày chúng tôi phục vụ</label></th>
                        <td>
                            <?php 
                            wp_editor(stripslashes(get_settings('tooltip7')), 'tooltip7', array(
                                'textarea_name' => 'tooltip7',
                            ));
                            ?>
                            <br />
                            <span class="description"></span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="contact_info">Footer contact information</label></th>
                        <td>
                            <?php 
                            wp_editor(stripslashes(get_settings('contact_info')), 'contact_info', array(
                                'textarea_name' => 'contact_info',
                                'textarea_rows' => 15,
                            ));
                            ?>
                            <br />
                            <span class="description">Thông tin liên hệ ở cuối trang.</span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="footer_info">Footer information</label></th>
                        <td>
                            <?php 
                            wp_editor(stripslashes(get_settings('footer_info')), 'footer_info', array(
                                'textarea_name' => 'footer_info',
                                'textarea_rows' => 15,
                            ));
                            ?>
                            <br />
                            <span class="description">Thông tin ở cuối trang.</span>
                        </td>
                    </tr>
                </table>
                <h3>Tùy chỉnh cam kết</h3>
                <table class="form-table">
                    <tr>
                        <th><label for="icon_giaohang">Icon giao hàng</label></th>
                        <td>
                            <input type="text" name="icon_giaohang" id="icon_giaohang" value="<?php echo stripslashes(get_settings('icon_giaohang'));?>" class="regular-text" />
                            <input type="button" id="upload_icon_giaohang_button" class="button button-upload" value="Upload" /><br />
                            <span class="description">Kích thước hình ảnh 63x54</span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="camket_giaohang">Cam kết giao hàng</label></th>
                        <td>
                            <?php 
                            wp_editor(stripslashes(get_settings('camket_giaohang')), 'camket_giaohang', array(
                                'textarea_name' => 'camket_giaohang',
                                'textarea_rows' => 10,
                            ));
                            ?>
                            <br />
                            <span class="description">Thông tin cam kết giao hàng.</span>
                        </td>
                    </tr>
                    <tr>
                            <th><label for="icon_doihang">Icon đổi hàng</label></th>
                            <td>
                                <input type="text" name="icon_doihang" id="icon_doihang" value="<?php echo stripslashes(get_settings('icon_doihang')); ?>" class="regular-text" />
                                <input type="button" id="upload_icon_doihang_button" class="button button-upload" value="Upload" />
                                <br />
                                <span class="description">Kích thước hình ảnh 63x54</span>
                            </td>
                        </tr>
                    <tr>
                        <th><label for="camket_doihang">Cam kết đổi hàng</label></th>
                        <td>
                            <?php 
                            wp_editor(stripslashes(get_settings('camket_doihang')), 'camket_doihang', array(
                                'textarea_name' => 'camket_doihang',
                                'textarea_rows' => 10,
                            ));
                            ?>
                            <br />
                            <span class="description">Thông tin cam kết đổi hàng</span>
                        </td>
                    </tr>
                    <tr>
                            <th><label for="icon_hoantien">Icon hoàn tiền</label></th>
                            <td>
                                <input type="text" name="icon_hoantien" id="icon_hoantien" value="<?php echo stripslashes(get_settings('icon_hoantien')); ?>" class="regular-text" />
                                <input type="button" id="upload_icon_hoantien_button" class="button button-upload" value="Upload" />
                                <br />
                                <span class="description">Kích thước hình ảnh 63x54</span>
                            </td>
                        </tr>
                    <tr>
                        <th><label for="camket_hoantien">Cam kết hoàn tiền</label></th>
                        <td>
                            <?php 
                            wp_editor(stripslashes(get_settings('camket_hoantien')), 'camket_hoantien', array(
                                'textarea_name' => 'camket_hoantien',
                                'textarea_rows' => 10,
                            ));
                            ?>
                            <br />
                            <span class="description">Thông tin cam kết hoàn tiền</span>
                        </td>
                    </tr>
                    <tr>
                            <th><label for="icon_dienthoai">Icon hỗ trợ điện thoại</label></th>
                            <td>
                                <input type="text" name="icon_dienthoai" id="icon_dienthoai" value="<?php echo stripslashes(get_settings('icon_dienthoai')); ?>" class="regular-text" />
                                <input type="button" id="upload_icon_dienthoai_button" class="button button-upload" value="Upload" />
                                <br />
                                <span class="description">Kích thước hình ảnh 63x54</span>
                            </td>
                    </tr>
                     <tr>
                        <th><label for="phone_support">Điện thoại hỗ trợ</label></th>
                        <td>
                            <?php 
                            wp_editor(stripslashes(get_settings('phone_support')), 'phone_support', array(
                                'textarea_name' => 'phone_support',
                                'textarea_rows' => 10,
                            ));
                            ?>
                            <br />
                            <span class="description">Điện thoại hỗ trợ hiển thị ở trang chi tiết sản phẩm.</span>
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
/**
 * Theme options ouput
 * 
 * @global string $themename
 * @global array $options
 */
function theme_options_page(){
    global $themename, $options;
?>
    <div class="wrap">
        <div class="opwrap">
            <h2 class="wraphead" style="margin:10px 0px; padding:15px 10px; font-family:arial black; font-style:normal; background:#B3D5EF;"><b><?php echo $themename; ?> theme options</b></h2>
    <?php
    if (isset($_REQUEST['saved']))
        echo '<div id="message" class="updated fade"><p><strong>' . $themename . ' settings saved.</strong></p></div>';
    if (isset($_REQUEST['reset']))
        echo '<div id="message" class="updated fade"><p><strong>' . $themename . ' settings reset.</strong></p></div>';
    ?>
            <form method="post">
    <?php
    foreach ($options as $value) {
        switch ($value['type']) {
            case "image":
                ?>
                            <tr>
                                <td width="30%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                                <td width="70%"><img src="<?php echo $value['id']; ?>" /></td>
                            </tr>
                            <tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ffffff;">&nbsp;</td></tr>
                            <tr><td colspan="2">&nbsp;</td></tr>
                <?php
                break;
            case "open":
                ?>
                            <table width="100%" border="0" style="background-color:#eef5fb; padding:10px;">
                <?php
                break;
            case "close":
                ?>
                            </table><br />
                <?php
                break;
            case "break":
                ?>
                            <tr><td colspan="2" style="border-top:1px solid #C2DCEF;">&nbsp;</td></tr>
                <?php
                break;
            case "title":
                ?>
                            <table width="100%" border="0" style="background-color:#dceefc; padding:5px 10px;"><tr>
                                    <td colspan="2"><h3 style="font-size:18px;font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
                                </tr>
                <?php
                break;
            case 'text':
                ?>
                                <tr>
                                    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                                    <td width="80%"><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if (get_settings($value['id']) != "") {
                    echo get_settings($value['id']);
                } else {
                    echo $value['std'];
                } ?>" /></td>
                                </tr>
                                <tr>
                                    <td><small><?php echo $value['desc']; ?></small></td>
                                </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ffffff;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
                <?php
                break;
            case 'textarea':
                ?>
                                <tr>
                                    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                                    <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if (get_settings($value['id']) != "") {
                    echo stripslashes(get_settings($value['id']));
                } else {
                    echo $value['std'];
                } ?></textarea></td>
                                </tr>
                                <tr>
                                    <td><small><?php echo $value['desc']; ?></small></td>
                                </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ffffff;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
                <?php
                break;
            case 'select':
                ?>
                                <tr>
                                    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                                    <td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                                        <?php foreach ($value['options'] as $key => $option) { ?>
                                            <option<?php if (get_settings($value['id']) == $key) {
                        echo ' selected="selected"';
                    } elseif ($key == $value['std']) {
                        echo ' selected="selected"';
                        } ?> value="<?php echo $key;?>"><?php echo $option; ?></option><?php } ?></select></td>
                                </tr>
                                <tr>
                                    <td><small><?php echo $value['desc']; ?></small></td>
                                </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ffffff;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
                <?php
                break;
            case "checkbox":
                ?>
                                <tr>
                                    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                                    <td width="80%"><? if (get_settings($value['id'])) {
                    $checked = "checked=\"checked\"";
                } else {
                    $checked = "";
                } ?>
                                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                                    </td>
                                </tr>
                                <tr>
                                    <td><small><?php echo $value['desc']; ?></small></td>
                                </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ffffff;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
                <?php
                break;
        }
    }
    ?>
                <p class="submit">
                    <input name="save" type="submit" value="Save changes" class="button button-large button-primary" />
                    <input type="hidden" name="action" value="save" />
                </p>
            </form>
            <form method="post">
                <input name="reset" type="submit" value="Reset" class="button button-large" />
                <input type="hidden" name="action" value="reset" />
            </form>
        </div>
    </div>
<?php
}