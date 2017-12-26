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

        <title><?php wp_title( '|', true, 'right' ); ?></title>

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
        <!--<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/style_dev.css" />-->
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/css/wp-default.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/css/common.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.slider.min.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/colorbox/colorbox.css" />
        <?php if (is_singular('product')): ?>
        <!--Cloud Zoom-->
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/cloud-zoom.css" />
        <!--/Cloud Zoom-->
        <?php endif; ?>

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
        <!--<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/wz_tooltip.js" async="async" defer="defer"></script>-->

        <div id="social">
            <div class="social">
                <div class="fb-like" data-href="<?php bloginfo('siteurl'); ?>" data-width="45" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false"></div>
                <div style="margin-top: 10px;">
                    <div class="g-plusone" data-href="<?php bloginfo('siteurl'); ?>" data-size="tall" data-width="50"></div>
                </div>
            </div>
            <div id="feedback_click_show" onclick="SendFeedback.show();">
                <span>Góp ý</span>
            </div>
            <?php
            $viewedProductID = $_COOKIE["ViewedProducts"];
            if ($viewedProductID != null) {
                $viewedProductID = json_decode($viewedProductID);
            }
            if ($viewedProductID != null && !empty($viewedProductID)):
                $loop = new WP_Query(array(
                            'post_type' => 'product',
                            'posts_per_page' => 5,
                            'orderby'=> 'rand',
                            'post__in' => $viewedProductID,
                        ));
                if ($loop->post_count > 0):
            ?>
                <div id="product-viewed">
                    <span>Bạn vừa xem</span>
                </div>
                <div class="product-viewed-item" style="display: none;">
                    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                    <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                        <img alt="<?php the_title(); ?>" title="<?php the_title(); ?>" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&w=50&h=50" />
                    </a>
                    <?php endwhile; ?>
                </div>
                <script type="text/javascript">
                    $(function(){
                        $("#product-viewed").click(function(){
                            if($(this).next().is(":hidden")){
                                $(this).next().slideDown('fast');
                            }else{
                                $(this).next().slideUp('fast');
                            }
                        });
                    });
                </script>
            <?php
                endif;
                wp_reset_query();
            endif;
            ?>
        </div>
        <div id="toTop" class="scrolltop" style="display: none;"></div>
        <div class="wrp-header"></div>
        <div id="wrapper">
            <!--HEADER-->
            <div id="header">
                <div class="sologan"><?php echo get_option($shortname . "_sologan"); ?></div>
                <div class="logo">
                    <a href="<?php bloginfo('siteurl'); ?>" title="<?php bloginfo("name"); ?> - <?php bloginfo("description"); ?>">
                        <img alt="<?php bloginfo("name"); ?>" src="<?php echo stripslashes(get_option("sitelogo")); ?>" />
                    </a>
                </div>
                <div class="top-header">
                    <ul class="tooltip-header">
                        <li class="tt-item">
                            <a href="javascript://"></a>
                            <div class="tt tt5" style="display: none;"><?php echo stripslashes(get_settings('tooltip5')); ?></div>
                        </li>
                        <li class="tt-item">
                            <a href="javascript://"></a>
                            <div class="tt tt6" style="display: none;"><?php echo stripslashes(get_settings('tooltip6')); ?></div>
                        </li>
                        <li class="tt-item">
                            <a href="javascript://"></a>
                            <div class="tt tt7" style="display: none;"><?php echo stripslashes(get_settings('tooltip7')); ?></div>
                        </li>
                    </ul>
                </div>
                <div class="head-body">
                    <div class="hotline">
                        <img alt="Hotline" src="<?php echo stripslashes(get_option("hotline")); ?>" />
                    </div>
                    <div class="search-box">
                        <form action="<?php bloginfo('siteurl'); ?>" method="get">
                            <input type="submit" value="" />
                            <input type="text" name="s" value="" placeholder="Tìm kiếm..." />
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!--END: HEADER-->

            <div id="ajax_loading" style="display: none" class="ajax-loading-block-window">
                <div class="loading-image"></div>
            </div>

            <?php if (!is_home()): ?>
                <div class="quick-menu">
                    <div class="q-menu">
                        <h2 class="menu-title">Danh mục sản phẩm</h2>
                        <div class="q-nav" style="display: none;">
                            <?php
                            wp_nav_menu(array(
                                'container' => '',
                                'theme_location' => 'home_menu',
                                'menu_class' => 'header-menu',
                            ));
                            ?>
                            <div class="bot"></div>
                        </div>
                    </div>
                    <script type="text/javascript">
                    $(function(){
                        $("ul.header-menu > li > a").each(function(){
                            if($(this).attr("title")){
                                $(this).next("ul.sub-menu").css({
                                    background:'#FFFFFF url("' + $(this).attr("title") + '") right bottom no-repeat'
                                });
                                $(this).attr("title", "");
                            }
                        });
                    });
                    </script>
                    <div class="filter">
                        <a href="<?php bloginfo('siteurl'); ?>/?post_type=product&s=is_new">Hàng mới về</a>
                        <a href="<?php bloginfo('siteurl'); ?>/?post_type=product&s=is_most">Hàng bán chạy</a>
                        <a href="<?php bloginfo('siteurl'); ?>/?post_type=product&s=discount">Giảm giá</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <script type="text/javascript">
                $(function(){
                    $(".quick-menu .q-menu .menu-title").click(function(){
                        if($(this).next().is(":hidden")){
                            $(this).next().slideDown(400).fadeTo(400, 100);
                        }else{
                            $(this).next().fadeTo(400, 0).slideUp(400);
                        }
                    });
                });
                </script>

                <div class="breadcrums"><div class="iconHome"></div>
                    <?php
                    if (function_exists('bcn_display')) {
                        bcn_display();
                    }
                    ?>
                </div>
            <?php endif; ?>

            <!--Alert Message-->
            <div id="nNote" class="nNote mt15" style="display: none;"></div>
            <!--END: Alert Message-->