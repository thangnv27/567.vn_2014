<?php
/*
  Template Name: Page Buy
 */

get_header();
global $shortname, $current_user;
get_currentuserinfo();
$cities = get_city_list();
?>
<div class="page-buy">
    <div class="checkout">
        <form action="" method="post" id="frmOrder">
            <input type="hidden" name="action" value="orderComplete" />
            <div class="customer">
                <div class="customerInfo">
                    <div class="title" >Thông tin khách hàng</div>
                    <p><input type="text" name="cName" value="<?php echo (is_user_logged_in()) ? $current_user->display_name : ""; ?>" placeholder="Họ và tên" /></p>
                    <p><input type="text" name="cEmail" value="<?php echo (is_user_logged_in()) ? $current_user->user_email : ""; ?>" placeholder="Địa chỉ Email" /></p>
                    <p><input type="text" name="cPhone" value="<?php echo (is_user_logged_in()) ? esc_attr(get_the_author_meta('user_phone', $current_user->ID)) : ""; ?>" placeholder="Số điện thoại" /></p>
                    <p><input type="text" name="cAddress" value="<?php echo (is_user_logged_in()) ? esc_attr(get_the_author_meta('user_address', $current_user->ID)) : ""; ?>" placeholder="Địa chỉ" /></p>
                    <p>
                        <select name="cCity">
                            <?php
                            foreach ($cities as $city) {
                                if (esc_attr(get_the_author_meta('user_city', $current_user->ID)) == $city) {
                                    echo '<option value="' . $city . '" selected="selected">' . $city . '</option>';
                                } else {
                                    echo "<option value=\"$city\">$city</option>";
                                }
                            }
                            ?>
                        </select>
                    </p>
                    <p>
                        <input type="hidden" name="ship" value="0" />
                        <input type="checkbox" id="ship" />
                        <label for="ship">Nhận hàng tại nơi khác</label>
                    </p>
                </div>
                <div class="customerShip" id="divShip">
                    <div class="title">Thông tin nhận hàng</div>
                    <p><input type="text" name="shipName" value="<?php echo (is_user_logged_in()) ? $current_user->display_name : ""; ?>" placeholder="Họ và tên" /></p>
                    <p><input type="text" name="shipEmail" value="<?php echo (is_user_logged_in()) ? $current_user->user_email : ""; ?>" placeholder="Địa chỉ Email" /></p>
                    <p><input type="text" name="shipPhone" value="<?php echo (is_user_logged_in()) ? esc_attr(get_the_author_meta('user_phone', $current_user->ID)) : ""; ?>" placeholder="Số điện thoại" /></p>
                    <p><input type="text" name="shipAddress" value="<?php echo (is_user_logged_in()) ? esc_attr(get_the_author_meta('user_address', $current_user->ID)) : ""; ?>" placeholder="Địa chỉ" /></p>
                    <p>
                        <select name="shipCity">
                            <?php
                            foreach ($cities as $city) {
                                if (esc_attr(get_the_author_meta('user_city', $current_user->ID)) == $city) {
                                    echo '<option value="' . $city . '" selected="selected">' . $city . '</option>';
                                } else {
                                    echo "<option value=\"$city\">$city</option>";
                                }
                            }
                            ?>
                        </select>
                    </p>
                </div>
            </div>
            <div class="payWay">
                <div class="title">Hình thức thanh toán</div>
                <div class="PaymentMethod">
                    <div class="PaymentMethod_Name">
                        <input type="radio" name="payment_method" value="Thanh toán khi nhận hàng (COD)" id="ck1" checked>
                        <label for="ck1">Thanh toán tại nơi nhận hàng</label>
                    </div>
                    <div class="PaymentMethod_Info" id="method1">
                        <?php echo stripslashes(get_option('payment_cashOnDelivery')); ?>
                    </div>
                </div>
                <div class="PaymentMethod">
                    <div class="PaymentMethod_Name">
                        <input type="radio" name="payment_method" value="Chuyển khoản qua tài khoản ATM" id="ck2">
                        <label for="ck2">Thanh toán qua ngân hàng</label>
                    </div>
                    <div class="PaymentMethod_Info" id="method2">
                        <?php echo stripslashes(get_option('payment_atm')); ?>
                    </div>
                </div>
                <div class="PaymentMethod">
                    <div class="PaymentMethod_Name">
                        <input type="radio" name="payment_method" value="Thanh toán tại văn phòng" id="ck3">
                        <label for="ck3">Thanh toán tại văn phòng</label>
                    </div>
                    <div class="PaymentMethod_Info" id="method3">
                        <?php echo stripslashes(get_option('payment_atOffice')); ?>
                    </div>
                </div>
            </div>
            <div class="cartCheckout">
                <div class="title">Thông tin đơn hàng</div>
                <div class="cartInfo">
                    <table>
                        <thead>
                            <tr style="height: 38px;">
                                <th>Tên sản phẩm</th>
                                <th style="width: 40px;">SL</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_SESSION['cart']) and !empty($_SESSION['cart'])):
                                $cart = $_SESSION['cart'];
                                $maxQuantity = get_option($shortname . '_maxQuantity');
                                if ($maxQuantity == "")
                                    $maxQuantity = 10;
                                $totalAmount = 0;
                                foreach ($cart as $product) :
                                    $totalAmount += $product['amount'];
                                    $product_id = $product['id'];
                                    $permalink = get_permalink($product_id);
                                    $title = get_the_title($product_id);
                                    ?>
                                    <tr id="product_item_<?php echo $product_id; ?>">
                                        <td><?php echo $title; ?></td>
                                        <td class="quantity">
                                            <select name="quantity[<?php echo $product_id; ?>]" onchange="AjaxCart.updateItem(<?php echo $product_id; ?>, this.value);">
                                                <?php
                                                for ($i = 0; $i <= $maxQuantity; $i++) {
                                                    if ($i == $product['quantity'])
                                                        echo '<option value="' . $i. '" selected="selected">' . $i . '</option>';
                                                    else
                                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td><span class="product-subtotal"><?php echo number_format($product['amount'], 0, ',', '.'); ?> VNĐ</span></td>
                                    </tr>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </tbody>
                    </table>
                    <p><span>Tổng thanh toán</span>: <span class="cart-price"><?php echo number_format($totalAmount, 0, ',', '.'); ?> VNĐ</span>
                        <input type="hidden" id="total_amount" name="total_amount" value="<?php echo $totalAmount; ?>" />
                    </p>
                    <p><a href="javascript://" id="btnMuaHang">
                            <div class="btnGuiDonHang">Gửi đơn hàng</div>
                        </a></p>
                </div>
            </div>
            <div class="clearfix"></div>
        </form>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#ship').change(function(){
                if(this.checked){
                    $('#divShip').fadeIn('fast');
                    $('input[name=ship]').val(1);
                }else{
                    $('#divShip').fadeOut('normal');
                    $('input[name=ship]').val(0);
                }
            });
            
            /* switch payment method */
            $("#method1").show();
            $("#method2").hide();
            $("#method3").hide();
            $("#ck1").click(function(){
                $("#method1").show();
                $("#method2").hide();
                $("#method3").hide();
            });
            $("#ck2").click(function(){
                $("#method1").hide();
                $("#method2").show();
                $("#method3").hide();
            });
            $("#ck3").click(function(){
                $("#method1").hide();
                $("#method2").hide();
                $("#method3").show();
            });
            
            // Complete order
            $("#btnMuaHang").click(function(){
                var valid = true;
                $(".customerInfo input[type=text], .customerInfo select").each(function(){
                    if($(this).val().length == 0){
                        $(this).addClass('nWarning');
                        valid = false;
                    }else{
                        $(this).removeClass('nWarning');
                    }
                });
                if($('#ship').is(":checked")){
                    $(".customerShip input[type=text], .customerShip select").each(function(){
                        if($(this).val().length == 0){
                            $(this).addClass('nWarning');
                            valid = false;
                        }else{
                            $(this).removeClass('nWarning');
                        }
                    });
                }else{
                    $(".customerShip input[type=text], .customerShip select").each(function(){
                        $(this).removeClass('nWarning');
                    });
                }
                if(valid){
                    AjaxCart.orderComplete($("#frmOrder").serialize());
                }else{
                    scrollToElement("#nNote");
                    displayBarNotification(true, "nWarning", "Vui lòng nhập đầy đủ thông tin.");
                    $('input, textarea').placeholder();
                }
            });
        });
    </script>
</div>


<?php get_footer(); ?>