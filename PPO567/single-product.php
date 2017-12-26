<?php get_header(); ?>

<?php
global $shortname;
?>
<div id="main">
    <?php while (have_posts()) : the_post(); ?>
        <div class="product-single">
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
                    <?php if(count($attachments) == 0) : ?>
                    <a href="<?php get_image_url(); ?>" class="cloud-zoom" id="zoom01" rel="adjustX:20, adjustY:-3">
                        <img id="imgView" title="<?php the_title(); ?>" width="298" 
                             src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&w=298" />
                    </a>
                    <?php else : ?>
                     <a href="<?php echo wp_get_attachment_url( $attachments[0]->ID ); ?>" class="cloud-zoom" id="zoom01" rel="adjustX:20, adjustY:-3">
                        <img id="imgView" title="<?php the_title(); ?>" width="298" 
                             src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo wp_get_attachment_url( $attachments[0]->ID ); ?>&w=298" />
                    </a>
                    <?php endif;?>
                </div>
                <div class="thumbprev" style="display:none"></div>
                <div class="listimg">
                    <ul id="thumb">
                        <?php foreach ($attachments as $attachment) : ?>
                        <li>
                            <a href="<?php echo wp_get_attachment_url( $attachment->ID ); ?>" rel="useZoom: 'zoom01', smallImage: '<?php echo wp_get_attachment_url( $attachment->ID ); ?>'" class="cloud-zoom-gallery">
                                <img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo wp_get_attachment_url( $attachment->ID ); ?>&w=70&h=70" />
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="thumbnext"></div>
            </div>
            <script type="text/javascript">PPOSlider.productThumbnail();</script>
            <!--/.product-preview-->
            
            <div class="product-properties">
                <div class="prduct-btn">
                    <?php
                    $giamoi = floatval(trim(get_post_meta(get_the_ID(), "gia_moi", true)));
                    $giacu = floatval(trim(get_post_meta(get_the_ID(), "gia_cu", true)));
                    $tietkiem = $giacu - $giamoi;
                    $discount = get_post_meta(get_the_ID(), "discount", true);
                    ?>
                    <div class="btnMua" onclick="AjaxCart.addToCart(<?php the_ID(); ?>, '<?php get_image_url(); ?>', '<?php the_title(); ?>', <?php echo get_post_meta(get_the_ID(), "gia_moi", true); ?>, document.getElementById('quantity').value);">
                        <span class="price"><?php echo number_format($giamoi,0,',','.'); ?></span>
                        <span class="unit">VNĐ</span>
                    </div>
                    <div class="fr mr10 mt18">
                        Số lượng: <select id="quantity">
                            <?php 
                            $maxQuantity = intval(get_option($shortname . '_maxQuantity'));
                            for ($i = 1; $i <= $maxQuantity; $i++) {
                                echo "<option value=\"{$i}\">{$i}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="gia-sp">
                        <p class="gia-goc">Giá gốc: <span style="text-decoration: line-through;"><?php echo number_format($giacu,0,',','.') . " VNĐ"; ?></span></p>
                        <p class="giam-gia">Giảm giá <?php echo ($discount == "") ? "0%" : $discount; ?></p>
                        <p class="tiet-kiem">Tiết kiệm <?php echo number_format($tietkiem,0,',','.'); ?> VNĐ</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <h1><?php the_title(); ?></h1>
                
                <div class="chiase">
                    <?php include 'share-socials.php'; ?>
                </div>
                <div class="gioithieu"><?php echo get_post_meta(get_the_ID(), "sp_desc", true); ?></div>
                <div class="khuyenmai"><?php echo get_post_meta(get_the_ID(), "tang_kem", true); ?></div>
            </div>
            <!--/.product-properties-->
            
            <div class="camket">
                <div class="hang">
                    <div class="icon"><img alt="" src="<?php echo stripslashes(get_option("icon_giaohang")); ?>" /></div>                
                    <div class="noidung">
                        <div><?php echo stripslashes(get_settings('camket_giaohang')); ?></div>
                    </div>                
                </div>
                <div class="hang">
                    <div class="icon"><img alt="" src="<?php echo stripslashes(get_option("icon_doihang")); ?>" /></div>
                    <div class="noidung">
                        <div><?php echo stripslashes(get_settings('camket_doihang')); ?></div>
                    </div>     
                </div>
                <div class="hang">
                    <div class="icon"><img alt="" src="<?php echo stripslashes(get_option("icon_hoantien")); ?>" /></div>
                    <div class="noidung">
                        <div><?php echo stripslashes(get_settings('camket_hoantien')); ?></div>
                    </div>  
                </div>
                <div class="hang">
                    <div class="icon"><img alt="" src="<?php echo stripslashes(get_option("icon_dienthoai")); ?>" /></div>
                    <div class="noidung">
                        <div><?php echo stripslashes(get_settings('phone_support')); ?></div>
                    </div>  
                </div>
                <div class="clearfix"></div>
                <div class="tuvan">
                    <div class="title">TỔNG ĐÀI TƯ VẤN</div>
                    <div class="hotline"><?php echo get_option($shortname . "_hotline"); ?> (<?php echo get_option($shortname . "_timeWork"); ?>)</div>
                    <div style="overflow: hidden;">
                        <a href="ymsgr:sendim?<?php echo get_option($shortname . "_yahoo1"); ?>" class="fl ml10">
                            <img src='http://opi.yahoo.com/online?u=<?php echo get_option($shortname . "_yahoo1"); ?>&m=g&t=2'/>
                        </a>
                        <a href="ymsgr:sendim?<?php echo get_option($shortname . "_yahoo2"); ?>" class="fr mr10">
                            <img src='http://opi.yahoo.com/online?u=<?php echo get_option($shortname . "_yahoo2"); ?>&m=g&t=2'/>
                        </a>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!--/.camket-->
            <div class="clearfix"></div>
        </div>
        <!--/.product-single-->
    
        <div class="pdetails">
            <div class="thongtinsanpham">
                <div class="product-info">
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
                                <?php if($baohanh != ""): ?>
                                <li><a href="#bao-hanh">Bảo hành</a></li>
                                <?php endif; ?>
                                <?php if($khuyenmai != ""): ?>
                                <li><a href="#khuyen-mai">Khuyến mãi</a></li>
                                <?php endif; ?>
                                <?php if($giaohang != ""): ?>
                                <li><a href="#pt-giao-hang">Phương thức giao hàng</a></li>
                                <?php endif; ?>
                                <?php if($canhbao != ""): ?>
                                <li><a href="#canh-bao">Cảnh báo</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="tab-bottom"></div>
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
                    
                    <div><a href="javascript://" onclick="AjaxCart.addToCart(<?php the_ID(); ?>, '<?php get_image_url(); ?>', '<?php the_title(); ?>', <?php echo get_post_meta(get_the_ID(), "gia_moi", true); ?>, document.getElementById('quantity').value);"><h4 class="btnDatHang"></h4></a></div>
                </div>
                <!--/.product-info-->
                
                <?php
                include 'box-comments.php';
                
                $taxonomy = 'product_category';
                $terms = get_the_terms(get_the_ID(), $taxonomy);
                $terms_id = array();
                foreach ($terms as $term) {
                    array_push($terms_id, $term->term_id);
                }
                $excludeID = array(get_the_ID());
                $loop = new WP_Query(array(
                    'post_type' => 'product',
                    'posts_per_page' => 10,
                    'tax_query' => array(
                        array(
                            'taxonomy' => $taxonomy,
                            'field' => 'id',
                            'terms' => $terms_id,
                        )
                    ),
                    'post__not_in' => $excludeID,
                ));
                if($loop->post_count > 0):
                    $counter = 1;
                ?>
                <div class="spCungMuc">
                    <div class="title"></div>
                    <div class="spCungMucItem">
                        <?php while($loop->have_posts()) : $loop->the_post(); ?>
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
                        <?php if($counter % 3 == 0): ?>
                        <div class="clearfix"></div>
                        <?php 
                            endif;
                            $counter++;
                        endwhile; ?>
                    </div>
                </div>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
                
            </div>
            
            <div class="single-right">
                <?php get_sidebar("details"); ?>
            </div>
            <div class="clearfix"></div>
        </div>
    <?php 
        /* Set viewed product */
        $viewedProductID = $_COOKIE["ViewedProducts"];
        if($viewedProductID == null){
            $viewedProductID = array();
        }else{
            $viewedProductID = json_decode($viewedProductID);
        }
        if(!in_array(get_the_ID(), $viewedProductID)){
            array_push($viewedProductID, get_the_ID());
        }
        setcookie("ViewedProducts", json_encode($viewedProductID), time()+60*60*24*30*6, "/");  /* expire in 6 month */
        /* END: Set viewed product */
        
    endwhile; 
    ?>
</div>


<?php get_footer(); ?>