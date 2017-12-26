<?php
$basename = basename($_SERVER['PHP_SELF']);
if(!in_array($basename, array('plugins.php', 'update.php', 'upgrade.php'))){
    ob_start();
    ob_start("ob_gzhandler");
}
/* ----------------------------------------------------------------------------------- */
# Set default timezone
/* ----------------------------------------------------------------------------------- */
date_default_timezone_set('Asia/Ho_Chi_Minh');

$themename = "PPO";
$shortname = "ppo";

include 'includes/HttpFoundation/Request.php';
include 'includes/HttpFoundation/Response.php';
include 'includes/HttpFoundation/Session.php';
include 'includes/custom.php';
include 'includes/theme_functions.php';
include 'includes/common-scripts.php';
include 'includes/meta-box.php';
include 'includes/theme_settings.php';
include 'includes/categories-banners/categories-banners.php';
include 'includes/custom-user.php';
include 'includes/home-options.php';
include 'includes/payment-method.php';
include 'includes/bills-options.php';
include 'includes/product.php';
include 'includes/orders.php';
include 'includes/shortcodes.php';
include 'includes/post_type_no_slug.php';
include 'ajax.php';
if(is_admin()){
    //include 'includes/modern-admin/modern-admin.php';
    
    include 'includes/postMeta.php';
    include 'includes/slider.php';
    
    add_action( 'admin_menu', 'custom_remove_menu_pages' );
}else{
    //include 'includes/social-post-link.php';
}
/**
 * Remove admin menu
 */
function custom_remove_menu_pages() {
    remove_menu_page('edit-comments.php');
    remove_menu_page('admin.php?page=modern-admin-ui-settings');
}

/*
update_post_meta_for_all_products();
function update_post_meta_for_all_products() {
    query_posts(array(
        'post_type' => 'product',
        'posts_per_page' => -1,
    ));
    while(have_posts()) : the_post();
        update_post_meta(get_the_ID(), 'not_in_home', 0);
    endwhile;
}
*/

/* ----------------------------------------------------------------------------------- */
# User login
/* ----------------------------------------------------------------------------------- */
add_action('init', 'user_check_login_status');

function user_check_login_status(){
    global $current_user;
    get_currentuserinfo();
    if (is_user_logged_in()) {
        $_SESSION['current_user_login'] = $current_user;
    }else{
        if(isset($_SESSION['current_user_login'])){
            unset($_SESSION['current_user_login']);
        }
    }
}

add_action('init', 'redirect_after_logout');

function redirect_after_logout() {
    if (preg_match('#(wp-login.php)?(loggedout=true)#', $_SERVER['REQUEST_URI']))
        wp_redirect(get_option('siteurl'));
}

/* ----------------------------------------------------------------------------------- */
# Post Thumbnails
/* ----------------------------------------------------------------------------------- */
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
}
/*if (function_exists('add_image_size')) {
    add_image_size('thumbnail176', 176, 176, FALSE);
}*/
function ppo_filter_image_sizes($sizes) {
    unset($sizes['thumbnail']);
    unset($sizes['medium']);
    unset($sizes['large']);

    return $sizes;
}

add_filter('intermediate_image_sizes_advanced', 'ppo_filter_image_sizes');

//function ppo_custom_image_sizes($sizes) {
//    $myimgsizes = array(
//        "image-in-post" => __("Image in Post"),
//        "full" => __("Original size")
//    );
//    
//    return $myimgsizes;
//}
//
//add_filter('image_size_names_choose', 'ppo_custom_image_sizes');
/* ----------------------------------------------------------------------------------- */
# Register Sidebar
/* ----------------------------------------------------------------------------------- */
register_sidebar(array(
    'id' => __('sidebar'),
    'name' => __('Sidebar'),
    'id' => __('sidebar'),
    'before_widget' => '<div id="%1$s" class="widget-container box %2$s">',
    'after_widget' => '</div><div class="bot"></div></div>',
    'before_title' => '<div class="widget-title title"><h3>',
    'after_title' => '</h3></div><div class="mid">',
));
/*register_sidebar(array(
    'id' => __('sidebar_details'),
    'name' => __('Sidebar Details'),
    'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget-title">',
    'after_title' => '</div>',
));*/

/* ----------------------------------------------------------------------------------- */
# Register menu location
/* ----------------------------------------------------------------------------------- */
register_nav_menus(array(
    'main_menu' => 'Primary Location',
    'home_menu' => 'Secondary Location',
    'cat_menu' => 'Thirdly Location',
));
/*
function get_history_order(){
    global $wpdb, $current_user;
    get_currentuserinfo();
    $records = array();
    if (is_user_logged_in()) {
        $tblOrders = $wpdb->prefix . 'orders';
        $query = "SELECT $tblOrders.*, $wpdb->users.display_name, $wpdb->users.user_email FROM $tblOrders 
            JOIN $wpdb->users ON $wpdb->users.ID = $tblOrders.customer_id 
            WHERE $tblOrders.customer_id = $current_user->ID ORDER BY $tblOrders.ID DESC";
        $records = $wpdb->get_results($query);
    }
    
    return $records;
}

function getLocale(){
    $locale = "vn";
    if(get_query_var("lang") != null) {
        $locale = get_query_var("lang");
    } else if (function_exists("qtrans_getLanguage")) {
        $locale = qtrans_getLanguage();
    }
    if($locale == "vi"){
        $locale = "vn";
    }
    return $locale;
}
*/
//add_action('admin_print_footer_scripts', 'admin_add_custom_js', 99);

/**
 * Add wysiwyg to custom field textarea
 */
function admin_add_custom_js() {
    ?>
    <script type="text/javascript">/* <![CDATA[ */
        jQuery(function($){
            var area = new Array();
            
            $.each(area, function(index, id){
                //tinyMCE.execCommand('mceAddControl', false, id);
                tinyMCE.init({
                    selector: "textarea#" + id,
                    height: 400
                });
                $("#newmeta-submit").click(function(){
                    tinyMCE.triggerSave();
                });
            });
        });
        /* ]]> */
    </script>
<?php
}
/* ----------------------------------------------------------------------------------- */
# Custom search
/* ----------------------------------------------------------------------------------- */
add_action('pre_get_posts','custom_search_filter');

function custom_search_filter($query) {
    if ( !is_admin() && $query->is_main_query() ) {
        if ($query->is_search) {
            $post_type = 'product';
            if($post_type == get_query_var("post_type")){
                $s = get_search_query();
                $meta_query = array();
                if($s == "is_new"){
                    $meta_query = array(
                        array(
                            'key' => 'is_new',
                            'value' => 1,
                        ),
                    );
                }elseif($s == "is_most"){
                    $meta_query = array(
                        array(
                            'key' => 'is_most',
                            'value' => 1,
                        ),
                    );
                }elseif($s == "discount"){
                    $meta_query = array(
                        array(
                            'key' => 'discount',
                            'value' => '',
                            'compare' => '!='
                        ),
                    );
                }
                $query->set('post_type', $post_type);
                $query->set('meta_query', $meta_query);
            }
        }
    }
    return $query;
}
add_filter( 'posts_where', 'title_like_posts_where' );

function title_like_posts_where($where) {
    global $wpdb, $wp_query;
    if ($wp_query->is_search) {
        $where = str_replace("AND ( (ppo_postmeta.meta_key =", "OR ( (ppo_postmeta.meta_key =", $where);
    }
    return $where;
}