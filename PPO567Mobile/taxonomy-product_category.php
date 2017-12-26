<?php get_header(); ?>
<?php global $shortname; ?>
<!--HOME-->
<div class="banner">
    <?php echo stripslashes(get_option($shortname . "_embedHome")); ?>
</div>

<!--BEGIN: Products block-->
<div class="products">
    <div class="title">
        <a title="<?php single_cat_title(); ?>">
            <?php single_cat_title(); ?>
        </a>
    </div>
    <?php while (have_posts()) : the_post(); ?>
        <div class="product">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <img src="<?php get_image_url(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
            </a>
            <div class="product-name"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
            <div class="product-price">
                <span>Giá: <?php echo number_format(floatval(get_post_meta(get_the_ID(), "gia_moi", true)), 0, ',', '.') ?> VNĐ </span>
                <?php
                $price_old = trim(get_post_meta(get_the_ID(), "gia_cu", true));
                if ($price_old != ""):
                    ?>
                    <span class="gia-goc">( <?php echo number_format(floatval($price_old), 0, ',', '.') ?> VNĐ)</span>
                <?php endif; ?>
            </div>
        </div>

    <?php endwhile; ?>
</div>

<?php if(function_exists('getpagenavi')){ getpagenavi(); } ?>
<!--END BLOCK PRODUCT-->

<?php get_footer(); ?>