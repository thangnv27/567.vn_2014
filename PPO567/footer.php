<?php
global $shortname;
$fbPage = get_option($shortname . '_fbPage');
if ($fbPage != ""):
    ?>
    <div class="fanfbboxhome">
        <div class="fb-like-box" data-href="<?php echo $fbPage; ?>" data-width="1163px" data-height="233px" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
    </div>
<?php endif; ?>
<div class="footerbox">
    <div class="footer-link">
        <div class="intro">
            <h3>Giới thiệu</h3>
            <ul>
                <?php
                $catIntro = intval(get_option($shortname . "_catIntroID"));
                if ($catIntro > 0):
                    query_posts(array(
                        'post_type' => 'post',
                        'posts_per_page' => 6,
                        'cat' => $catIntro,
                        'orderby' => 'title',
                        'order' => 'ASC',
                    ));
                    while (have_posts()) : the_post();
                        ?>
                        <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
                    <?php endwhile;
                endif;
                ?>
            </ul>
        </div>
        <div class="help">
            <h3>Trợ giúp</h3>
            <ul>
                <?php
                $catHelp = intval(get_option($shortname . "_catHelpID"));
                if ($catHelp > 0):
                    query_posts(array(
                        'post_type' => 'post',
                        'posts_per_page' => 6,
                        'cat' => $catHelp,
                        'orderby' => 'title',
                        'order' => 'ASC',
                    ));
                    while (have_posts()) : the_post();
                        ?>
                        <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
                    <?php endwhile;
                endif;
                ?>
            </ul>
        </div>
        <div class="hoptac">
            <h3>Hợp tác</h3>
            <ul>
                <?php
                $catCooperate = intval(get_option($shortname . "_catCooperateID"));
                if ($catCooperate > 0):
                    query_posts(array(
                        'post_type' => 'post',
                        'posts_per_page' => 6,
                        'cat' => $catCooperate,
                        'orderby' => 'title',
                        'order' => 'ASC',
                    ));
                    while (have_posts()) : the_post();
                        ?>
                        <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
    <?php endwhile;
endif;
?>
            </ul>
        </div>
        <div class="info">
<?php echo stripslashes(get_option("contact_info")); ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="footer-social">
        <div style="padding-top: 40px; padding-left: 150px;">
            <ul>
                <li class="icon-fb"><a href="<?php echo get_option($shortname . "_fbURL"); ?>">Facebook</a></li>
                <li class="icon-tw"><a href="<?php echo get_option($shortname . "_twitterURL"); ?>">Twitter</a></li>
                <li class="icon-in"><a href="<?php echo get_option($shortname . "_linkedInURL"); ?>">LinkIn</a></li>
                <li class="icon-phone"><div class="bg_p2"></div><div class="bg_p1"><?php echo get_option($shortname . "_hotline_footer"); ?></div><div class="bg_p3"></div></li>
                <li class="icon-gplus"><a href="<?php echo get_option($shortname . "_googlePlusURL"); ?>">Google+</a></li>
                <li class="icon-ytube"><a href="<?php echo get_option($shortname . "_youtubeURL"); ?>">Youtube</a></li>
                <li class="icon-pin"><a href="<?php echo get_option($shortname . "_pinterestURL"); ?>">Pinterest</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-contact">
        <div class="dk"><img alt="DKKD" src="<?php bloginfo('stylesheet_directory'); ?>/images/dk.png" /></div>
        <div class="contact-info"><?php echo stripslashes(get_option("footer_info")); ?></div>
        <div class="dmca"><a href="<?php echo get_option($shortname . "_linkDMCA"); ?>" target="_blank" rel="nofollow"><img alt="DMCA Protected" src="<?php bloginfo('stylesheet_directory'); ?>/images/dmca.png" /></a></div>
        <div class="clearfix"></div>
    </div>
    <div class="ppo"><?php if (MobileDTS::is_switcher_enabled()): // Optional but useful if you need to disable theme switching for a while. ?>

<a href="<?php MobileDTS::switch_theme_link() ?>">Chuyển sang giao diện <?php MobileDTS::switch_theme_name() ?> </a>

<?php endif; ?> - Powered by <a>PPO.VN</a></div>
</div>
<!--/.footerbox-->
</div><!-- END: Wrapper -->
<div class="footer-float">
    <div id="footer">
        <div class="footer-logo">
            <a href="<?php bloginfo('siteurl'); ?>" title="<?php bloginfo("name"); ?> - <?php bloginfo("description"); ?>">
                <img alt="<?php bloginfo("name"); ?>" src="<?php echo stripslashes(get_option("sitelogo")); ?>" />
            </a>
        </div>
        <div class="footer-menu">
            <?php
            wp_nav_menu(array(
                'container' => '',
                'theme_location' => 'main_menu',
            ));
            ?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<!--Include JS-->
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-scrolltofixed-min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.placeholder.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/custom.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/app.js"></script>
<?php if (is_singular('product')): ?>
<!--Cloud Zoom-->
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/cloud-zoom.1.0.3.min.js"></script>
<!--/Cloud Zoom-->
<?php endif; ?>

<?php wp_footer(); ?>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1&appId=<?php echo get_option($shortname . "_appFBID"); ?>";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
</body>
</html>