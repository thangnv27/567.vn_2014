<?php get_header(); ?>

<div class="archive">
    <ul>
        <?php while (have_posts()) : the_post(); ?>
            <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
        <?php endwhile; ?>
    </ul>
</div>

<?php
if (function_exists('getpagenavi')) {
    getpagenavi();
}
?>

<?php get_footer(); ?>