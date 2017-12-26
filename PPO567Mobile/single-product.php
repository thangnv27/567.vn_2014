<?php
get_header();
global $shortname;
?>
<!--BEGIN: Products page-->
<?php while (have_posts()) : the_post(); ?>
    <div class="product-page">
        <div class="product-title">
            <h1><?php the_title(); ?></h1>
        </div>
        <?php
        $args = array(
            'orderby' => 'menu_order',
            'post_type' => 'attachment',
            'post_parent' => get_the_ID(),
            'post_mime_type' => 'image',
            'post_status' => null,
            'posts_per_page' => -1,
            'exclude' => get_post_thumbnail_id()
        );
        $attachments = get_posts($args);
        ?>
        <div class="product-preview">
            <div class="productViewImg">
                <?php if (count($attachments) == 0) : ?>
                    <a href="<?php get_image_url(); ?>">
                        <img id="imgView" title="<?php the_title(); ?>" src="<?php get_image_url(); ?>" />
                    </a>
                <?php else : ?>
                    <a href="<?php echo wp_get_attachment_url($attachments[0]->ID); ?>">
                        <img id="imgView" title="<?php the_title(); ?>" src="<?php echo wp_get_attachment_url($attachments[0]->ID); ?>" />
                    </a>
                <?php endif; ?>
            </div>
            <div class="thumbprev" style="display:none"></div>
            <div class="listimg">
                <ul id="thumb">
                    <?php foreach ($attachments as $attachment) : ?>
                        <li>
                            <a href="<?php echo wp_get_attachment_url($attachment->ID); ?>" rel="useZoom: 'zoom01', smallImage: '<?php echo wp_get_attachment_url($attachment->ID); ?>'" class="cloud-zoom-gallery">
                                <img src="<?php echo wp_get_attachment_url($attachment->ID); ?>" width="70px" height="70px"/>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="thumbnext"></div>
        </div>
        <script type="text/javascript">PPOSlider.productThumbnail();</script>
        <!--/.product-preview-->
        <div class="product-info">
            <div class="product-price">
                <span>Giá: <?php echo number_format(floatval(get_post_meta(get_the_ID(), "gia_moi", true)), 0, ',', '.') ?> VNĐ </span>
                <?php
                $price_old = trim(get_post_meta(get_the_ID(), "gia_cu", true));
                if ($price_old != ""):
                    ?>
                    <span class="gia-goc">( <?php echo number_format(floatval($price_old), 0, ',', '.') ?> VNĐ)</span>
                <?php endif; ?>
            </div>
            <a href="javascript://" onclick="AjaxCart.addToCart(<?php the_ID(); ?>, '<?php get_image_url(); ?>', '<?php the_title(); ?>', <?php echo get_post_meta(get_the_ID(), "gia_moi", true); ?>, 1);"><div class="btnbuy">Mua ngay</div></a>
        </div>
        <div class="product-details">
            <div id="tabs">
                <?php
                $baohanh = get_post_meta(get_the_ID(), "bao_hanh", true);
                $khuyenmai = get_post_meta(get_the_ID(), "khuyen_mai", true);
                $giaohang = get_post_meta(get_the_ID(), "giao_hang", true);
                $canhbao = get_post_meta(get_the_ID(), "canh_bao", true);
                ?>
                <div class="tabs">
                    <ul>
                        <li><a href="#thong-tin">Thông tin</a></li>
                        <?php if ($baohanh != ""): ?>
                            <li><a href="#bao-hanh">Bảo hành</a></li>
                        <?php endif; ?>
                        <?php if ($khuyenmai != ""): ?>
                            <li><a href="#khuyen-mai">Khuyến mãi</a></li>
                        <?php endif; ?>
                        <?php if ($giaohang != ""): ?>
                            <li><a href="#pt-giao-hang">Phương thức giao hàng</a></li>
                        <?php endif; ?>
                        <?php if ($canhbao != ""): ?>
                            <li><a href="#canh-bao">Cảnh báo</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="content">
                    <div id="thong-tin">
                        <?php the_content(); ?>
                    </div>
                    <div id="bao-hanh">
                        <?php echo $baohanh; ?>
                    </div>
                    <div id="khuyen-mai">
                        <?php echo $khuyenmai; ?>
                    </div>
                    <div id="pt-giao-hang">
                        <?php echo $giaohang; ?>
                    </div>
                    <div id="canh-bao">
                        <?php echo $canhbao; ?>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(function() {
                    $( "#tabs" ).tabs();
                });
            </script>
        </div>
    </div>
<?php endwhile; ?>

<!--END Page PRODUCT-->

<?php get_footer(); ?>