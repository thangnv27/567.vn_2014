<?php get_header(); ?>
<?php global $shortname; ?>
<div id="main">
    <div class="home-left">
        <div class="categories" style="height:382px;">
            <div class="title"></div>
            <?php 
            wp_nav_menu( array(
                'container' => '',
                'theme_location' => 'home_menu',
                'menu_class' => 'home-menu',
            )); 
            ?>
            <div class="bot"></div>
        </div>
        <script type="text/javascript">
            $(function(){
                $("ul.home-menu > li > a").each(function(){
                    if($(this).attr("title")){
                        $(this).next("ul.sub-menu").css({
                            background:'#FFFFFF url("' + $(this).attr("title") + '") right bottom no-repeat'
                        });
                        $(this).attr("title", "");
                    }
                });
            });
        </script>
        <div class="home-news">
            <ul>
                <?php
                query_posts( array ( 
                    'post_type' => 'post', 
                    'meta_query' => array(
                        array(
                            'key' => 'is_most',
                            'value' => '1',
                        )
                    ),
                    'posts_per_page' => 5,
                ));
                while (have_posts()) : the_post();
                ?>
                <li>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php echo get_short_content(get_the_title(), 46); ?>
                    </a>
                </li>
                <?php endwhile;?>
                <?php wp_reset_query(); ?>
            </ul>
        </div>
    </div>
    <!--/.home-left-->
    
    <div class="home-right">
        <div id="slider">
            <?php
            $loop = new WP_Query(array('post_type' => 'slider', 'orderby' => 'meta_value', 'meta_key' => 'slide_order', 'order' => 'ASC'));
            if ($loop->post_count > 0) :
                ?>
                <ul class="home-slider">
                    <?php while ($loop->have_posts()) : $loop->the_post(); ?> 
                        <li>
                            <a href="<?php echo get_post_meta(get_the_ID(), "slide_link", true); ?>" title="<?php the_title(); ?>">
                                <img src="<?php echo get_post_meta(get_the_ID(), "slide_img", true); ?>" alt="<?php the_title(); ?>" />
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
            <?php wp_reset_query(); ?>
        </div>
        <script type="text/javascript">PPOSlider.sliderHome();</script>
    </div>
    <!--/.home-right-->
    <div class="clearfix"></div>
    
    <div class="embed"><?php echo stripslashes(get_option($shortname . "_embedHome")); ?></div>
</div>

<!--BEGIN: Products block-->
<?php 
$boxArr = json_decode(get_option('cat_box1'));
if(count($boxArr) > 0):
$taxonomy = 'product_category';
foreach ($boxArr as $catID) :
    $category = get_term($catID, $taxonomy);
    $subCats = get_categories( array(
        'type' => 'product',
        'taxonomy' => $taxonomy,
        'child_of' => $category->term_id,
        'hide_empty' => 0,
        'number' => '4',
//        'orderby' => 'term_order',
//        'order' => 'ASC',
    ));
?>
<div class="block-products">
    <div class="block-products-top">
        <div class="category-label">
        <ul class="fl">
            <?php if(isset($subCats[0])): ?>
            <li><a href="<?php echo get_term_link($subCats[0], $taxonomy); ?>" title="<?php echo $subCats[0]->name; ?>"><?php echo $subCats[0]->name; ?></a></li>
            <?php endif; ?>
            <?php if(isset($subCats[1])): ?>
            <li><a href="<?php echo get_term_link($subCats[1], $taxonomy); ?>" title="<?php echo $subCats[1]->name; ?>"><?php echo $subCats[1]->name; ?></a></li>
            <?php endif; ?>
        </ul>
        <div class="mid">
            <a href="<?php echo get_term_link($category, $taxonomy); ?>" title="<?php echo $category->name; ?>">
                <h3><?php echo ucfirst($category->name); ?></h3>
            </a>
        </div>
        <ul class="fr r">
            <?php if(isset($subCats[2])): ?>
            <li><a href="<?php echo get_term_link($subCats[2], $taxonomy); ?>" title="<?php echo $subCats[2]->name; ?>"><?php echo $subCats[2]->name; ?></a></li>
            <?php endif; ?>
            <?php if(isset($subCats[3])): ?>
            <li><a href="<?php echo get_term_link($subCats[3], $taxonomy); ?>" title="<?php echo $subCats[3]->name; ?>"><?php echo $subCats[3]->name; ?></a></li>
            <?php endif; ?>
        </ul>
        <div class="clearfix"></div>
    </div>
    </div>
    <div class="block-product">
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
            'posts_per_page' => 5,
            'meta_query' => array(
                array(
                    'key' => 'not_in_home',
                    'value' => '1',
                    'compare' => '!='
                ),
            ),
        ));
        while($loop->have_posts()) : $loop->the_post();
        ?>
        <div class="product">
            <div class="product-top"></div>
            <div class="product-mid">
                <div class="pname">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                </div>
                <div class="pimages">
                    <?php if(get_post_meta(get_the_ID(), "second_notes", true) != ""): ?>
                    <div class="km"><?php echo get_post_meta(get_the_ID(), "second_notes", true); ?></div>
                    <?php endif; ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&w=217&h=145" alt="<?php the_title(); ?>" />
                    </a>
                    <?php if(get_post_meta(get_the_ID(), "discount", true) != ""): ?>
                    <div class="km2"><span>-<?php echo get_post_meta(get_the_ID(), "discount", true); ?></span></div>
                    <?php endif; ?>
                </div>
                <div class="pdes"><?php echo get_post_meta(get_the_ID(), "sp_desc", true); ?></div>
                <div class="btnbuy">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><div class="btnXem"></div></a>
                    <div class="pprice">
                        <p class="gia"><?php echo number_format(floatval(get_post_meta(get_the_ID(), "gia_moi", true)),0,',','.') ?><span class="font10 bold"> VNĐ</span></p>
                        <?php 
                        $price_old = trim(get_post_meta(get_the_ID(), "gia_cu", true));
                        if($price_old != ""):
                        ?>
                        <p class="giagoc">Giá gốc: <span class=""><?php echo number_format(floatval($price_old),0,',','.') ?> Đ</span></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="product-bot"></div>
        </div>
        <?php endwhile; ?>
        <?php wp_reset_query(); ?>
        <div class="clearfix"></div>
    </div>
    <div class="block-products-bot"></div>
</div>
<?php endforeach; 
endif; ?>
<!--END: Products block-->

<?php get_footer(); ?>
