<?php
get_header();
?>
<?php while (have_posts()) : the_post(); ?>
    <div class="product-page">
        <div class="product-title">
            <h1><?php the_title(); ?></h1>
        </div>

        <div class="content">
            <?php the_content(); ?>
        </div>

    </div>
<?php endwhile; ?>
<?php get_footer(); ?>