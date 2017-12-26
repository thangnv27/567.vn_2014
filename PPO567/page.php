<?php get_header(); ?>

<div id="main">
    <div class="single">
        <div class="single-left">
            <?php while (have_posts()) : the_post(); ?>
            <div class="single-content mb20">
                <h1 class="title"><?php the_title(); ?></h1>
                <div class="single-meta">Ngày đăng: <?php the_time('H:i:s - d/m/Y'); ?></div>
                <div class="content"><?php the_content(); ?></div>
                <?php if (get_the_tags()): ?>
                <div class="tags_box ml10"><p><?php the_tags( '<b>Tags: </b>', ', ', ''); ?></p></div>
                <?php endif; ?>
            </div>
            <?php 
            include_once 'share-socials.php'; 
            include_once 'box-comments.php'; 
            endwhile;
            ?>
        </div>
        <div class="single-right">
            <?php get_sidebar("details"); ?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<?php get_footer(); ?>