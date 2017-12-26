<?php

add_action('init', 'add_custom_js');
add_action( 'wp_ajax_nopriv_' . getRequest('action'), getRequest('action') );  
add_action( 'wp_ajax_' . getRequest('action'), getRequest('action') ); 

function add_custom_js() {
    // code to embed th  java script file that makes the Ajax request  
    wp_enqueue_script('ajax.js', get_bloginfo('template_directory') . "/js/ajax.js", array('jquery'), false, true);
    //wp_enqueue_script('jquery.tooltip.js', get_bloginfo('template_directory') . "/js/jquery.tooltip.js");
    // code to declare the URL to the file handling the AJAX request 
    //wp_localize_script( 'ajax-request', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) ); 
}

/* ----------------------------------------------------------------------------------- */
# Tooltip
/* ----------------------------------------------------------------------------------- */
function product_tooltip(){
    $product_id = getRequest('product_id');
    $price = trim(get_post_meta($product_id, "gia_moi", true)); 
    $status = get_post_meta($product_id, "tinh_trang", true);
    $dis = get_post_meta($product_id, "khuyen_mai", true);
    $sdes = get_post_meta($product_id, "gioi_thieu", true);
    
    $response = array(
        'id' => $product_id,
        'n' => get_the_title($product_id) . "&nbsp;" . get_post_meta($product_id, "ma_sp", true),
        'p' => number_format(floatval($price),0,',','.') . " VNĐ",
        'sv' => null,
        'st' => "<div class=\"status\">{$status}</div>",
        'numdis' => 0,
        'dis' => "<li>{$dis}</li>",
        'sdes' => $sdes,
        'text' => null,
        'discountofweb' => null,
        'availableforpreorder' => FALSE,
        'frtType' => 0,
    );
    
    Response(json_encode($response));
    
    exit();
}

/* ----------------------------------------------------------------------------------- */
# Quick edit
/* ----------------------------------------------------------------------------------- */
function get_product_meta(){
    $product_id = getRequest('product_id');
    $response = array(
        'gia_cu' => get_post_meta( $product_id, 'gia_cu', true ),
        'gia_moi' => get_post_meta( $product_id, 'gia_moi', true ),
        'tinh_trang' => get_post_meta( $product_id, 'tinh_trang', true ),
    );
    
    Response(json_encode($response));
    
    exit();
}

/* ----------------------------------------------------------------------------------- */
# Add product to Cart
/* ----------------------------------------------------------------------------------- */
function addToCart(){
    $lang['products'] = " sản phẩm";
    $lang['added'] = "Đã thêm vào giỏ hàng";
    
    $price = getRequest('price');
    $quantity = intval(getRequest('quantity'));
    $color = getRequest("color");
    $amount = $price * $quantity;
    $product = array(
        'id' => getRequest('id'),
        'thumb' => getRequest('thumb'),
        'title' => getRequest('title'),
        'color' => $color,
        'price' => $price,
        'quantity' => $quantity,
        'amount' => $amount,
    );
    
    if(isset($_SESSION['cart']) and !empty($_SESSION['cart'])){
        $addToCart = TRUE;
        $cart = $_SESSION['cart'];
        foreach ($cart as $k => $v) {
            if(getRequest('id') == $v['id']){
                if($v['quantity'] == $quantity){
                    $addToCart = FALSE;
                }else{
                    unset($cart[$k]);
                }
                break;
            }
        }
        if($addToCart == TRUE){
            array_push($cart, $product);
            $_SESSION['cart'] = $cart;
        }
    }else{
        $cart = array();
        array_push($cart, $product);
        $_SESSION['cart'] = $cart;
    }

    $cart = $_SESSION['cart'];
    $totalAmount = 0;
    foreach ($cart as $product) {
        $totalAmount += $product['amount'];
    }

    // Response message
    Response(json_encode(array(
        'status' => 'success',
        'countCart' => count($cart) . $lang['products'],
        'totalAmount' => number_format($totalAmount,0,',','.') . " VNĐ",
        'message' => $lang['added'],
    )));
    exit();
}
/* ----------------------------------------------------------------------------------- */
# Remove a product in Cart
/* ----------------------------------------------------------------------------------- */
function deleteCartItem(){
    $lang['products'] = " sản phẩm";
    $lang['cart_empty'] = "Bạn không có sản phẩm nào trong giỏ hàng";
    $lang['removed'] = "Đã xóa sản phẩm khỏi giỏ hàng";
    
    if (isset($_SESSION['cart']) and !empty($_SESSION['cart'])) {
        $product_id = intval(getRequest('id'));
        if($product_id > 0){
            $cart = $_SESSION['cart'];
            $totalAmount = 0;
            foreach ($cart as $key => $product) {
                if($product['id'] == $product_id){
                    unset($cart[$key]);
                }else{
                    $totalAmount += $product['amount'];
                }
            }
            array_values($cart);
            $_SESSION['cart'] = $cart;

            Response(json_encode(array(
                'status' => 'success',
                'countCart' => count($cart) . $lang['products'],
                'totalAmount' => number_format($totalAmount,0,',','.') . " VNĐ",
                'message' => $lang['removed'],
            )));
        }
    }else{
        Response(json_encode(array(
            'status' => 'error',
            'message' => $lang['cart_empty'],
        )));
    }
    exit();
}
/* ----------------------------------------------------------------------------------- */
# Update Cart
/* ----------------------------------------------------------------------------------- */
function updateCartItem(){
    $lang['products'] = " sản phẩm";
    $lang['cart_empty'] = "Bạn không có sản phẩm nào trong giỏ hàng";
    $lang['cart_updated'] = "Đã cập nhật giỏ hàng";
    
    if (isset($_SESSION['cart']) and !empty($_SESSION['cart'])) {
        $product_id = intval(getRequest('id'));
        $quantity = intval(getRequest('quantity'));
        if($product_id > 0 and $quantity > 0){
            $cart = $_SESSION['cart'];
            $totalAmount = 0;
            $item_amount = 0;
            foreach ($cart as $key => $product) {
                if($product['id'] == $product_id){
                    $amount = $product['price'] * $quantity;
                    $new_product = $product;
                    $new_product['quantity'] = $quantity;
                    $new_product['amount'] = $amount;
                    unset($cart[$key]);
                    array_push($cart, $new_product);
                    $item_amount = $amount;
                    $totalAmount += $amount;
                }else{
                    $totalAmount += $product['amount'];
                }
            }
            array_values($cart);
            $_SESSION['cart'] = $cart;

            Response(json_encode(array(
                'status' => 'success',
                'countCart' => count($cart) . $lang['products'],
                'item_amount' => number_format($item_amount,0,',','.') . " VNĐ",
                'totalAmount' => number_format($totalAmount,0,',','.') . " VNĐ",
                'message' => $lang['cart_updated'],
            )));
        }
    }else{
        Response(json_encode(array(
            'status' => 'error',
            'message' => $lang['cart_empty'],
        )));
    }
    exit();
}
/* ----------------------------------------------------------------------------------- */
# Complete order
/* ----------------------------------------------------------------------------------- */
function orderComplete() {
    $lang['cart_empty'] = "Đơn hàng không có sản phẩm, vui lòng thêm sản phẩm vào giỏ hàng trước.";
    $lang['cEmail_invalid'] = "<p>Địa chỉ email khách hàng không hợp lệ</p>";
    $lang['shipEmail_invalid'] = "<p>Địa chỉ email nhận hàng không hợp lệ</p>";
    $lang['order_success'] = "Đặt hàng thành công! Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất!";
    $lang['order_failure'] = "Đặt hàng không thành công! Hãy liên lạc với chúng tôi ngay để được trợ giúp!";
    
    if (isset($_SESSION['cart']) and !empty($_SESSION['cart'])) {
        $errorMsg = "";
        if(!is_email(getRequest("cEmail"))){
            $errorMsg .= $lang['cEmail_invalid'];
        }
        if(getRequest("ship") == 1 && !is_email(getRequest("shipEmail"))){
            $errorMsg .= $lang['shipEmail_invalid'];
        }
        
        if($errorMsg == ""){
            global $wpdb, $shortname;
            $cart = $_SESSION['cart'];

            foreach ($cart as $k => $v) {
                unset($v['thumb']);
                $product = $v;
                unset($cart[$k]);
                array_push($cart, $product);
            }
            
            $name = getRequest('cName');
            $email = getRequest('cEmail');
            $phone = getRequest('cPhone');
            $address = getRequest('cAddress');
            $city = getRequest('cCity');
            $customer_id = 0;
            
            if(email_exists($email)){
                $user = get_user_by_email($email);
                $customer_id = $user->ID;
            }else{
                // TODO: Generate a better login (or ask the user for it)
                $login = explode('@', $email);
                $username = $login[0];

                // TODO: Generate a better password (or ask the user for it)
                $password = wp_generate_password();

                // Create the WordPress User object with the basic required information
//                $user_id = wp_create_user($login, $password, $email);
                $user_id = wp_insert_user( array(
                    'user_login' => $username,
                    'user_pass' => $password,
                    'user_email' => $email,
                    'display_name' => $name,
                    'nickname' => $username,
                ) );
                
                if ($user_id) {
                    $customer_id = $user_id;
                    
                    update_usermeta($user_id, 'user_phone', $phone);
                    update_usermeta($user_id, 'user_address', $address);
                    update_usermeta($user_id, 'user_city', $city);
                    
                    custom_wp_new_user_notification($user_id, $password);
                }
            }
            
            $customer_info = json_encode(array(
                'fullname' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'city' => $city,
            ));
            $ship_info = $customer_info;
            if(getRequest("ship") == 1){
                $ship_info = json_encode(array(
                    'fullname' => getRequest('shipName'),
                    'email' => getRequest('shipEmail'),
                    'phone' => getRequest('shipPhone'),
                    'address' => getRequest('shipAddress'),
                    'city' => getRequest('shipCity'),
                ));
            }
            $payment_method = getRequest('payment_method');
            $products = json_encode($cart);
            $total_amount = (is_numeric(getRequest('total_amount'))) ? getRequest('total_amount') : '0';
            
            $tblOrders = $wpdb->prefix . 'orders';
            $result = $wpdb->query($wpdb->prepare("INSERT INTO $tblOrders SET customer_id = %d, customer_info = '%s', 
                ship_info = '%s', payment_method = '%s', products = '%s', total_amount = '%s'", 
                $customer_id, $customer_info, $ship_info, $payment_method, $products, $total_amount));

            if($result){
                unset($_SESSION['cart']);

                Response(json_encode(array(
                        'status' => 'success',
                        'message' => $lang['order_success'],
                    )));
                
                // Send invoice to email
                $bill_title = get_option("bill_title");
                $bill_header = get_option("bill_header");
                $bill_footer = get_option("bill_footer");
                $billNO = date("dmY");
                $billDate = date("d/m/Y");
                $bill_hotline = get_option($shortname . "_hotline");
                $bill_fax = get_option($shortname . "_fax");
                $admin_email = get_option("bill_admin_email");
                if(!is_email($admin_email)){
                    $admin_email = get_settings('admin_email');
                }
                $bill_html = <<<HTML
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<div style="margin: 0 auto;width: 1056px;font-family: Calibri,sans-serif;line-height: 13px;font-size: 14px;">
    <div>
        <img src="{$bill_header}" style="width: 100%;" />
    </div>
    <div style="overflow: hidden;border-bottom: 2px solid #000;">
        <div style="float: left;">
            <p>Khách hàng: {$name}</p>
            <p>Địa chỉ: {$address}</p>
            <p>Điện thoại: {$phone}</p>
            <p>Fax: </p>
            <p>Email: {$email}</p>
        </div>
        <div style="float: right;">
            <p>Số: {$billNO}</p>
            <p>Ngày: {$billDate}</p>
            <p>Có hiệu lực đến: </p>
            <p>Người lập: CÔNG TY TNHH TM - XNK Hoa Thái</p>
            <p>Điện thoại: {$bill_hotline}</p>
            <p>Fax: {$bill_fax}</p>
            <p>Email: {$admin_email}</p>
        </div>
        <div style="clear: both;"></div>
    </div>
    <div style="overflow: hidden;">
        <h1 style="text-align: center; font-size: 20px;text-transform: uppercase;">{$bill_title}</h1>
        <div>
            <table border="1" cellpadding="5" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="width: 40px;">STT</th>
                        <th>Tên sản phẩm</th>
                        <th style="width: 50px;">SL</th>
                        <th>Đơn giá (VNĐ)</th>
                        <th>Thành tiền (VNĐ)</th>
                        <th style="width: 140px;">Ghi chú</th>
                    </tr>
                </thead>
                <tbody>
HTML;
        $totalAmount = 0;
        $counter = 1;
        foreach ($cart as $p) :
            $totalAmount += $p['amount'];
            $product_id = $product['id'];
            $title = get_the_title($product_id);
            $price = number_format($p['price'],0,',','.');
            $amount = number_format($p['amount'],0,',','.');
            $desc = get_post_meta($product_id, "sp_desc", true);
            $bill_html .= <<<HTML
                    <tr>
                        <td align="center">{$counter}</td>
                        <td>{$title}</td>
                        <td align="center">{$p['quantity']}</td>
                        <td align="right">{$price}</td>
                        <td align="right">{$amount}</td>
                        <td>{$desc}</td>
                    </tr>
HTML;
            $counter++;
        endforeach;
        
        $totalPrice = number_format($totalAmount,0,',','.');
        $numToWords = ucfirst(convert_number_to_words($totalAmount));
        $bill_html .= <<<HTML
                    <tr>
                        <td colspan="4" style="text-align: right;text-transform: uppercase;font-weight: bold;">
                            TỔNG CỘNG
                        </td>
                        <td style="text-align: right;">{$totalPrice}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <h4 style="text-align: center;font-style: italic;">(Bằng chữ: {$numToWords} đồng./.)</h4>
        </div>
        <div>
            {$bill_footer}
            <div style="overflow: hidden;margin-bottom: 20px;">
                <div style="float: left;margin-left: 20px;">
                    <h3>Đại diện khách hàng</h3>
                    <div style="text-align: center;">{$name}</div>
                </div>
                <div style="float: right;margin-right: 20px;">
                    <p style="text-align: right;">Hà Nội, 20/11/2013</p>
                    <h3>CÔNG TY TNHH TM - XNK Hoa Thái</h3>
                </div>
                <div style="clear: both;"></div>
            </div>
        </div>
    </div>
</div>
HTML;
               
                $subject = get_option('blogname') . " - Xác nhận đơn hàng";
                
                add_filter( 'wp_mail_content_type', 'set_html_content_type' );
                wp_mail( $email, $subject, $bill_html);
                wp_mail( $admin_email, $subject, $bill_html);
                // reset content-type to avoid conflicts
                remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
            }else{
                Response(json_encode(array(
                        'status' => 'failure',
                        'message' => $lang['order_failure'],
                    )));
            }
        }else{
            Response(json_encode(array(
                    'status' => 'error',
                    'message' => $errorMsg,
                )));
        }
    } else {
        Response(json_encode(array(
                    'status' => 'error',
                    'message' => $lang['cart_empty'],
                )));
    }
    
    exit();
}

function sendFeedback(){
    $name = getRequest("name");
    $email = getRequest("email");
    $phone = getRequest("phone");
    $content = getRequest("content");
    
    $errMsg = "";
    if($_SESSION['security_code'] != getRequest('captcha')){
        $errMsg .= "<p>Sai mã bảo vệ.</p>";
    }else{
        if($name == ""){
            $errMsg .= "<p>Vui lòng nhập họ tên.</p>";
        }
        if($email == ""){
            $errMsg .= "<p>Vui lòng nhập địa chỉ Email.</p>";
        }elseif(!is_email($email)){
            $errMsg .= "<p>Địa chỉ Email không hợp lệ.</p>";
        }
        if($phone == ""){
            $errMsg .= "<p>Vui lòng nhập điện thoại.</p>";
        }
        if($content == ""){
            $errMsg .= "<p>Vui lòng nhập nội dung.</p>";
        }
    }
    
    if($errMsg == ""){
        $admin_email = get_settings('admin_email');
        $subject = "Góp ý - " . get_option('blogname');
        $message = <<<HTML
<p>Chào 567.vn,</p>
<p>Bạn nhận được một thư góp ý từ:</p>
<p>
    Họ và tên: {$name}<br />
    Email: {$email}<br />
    Điện thoại: {$phone}<br />
</p>
<p>Nội dung:</p>
<div>{$content}</div>
<br />
Thank you,
HTML;
        
        add_filter( 'wp_mail_content_type', 'set_html_content_type' );
        wp_mail( $admin_email, $subject, $message);
        // reset content-type to avoid conflicts
        remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
        
        Response(json_encode(array(
                    'status' => 'success',
                    'message' => "<p>Thư gửi thành công. Cám ơn bạn đã gửi thư góp ý tới chúng tôi!</p>",
                )));
    }else{
        Response(json_encode(array(
                    'status' => 'error',
                    'message' => $errMsg,
                )));
    }
    
    exit();
}