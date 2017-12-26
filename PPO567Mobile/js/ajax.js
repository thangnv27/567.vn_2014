var reload = false;
function displayBarNotification(n,c,m){
    var nNote = $("#nNote");
    if(n){
        nNote.attr('class', '').addClass("nNote mt15 " + c).show().html(m);
        setTimeout(function(){
            nNote.attr('class', '').hide("slow").html("");
        }, 10000);
    }else{
        nNote.attr('class', '').hide("slow").html("");
    }
}
function displayAjaxLoading(n){
    n?$(".ajax-loading-block-window").show():$(".ajax-loading-block-window").hide("slow");
}
function ShowPoupEditOrder(){
    displayAjaxLoading(true);
    $.get(ajaxurl, {
        'action':'loadCartEditOrder'
    }, function(data) {
        $.colorbox({
            html:data, 
            overlayClose: false,
            onClosed:function(){
                if(reload){
                    window.location.reload();
                }
            }
        });
        displayAjaxLoading(false);
    });
}
function ShowPoupOrderDetail(html){
    displayAjaxLoading(true);
    $.colorbox({
        width: 840,
        html:html
    });
    displayAjaxLoading(false);
}
var AjaxCart = {
    addToCart:function(id, thumb, title, price, quantity){
        displayAjaxLoading(true);
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'addToCart',
                id: id,
                thumb: thumb,
                title: title,
                price: price,
                quantity: quantity
            },
            dataType: 'json',
            cache: false,
            success: function(response, textStatus, XMLHttpRequest){
                scrollToElement("#nNote");
                if(response && response.status == 'success'){
                    displayBarNotification(true, "nSuccess", response.message);
                    setTimeout(function(){
                        setLocation(checkoutUrl);
                    }, 1000);
                }
            },  
            error: function(MLHttpRequest, textStatus, errorThrown){},
            complete:function(){
                displayAjaxLoading(false);
            }
        });
    },
    deleteItem:function(product_id){
        displayAjaxLoading(true);
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'deleteCartItem',
                id: product_id
            },
            dataType: 'json',
            cache: false,
            success: function(response, textStatus, XMLHttpRequest){
                scrollToElement("#nNote");
                if(response && response.status == 'success'){
                    $(".cart-price").html(response.totalAmount);
                    $("#product_item_" + product_id).remove();
                    displayBarNotification(true, "nSuccess", response.message);
                    reload = true;
                }else if(response.status == 'error'){
                    displayBarNotification(true, "nWarning", response.message);
                }
            },  
            error: function(MLHttpRequest, textStatus, errorThrown){},
            complete:function(){
                displayAjaxLoading(false);
            }
        }); 
    },
    updateItem:function(product_id, quantity){
        if(quantity == 0){
            AjaxCart.deleteItem(product_id);
        }else{
            displayAjaxLoading(true);
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'updateCartItem',
                    id: product_id,
                    quantity: quantity
                },
                dataType: 'json',
                cache: false,
                success: function(response, textStatus, XMLHttpRequest){
                    scrollToElement("#nNote");
                    if(response && response.status == 'success'){
                        $("#product_item_" + product_id + " .product-subtotal").html(response.item_amount);
                        $(".cart-price").html(response.totalAmount);
                        displayBarNotification(true, "nSuccess", response.message);
                        reload = true;
                    }else if(response.status == 'error'){
                        displayBarNotification(true, "nWarning", response.message);
                    }
                },  
                error: function(MLHttpRequest, textStatus, errorThrown){},
                complete:function(){
                    displayAjaxLoading(false);
                }
            }); 
        }
    },
    orderComplete:function(data){
        displayAjaxLoading(true);
        $.ajax({
            //this is the php file that processes the data and send mail
            url: ajaxurl,
            //GET method is used
            type: "POST",
            //pass the data
            data: data,
            //Data type
            dataType: "json",
            //Do not cache the page
            cache: false,
            //success
            success: function (response) {
                scrollToElement("#nNote");
                if(response && response.status == 'success'){
                    displayBarNotification(true, "nSuccess", response.message);
                    setTimeout(function(){
                        setLocation(siteUrl);
                    }, 10000);
                }else if(response.status == 'error'){
                    displayBarNotification(true, "nWarning", response.message);
                }else if(response.status == 'failure'){
                    displayBarNotification(true, "nFailure", response.message);
                }
            },
            error: function(MLHttpRequest, textStatus, errorThrown){},
            complete: function(){
                displayAjaxLoading(false);
            }
        });
    }
};
var SendFeedback = {
    show:function(){
        var captchaURL = themeUrl + '/includes/captcha.php'+'?'+Math.random();
        var formHTML = '<div class="feedback_form">\
                    <h3 class="popupTitle">Góp ý</h3>\
                    <form class="frmGeneral" action="" method="post" id="frmFeedback">\
                        <div class="result"></div>\
                        <p><input name="name" id="feedback_name" value="" class="inputText" placeholder="Họ Tên" type="text" /></p>\
                        <p><input name="email" id="feedback_email" value="" class="inputText" placeholder="Địa chỉ email" type="text" /></p>\
                        <p><input name="phone" id="feedback_phone" value="" class="inputText" placeholder="Số điện thoại" type="text" /></p>\
                        <p><textarea rows="5" cols="5" name="content" id="feedback_content" placeholder="Nội dung"></textarea></p>\
                        <p style="overflow: hidden;">\
                            <input style="height: 25px; width: 115px;float: left;" name="captcha" id="feedback_captcha" type="text" />\
                            <img src="' + captchaURL + '" alt="" height="33" width="110" class="captcha fl ml6" />\
                        </p>\
                        <p class="sendFeedback" onclick="SendFeedback.send(this);">Gửi</p>\
                        <input type="hidden" name="action" value="sendFeedback" />\
                    </form>\
                </div>';
        $.colorbox({
            html:formHTML,
            overlayClose:false,
            fixed:true
        });
    },
    send:function(){
        $(".result").attr('class', 'result ajax-loader').html('');
        $.ajax({
            //this is the php file that processes the data and send mail
            url: ajaxurl,
            //GET method is used
            type: "POST",
            //pass the data
            data: $("#frmFeedback").serialize(),
            //Data type
            dataType: "json",
            //Do not cache the page
            cache: false,
            //success
            success: function (response) {
                if(response && response.status == 'success'){
                    $(".result").attr('class', 'result nNote nSuccess').html(response.message);
                }else if(response.status == 'error'){
                    $(".result").attr('class', 'result nNote nWarning').html(response.message);
                }else if(response.status == 'failure'){
                    $(".result").attr('class', 'result nNote nFailure').html(response.message);
                }
                $("#feedback_captcha").val('');
                $(".captcha").attr('src', themeUrl + '/includes/captcha.php'+'?'+Math.random());
            },
            error: function(MLHttpRequest, textStatus, errorThrown){},
            complete: function(){
                $(".result").removeClass("ajax-loader");
            }
        });
    }
};

jQuery(document).ready(function($) {
    $("#nNote").click(function(){
        $(this).attr('class', '').hide("slow").html("");
    });
}); 