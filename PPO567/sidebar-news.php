<div class="search-price mt0">
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