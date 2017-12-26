<!--BEGIN FOOTER-->
<?php
global $shortname;
?>
<div class="menu_footer">
    <div class="title"><h3>Giới thiệu</h3></div>
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
                <?php
            endwhile;
        endif;
        ?>
    </ul>
</div>
<div class="menu_footer">
    <div class="title"><h3>Trợ giúp</h3></div>
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
            <?php
            endwhile;
        endif;
        ?>
    </ul>
</div>
<div class="menu_footer">
    <div class="title"><h3>Hợp tác</h3></div>
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
            <?php
            endwhile;
        endif;
        ?>
    </ul>
</div>
<div class="menu_footer">
    <div class="title"><h3>Thông tin</h3></div>
    <div class="contact-info"><?php echo stripslashes(get_option("footer_info")); ?></div>
</div>
<div class="footer">
    <br/>
<?php if (MobileDTS::is_switcher_enabled()): // Optional but useful if you need to disable theme switching for a while. ?>

<a href="<?php MobileDTS::switch_theme_link() ?>">Chuyển sang giao diện <?php MobileDTS::switch_theme_name() ?></a>

<?php endif; ?>
</div>

<!--END FOOTER-->
</div> 
<!--end page-->
</div>
<!--end wrapper-->

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-scrolltofixed-min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.placeholder.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/custom.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/app.js"></script>
        
<?php
wp_footer();
?>
</body>
</html>