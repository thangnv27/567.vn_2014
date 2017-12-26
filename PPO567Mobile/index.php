<?php get_header(); ?>
<!--HOME-->
<div class="banner">
<?php echo stripslashes(get_option($shortname . "_embedHome")); ?>
</div>

<!--BEGIN: Products block-->
<?php
$boxArr = json_decode(get_option('cat_box1'));
if (count($boxArr) > 0):
    $taxonomy = 'product_category';
    foreach ($boxArr as $catID) :
        $category = get_term($catID, $taxonomy);
        ?>
        <div class="products">
            <div class="title">
                <a href="<?php echo get_term_link($category, $taxonomy); ?>" title="<?php echo $category->name; ?>">
                    <?php echo ucfirst($category->name); ?>
                </a>
            </div>
            <?php
            $loop = new WP_Query(array(
                        'post_type' => 'product',
                        'tax_query' => array(
                            array(
                                'taxonomy' => $taxonomy,
                                'field' => 'id',
                                'terms' => $category->term_id,
                            )
                        ),
                        'posts_per_page' => 4,
                        'meta_query' => array(
                            array(
                                'key' => 'not_in_home',
                                'value' => '1',
                                'compare' => '!='
                            ),
                        ),
                    ));
            while ($loop->have_posts()) : $loop->the_post();
                ?>
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
    <?php
    endforeach;
endif;
?>
<!--END BLOCK PRODUCT-->

<?php get_footer(); ?>