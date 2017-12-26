<?php get_header(); ?>
<?php global $shortname; ?>
<div id="main">
    <div class="embed mb45"><?php echo stripslashes(get_option($shortname . "_embedHome")); ?></div>
    
    <div class="home-left">
        <?php get_sidebar(); ?>
    </div>
    <!--/.home-left-->
    
    <div class="home-right">
        <div class="products">
            <?php
            $counter = 1;
            while(have_posts()) : the_post();
                if($counter % 4 == 0):
            ?>
            <div class="product mr0">
                <?php else: ?>
            <div class="product">
                <?php endif; ?>
                <div class="pname">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo get_short_content(get_the_title(), 27); ?></a>
                </div>
                <div class="pimages">
                    <?php if(get_post_meta(get_the_ID(), "second_notes", true) != ""): ?>
                    <div class="km"><?php echo get_post_meta(get_the_ID(), "second_notes", true); ?></div>
                    <?php endif; ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&w=180&h=120" alt="<?php the_title(); ?>" />
                    </a>
                    <?php if(get_post_meta(get_the_ID(), "discount", true) != ""): ?>
                    <div class="km2"><span>-<?php echo get_post_meta(get_the_ID(), "discount", true); ?></span></div>
                    <?php endif; ?>
                </div>
                <div class="pdes">
                    <?php echo get_post_meta(get_the_ID(), "sp_desc", true); ?>
                </div>
                <div class="btnbuy">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><div class="btnXem2"></div></a>
                    <div class="pprice">
                        <p class="gia2"><?php echo number_format(floatval(get_post_meta(get_the_ID(), "gia_moi", true)),0,',','.') ?><span class="font10 bold"> VNĐ</span></p>
                        <?php 
                        $price_old = trim(get_post_meta(get_the_ID(), "gia_cu", true));
                        if($price_old != ""):
                        ?>
                        <p class="giagoc">Giá gốc: <span class=""><?php echo number_format(floatval($price_old),0,',','.') ?> Đ</span></p>
                        <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <?php if($counter % 4 == 0): ?>
            <div class="clearfix"></div>
            <?php endif;
                $counter++;
            endwhile; ?>
        </div>
        <!--/.products-->
        <?php if(function_exists('getpagenavi')){ getpagenavi(); } ?>
    </div>
    <!--/.home-right-->
    <div class="clearfix"></div>
</div>
<?php get_footer(); ?>