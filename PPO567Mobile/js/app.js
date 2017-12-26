var PPOSlider = {
    sliderHome:function(){
        $('ul.home-slider').bxSlider({
            nextText: '',
            prevText: '',
            pager: true,
            mode: 'fade',
            auto: true,
            controls:false
        });
    },
    productThumbnail:function(){
        var list=4;
        function PrevNext(a) {

            var ulWidth = $('#thumb li').length;
            var left = $('#thumb').position().left;
            if (a == 1) {
                if (ulWidth > 4 && list < ulWidth) {
                    $('#thumb').animate({
                        left: '-=75'
                    }, 500);
                    list++;
                    $('.thumbprev').show();                    
                }
                else {
                    $('.thumbnext').hide();
                    $('.thumbprev').show();
                }
            } else {
                if (list > 4) {
                    $('#thumb').animate({
                        left: '+=75'
                    }, 500);
                    list--;
                    $('.thumbnext').show();                    

                }
                else {
                    $('.thumbprev').hide();
                    $('.thumbnext').show();
                }
            }
        }

        $('#thumb li a').click(function () {
            $('#thumb li a img').removeClass('selecImg');
            $('#imgView').attr('src', $(this).attr('href')).parent('a').attr('href', $(this).attr('href'));
            $(this).children('img').addClass('selecImg');
            return false;
        });
        if ($('#thumb li').length <= 4) {
            $('.thumbnext').hide();
        }
        $('.thumbnext').click(function () {
            PrevNext(1);
        });
        $('.thumbprev').click(function () {
            PrevNext(0);
        });
    }
};
var PPOFixed = {
    spUuDai:function(){
        var summaries = $('.rboxRed');
        summaries.each(function(i) {
            var summary = $(summaries[i]);
            var next = summaries[i + 1];

            summary.scrollToFixed({
                marginTop: $('#wpadminbar').outerHeight(true),
                limit: function() {
                    var limit = 0;
                    if (next) {
                        limit = $(next).offset().top - $(this).outerHeight(true) - 10;
                    } else {
                        // footer offset top
                        limit = $('.fanfbboxhome').offset().top - $(this).outerHeight(true) - 10;
                    }
                    return limit;
                },
                zIndex: 999
            });
        });
    }
};
var Lightbox = {
    single:function(){
        $('.single-content .content img').each(function(){
            $(this).attr('href', $(this).attr('src')).css({
                'cursor': 'pointer'
            });
        }).addClass('article-group-img').colorbox({
            rel:'article-group-img'
        });
    },
    singleProduct:function(){
        $('.product-info .content img').each(function(){
            $(this).attr('href', $(this).attr('src')).css({
                'cursor': 'pointer'
            });
        }).addClass('article-group-img').colorbox({
            rel:'article-group-img'
        });
    }
};

// Run
$(function(){
    $('ul.tooltip-header li a').hover(function() {
        $(this)
        .parent('li')
        .find('.tt')
        .css({
            display:'block'    
        })
        .stop()
        .animate({
            opacity: 1
        }, 'fast');
    }, function() {
        $(this)
        .parent()
        .find('.tt')
        .css({
            display:'none'
        })
        .stop()
        .animate({
            opacity: 0
        }, 'fast');
    });
    $(window).load(function(){
        if($(this).width() <= 1200){
            $("#social").hide();
        }
    });
    $(window).resize(function(){
        if($(this).width() <= 1200){
            $("#social").hide();
        }else{
            $("#social").show();
        }
    });
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('#toTop').fadeIn();
        } else if($(this).width() >= 1200){
            $('#toTop').fadeOut();
        } else {
            $('#toTop').fadeOut();
        }
    });
    $('input, textarea').placeholder();
    $("#toTop").click(function(){
        scrollToElement("#header"); 
    });
});