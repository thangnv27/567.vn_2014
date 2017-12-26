<?php get_header(); ?>
<?php global $shortname; ?>
<div id="main">
    <div class="embed mb45"><?php echo stripslashes(get_option($shortname . "_embedHome")); ?></div>
    
    <div class="home-left">
        <?php get_sidebar("news"); ?>
    </div>
    
    <div class="archive-right">
    <h1 class="cat-title2"><?php single_cat_title(); ?></h1>
        <?php while (have_posts()) : the_post(); ?>
        <div class="post-item">
            <div class="post-images">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&w=160&h=160" alt="<?php the_title(); ?>" />
                </a>
            </div>
            <div class="post-description">
                <div class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                <div class="time">Ngày đăng: <?php the_time('H:i:s - d/m/Y'); ?></div>
                <div class="des"><?php the_excerpt(); ?></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php endwhile; ?>
        
        <?php if(function_exists('getpagenavi')){ getpagenavi(); } ?>
    </div>
    <div class="clearfix"></div>
</div>


<?php get_footer(); ?>