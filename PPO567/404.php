<?php get_header(); ?>

<div class="row">
    <div class="page-404">
        <img alt="404 not found" src="<?php bloginfo('stylesheet_directory'); ?>/images/404.png" class="fl" />
        <div class="font36 mt45 fr">
            <p>Không tìm thấy nội dung</p>
            <p>Quay lại <a href="<?php echo home_url(); ?>">trang chủ</a>?</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<?php get_footer(); ?>
