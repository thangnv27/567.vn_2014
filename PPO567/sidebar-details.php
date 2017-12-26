<div class="rboxGreen">
    <div class="title"><h3>KHUYÊN DÙNG</h3></div>
    <div class="mid">
        <div class="rbox-content">
            <?php
            global $wp_query;
            query_posts(array(
                'post_type' => 'product',
                'meta_query' => array(
                    array(
                        'key' => 'is_most',
                        'value' => '1',
                    )
                ),
                'posts_per_page' => 10,
                'orderby' => 'rand',
            ));
            $counter = 1;
            while (have_posts()) : the_post();
                ?>
                <div class="rbox-sp">
                    <div class="rbox-img">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&w=121&h=74" />
                        </a>
                    </div>
                    <div class="rbox-info">
                        <div class="spname"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
                        <div class="spprice"><?php echo number_format(floatval(trim(get_post_meta(get_the_ID(), "gia_moi", true))), 0, ',', '.'); ?> VNĐ</div>
                        <?php 
                        $price_old = trim(get_post_meta(get_the_ID(), "gia_cu", true));
                        if($price_old != ""):
                        ?>
                        <div class="spdes">Giá gốc: <span style="text-decoration: line-through;"><?php echo number_format(floatval($price_old),0,',','.') ?> Đ</span></div>
                        <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php if ($counter != $wp_query->found_posts): ?>
                    <div class="lineGreen"></div>
                <?php
                endif;
                $counter++;
            endwhile;
            wp_reset_query();
            ?>
        </div>
    </div>
    <div class="bot"></div>
</div>

<div class="rboxRed">
    <div class="title"><h3>ƯU ĐÃI LỚN</h3></div>
    <div class="mid">
        <div class="rbox-content">
            <?php
            query_posts(array(
                'post_type' => 'product',
                'meta_query' => array(
                    array(
                        'key' => 'gia_cu',
                        'value' => '',
                        'compare' => '!='
                    )
                ),
                'posts_per_page' => 5,
                'orderby' => 'rand',
            ));
            $counter = 1;
            while (have_posts()) : the_post();
                ?>
            <div class="rbox-sp">
                <div class="rbox-img">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&w=121&h=74" />
                    </a>
                </div>
                <div class="rbox-info">
                    <div class="spname"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
                    <div class="spprice"><?php echo number_format(floatval(trim(get_post_meta(get_the_ID(), "gia_moi", true))), 0, ',', '.'); ?> VNĐ</div>
                    <?php 
                    $price_old = trim(get_post_meta(get_the_ID(), "gia_cu", true));
                    if($price_old != ""):
                    ?>
                    <div class="spdes">Giá gốc: <span style="text-decoration: line-through;"><?php echo number_format(floatval($price_old),0,',','.') ?> Đ</span></div>
                    <?php endif; ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php if ($counter != $wp_query->found_posts): ?>
                <div class="lineRed"></div>
            <?php
                endif;
                $counter++;
            endwhile;
            wp_reset_query();
            ?>
        </div>
    </div>
    <div class="bot"></div>
</div>
<script type="text/javascript">PPOFixed.spUuDai();</script>