<?php// Download buttonadd_shortcode('newsblock', 'shortcode_newsblock');function shortcode_newsblock($atts, $content = null) {    $loop = new WP_Query(array(        'post_type' => 'post',        'posts_per_page' => 5,        'meta_query' => array(            array(                'key' => 'is_most',                'value' => '1',            )        ),    ));    $html = '<div class="home-news fr ml10" style="display:block;"><ul>';    while ($loop->have_posts()) : $loop->the_post();        $html .= '<li><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_short_content(get_the_title(), 46) . '</a></li>';    endwhile;    wp_reset_query();    $html .= '</ul></div>';        return $html;}//////////////////////////////////////////////////////////////////// Add buttons to tinyMCE//////////////////////////////////////////////////////////////////add_action('init', 'add_button');function add_button() {    if (current_user_can('edit_posts') && current_user_can('edit_pages')) {        add_filter('mce_external_plugins', 'add_plugin');        add_filter('mce_buttons_3', 'register_button');    }}function register_button($buttons) {    array_push($buttons, "newsblock");    return $buttons;}function add_plugin($plugin_array) {    $plugin_array['newsblock'] = get_template_directory_uri() . '/tinymce/customcodes.js';    return $plugin_array;}?>