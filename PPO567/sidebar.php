<div class="categories">
    <div class="title"></div>
    <ul>
    <?php
//    wp_nav_menu(array(
//        'container' => '',
//        'theme_location' => 'cat_menu',
//    ));
    $term = get_queried_object(); 
    $loop = new WP_Query(array(
        'post_type' => 'product',
        'posts_per_page' => 10,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_category',
                'field' => 'id',
                'terms' => $term->term_id,
            ),
        ),
        'orderby' => 'rand',
    ));
    while ($loop->have_posts()) : $loop->the_post();
    ?>
        <li><a href="<?php the_permalink(); ?>"><?php echo get_short_content(get_the_title(), 34); ?></a></li>
    <?php endwhile;
    wp_reset_query();
    ?>
    </ul>
    <div class="bot"></div>
</div>

<div class="search-price">
    <div class="title"></div>
    <div class="mid">
        <ul>
            <?php
            $args = array(
                'title_li' => '',
                'show_option_none' => '',
                'hide_empty' => 0,
                'taxonomy' => 'product_search_price',
                'orderby' => 'ID',
            );
            wp_list_categories($args);
            ?>
        </ul>
    </div>
    <div class="bot"></div>
</div>

<?php
if (function_exists('dynamic_sidebar')) {
    dynamic_sidebar('sidebar');
}
?>