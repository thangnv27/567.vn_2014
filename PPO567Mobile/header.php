<?php
include 'includes/bbit-compress.php';
global $shortname;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
    <head>
        <meta http-equiv="Cache-control" content="no-store; no-cache"/>
        <meta http-equiv="Pragma" content="no-cache"/>
        <meta http-equiv="Expires" content="0"/>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />

        <title><?php wp_title('|', true, 'right'); ?></title>

        <meta name="keywords" content="<?php echo get_option('keywords_meta') ?>" />
        <meta name="author" content="ppo.vn" />
        <meta name="robots" content="index, follow" /> 
        <meta name="googlebot" content="index, follow" />
        <meta name="bingbot" content="index, follow" />
        <meta name="geo.region" content="VN" />
        <meta name="geo.position" content="14.058324;108.277199" />
        <meta name="ICBM" content="14.058324, 108.277199" />

        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />

        <script>
            var siteUrl = "<?php bloginfo('siteurl'); ?>";
            var themeUrl = "<?php bloginfo('stylesheet_directory'); ?>";
            var checkoutUrl = "<?php echo get_page_link(get_option($shortname . "_pageBuyID")); ?>";
            var loginUrl = "<?php echo wp_login_url(getCurrentRquestUrl()); ?>";
            var no_image_src = "<?php bloginfo('stylesheet_directory'); ?>/images/no_image_available.jpg";
            var ajaxurl = siteUrl + '/wp-admin/admin-ajax.php';
        </script>

        <!--[if lt IE 7]>
        <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
        <![endif]-->
        <!--[if lt IE 8]>
        <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
        <![endif]-->
        <!--[if lt IE 9]>
        <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
        <![endif]-->

        <?php
        if (is_singular())
            wp_enqueue_script('comment-reply');

        wp_head();
        ?>
    </head>
    <body>
        <div class="wrapper">
            <div class="page">
                <!--HEADER-->
                <div id="header">
                    <div class="logo">
                        <a href="<?php bloginfo('siteurl'); ?>" title="<?php bloginfo("name"); ?> - <?php bloginfo("description"); ?>">
                            <img alt="<?php bloginfo("name"); ?>" src="<?php echo stripslashes(get_option("sitelogo")); ?>" />
                        </a>
                    </div>
                    <div class="search">
                        <?php get_search_form(); ?>
                    </div>
                </div>
                <!--END: HEADER-->
                <div class="quick-menu">
                    <div class="q-menu">
                        <span class="icon">Menu</span>
                        <div class="q-nav" style="display: none;">
                            <?php
                            wp_nav_menu(array(
                                'container' => '',
                                'theme_location' => 'home_menu',
                                'menu_class' => 'header-menu',
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(function(){
                        $(".quick-menu .q-menu .icon").click(function(){
                            if($(this).next().is(":hidden")){
                                $(this).next().slideDown(400).fadeTo(400, 100);
                            }else{
                                $(this).next().fadeTo(400, 0).slideUp(400);
                            }
                        });
                    });
                </script>
                  <!--Alert Message-->
            <div id="nNote" class="nNote mt15" style="display: none;"></div>
            <!--END: Alert Message-->