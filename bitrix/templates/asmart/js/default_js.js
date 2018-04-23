$(window).resize(function () {
    ShowBasket();
    CarouselItems();
});
$(document).ready(function () {


    ShowBasket();
    CarouselItems();


//-----------------------
//  Get Url Params
// -----------------------

    if (window.location.search.indexOf('ID') > -1) {

        var $getId = getUrlParameter('ID');

        var valuecookies = 'infoblock-' + $getId;
        $('.service-contents').removeClass('display').addClass(' no-display');
        $('.service-contents-walp').find('.infoblock-' + $getId).fadeIn(400).removeClass('no-display').addClass(' display');
        $('.link-to-service').removeClass('current');
        var $url = window.location.href;
        var ret = $url.replace('/index.php?ID='+$getId,'');
        window.history.replaceState(null, null, ret);
        $('.link-to-service').each(function (i, v) {


            if (valuecookies.indexOf($(v).data('id')) > -1) {

                $(v).addClass(' current');

            }

        });

    }

//---------------------------
//  Phone Mask in Order
// ---------------------------
    jQuery('input[name=phone-order]').inputmask({"mask": "+7 (999) 999-9999"});
//---------------------------
//  Check Products  Cookie
// ---------------------------

    var valuecookies = Cookies.get('product_id');

    if (valuecookies !== undefined) {

        // var arrayproducts = valuecookies.split(",");


 
        //
        /*localStorage.removeItem('itemprice-'+$valitemid);
        localStorage.removeItem('itemimg-'+$valitemid);
        localStorage.removeItem('itemname-'+$valitemid);

                    price: $price_product,
            img: $image_product,
            name: $name_product
        */
        // work with local storage for page without items products
        if ($('.item-product').length == 0) {
            
                
            for (var i = 0; i < localStorage.length; i++) {
                var valuecurrent =  JSON.stringify(localStorage.getItem(localStorage.key(i))); 
                var returnObj = JSON.parse(valuecurrent);

                if (returnObj  &&  Number.isInteger(parseInt(localStorage.key(i))) ) {

                    // show button order
              
                    $('.oreder-link').fadeIn(300);

                    if (parseInt($('.header-cart .count-cart').html()) == '0') {
                        $('.header-cart').addClass(' full-cart-show');
                        $('.header-cart .count-cart').html('1');
                    } else {
                        var value_cart_small = $('.header-cart .count-cart').html();
                        var value_cart_small = parseInt(value_cart_small) + 1;
                        $('.header-cart .count-cart').html('').html(value_cart_small);
                    }


                    var countitem,
                        redystatus;
                    var $id =parseInt(localStorage.key(i));

                    var returnObj = JSON.parse(localStorage.getItem(localStorage.key(i)));



                    var $name_product = returnObj.name;
                    var $price_product = returnObj.price;
                    var $image_product = returnObj.img;


                    var $lengthitems = $('.content-basket .basket-item ').length;

                    if ($lengthitems == '0') {


                        countitem = 1;
                        redystatus = '1 Товар на сумму ' + $price_product + ' <i class="fas fa-ruble-sign"></i>';

                    } else {

                        countitem = parseInt($lengthitems + 1);
                        redystatus = '<div class="count-item-value">' + countitem + '</div> <div class="basket-name-changes">Товара</div> на сумму <span></span> <i class="fas fa-ruble-sign"></i>';

                    }

                    $('.content-basket').append('<div class="basket-item" data-price="' + $price_product + '" data-id="' + $id + '">' +
                        '<div class="basket-count">' + countitem + '</div>' +
                        '<img src="' + $image_product + '" /> ' +
                        '<div class="basket-name-item">' + $name_product + '</div> ' +
                        '<div class="basket-delete-item"><i class="fas fa-times"></i></div> ' +
                        '</div>');

                    // var $price_basket_item = $('.content-basket').find(".basket-item").data('price');
                    var $total = 0;
                    $('.basket-item').each(function () {

                        var $price_basket_item = $(this).data('price');

                        $total += parseInt($price_basket_item);
                    });


                    $('.empty-basket').hide();
                    $('.status-basket')
                        .html('')
                        .html(redystatus)
                    ;

                    $('.status-basket span').html($total);


                }
                // detail page
                if ($('.product-detail').length > 0) {
                    var detailid = $('.block-price-order-walp').attr('data-id');
                    var detailprice = $('.price-value-detail span').html();

                    if(detailid ==$id ){

                        $('.block-price-order').html(' ').append('<div class="container">\n' +
                            '                <a href="#" class="link-to-basket-in-item link-to-basket-show">Перейти в корзину</a><div class="block-price-order-walp  remove-item"  data-id="' + detailid + '">\n' +
                            '                    <div class="price-value-detail">\n' +
                            '                        <span>' + detailprice + '</span><i class="fas fa-ruble-sign"></i>\n' +
                            '                    </div>\n' +
                            '                    <a href="#" class="addtocard  remove-item">Удалить</a>\n' +
                            '                </div>\n' +
                            '            </div>');

                    }
                }
            }
     


        } 

        $('.item-product').each(function (i, v) {


            if (valuecookies.indexOf($(v).data('item-id')) > -1) {
            // show button order
      
           $('.oreder-link').fadeIn(300);

                var $this = $(v);

                if (parseInt($('.header-cart .count-cart').html()) == '0') {
                    $('.header-cart').addClass(' full-cart-show');
                    $('.header-cart .count-cart').html('1');
                } else {
                    var value_cart_small = $('.header-cart .count-cart').html();
                    var value_cart_small = parseInt(value_cart_small) + 1;
                    $('.header-cart .count-cart').html('').html(value_cart_small);
                }

                var countitem,
                    redystatus;
                var $id = $($this).find("input[name=id]").val();
                var $name_product = $($this).find(".name-product").html();
                var $price_product = $($this).find(".price-value").data('price');
                var $image_product = $($this).find("img").attr('src');


                // replcae label order
                var $thisbutton = $($this).find('input.addtocard');
                $this.find('.link-to-basket-in-item').addClass(' link-to-basket-show');
                $thisbutton.val('Удалить');
                $thisbutton.addClass(' remove-item');

                $($this).find('.overlay-img-layer').fadeIn(400);

                var $lengthitems = $('.content-basket .basket-item ').length;

                if ($lengthitems == '0') {
                    countitem = 1;
                    redystatus = '1 Товар на сумму ' + $price_product + ' <i class="fas fa-ruble-sign"></i>';

                } else {

                    countitem = parseInt($lengthitems + 1);
                    redystatus = '<div class="count-item-value">' + countitem + '</div> <div class="basket-name-changes">Товара</div> на сумму <span></span> <i class="fas fa-ruble-sign"></i>';

                }

                $('.content-basket').append('<div class="basket-item" data-price="' + $price_product + '" data-id="' + $id + '">' +
                    '<div class="basket-count">' + countitem + '</div>' +
                    '<img src="' + $image_product + '" /> ' +
                    '<div class="basket-name-item">' + $name_product + '</div> ' +
                    '<div class="basket-delete-item"><i class="fas fa-times"></i></div> ' +
                    '</div>');

                // var $price_basket_item = $('.content-basket').find(".basket-item").data('price');
                var $total = 0;
                $('.basket-item').each(function () {

                    var $price_basket_item = $(this).data('price');

                    $total += parseInt($price_basket_item);
                });


                $('.empty-basket').hide();
                $('.status-basket')
                    .html('')
                    .html(redystatus)
                ;

                $('.status-basket span').html($total);


            }// end if  indexof


        });


    }


//---------------------------
//  Add to basket
// ---------------------------


    $(".add_form").submit(function (e) {

        e.preventDefault();

        if ($(this).find('.addtocard').hasClass('remove-item')) {
            return;
        }


        if (parseInt($('.header-cart .count-cart').html()) == '0') {
            $('.header-cart').addClass(' full-cart-show');
            $('.header-cart .count-cart').html('1');
        } else {
            var value_cart_small = $('.header-cart .count-cart').html();
            var value_cart_small = parseInt(value_cart_small) + 1;
            $('.header-cart .count-cart').html('').html(value_cart_small);
        }
        // show button order
        $('.oreder-link').fadeIn(300);

        var countitem,
            redystatus;
        var $id = $(this).find("input[name=id]").val();
        var $name_product = $(this).find(".name-product").html();
        var $price_product = $(this).find(".price-value").data('price');
        var $image_product = $(this).find("img").attr('src');

        // add to cookie
        var valuecookies = Cookies.get('product_id');

        if (valuecookies === undefined || valuecookies === null ) {

            Cookies.set('product_id', $id, {expires: 7});


        } else {
            var arrayfromjson = valuecookies;

            var redycookies = arrayfromjson.concat(',' + $id);

            Cookies.set('product_id', redycookies, {expires: 7});
        }

        // save in localstorage
        var obj = {
            price: $price_product,
            img: $image_product,
            name: $name_product
        };

        var serialObj = JSON.stringify(obj);

        localStorage.setItem($id, serialObj);


        //    Cookies.remove('product_id');
        // replcae label order
        var $thisbutton = $(this).find('input.addtocard');
        $(this).find('.link-to-basket-in-item').addClass(' link-to-basket-show');
        $thisbutton.val('Удалить');
        $thisbutton.addClass(' remove-item');

        $(this).find('.overlay-img-layer').fadeIn(400);

        var $lengthitems = $('.content-basket .basket-item ').length;

        if ($lengthitems == '0') {
            countitem = 1;
            redystatus = '1 Товар на сумму ' + $price_product + ' <i class="fas fa-ruble-sign"></i>';

        } else {

            countitem = parseInt($lengthitems + 1);
            redystatus = '<div class="count-item-value">' + countitem + '</div> <div class="basket-name-changes">Товара</div> на сумму <span></span> <i class="fas fa-ruble-sign"></i>';

        }

        $('.content-basket').append('<div class="basket-item" data-price="' + $price_product + '" data-id="' + $id + '">' +
            '<div class="basket-count">' + countitem + '</div>' +
            '<img src="' + $image_product + '" /> ' +
            '<div class="basket-name-item">' + $name_product + '</div> ' +
            '<div class="basket-delete-item"><i class="fas fa-times"></i></div> ' +
            '</div>');

        // var $price_basket_item = $('.content-basket').find(".basket-item").data('price');
        var $total = 0;
        $('.basket-item').each(function () {

            var $price_basket_item = $(this).data('price');

            $total += parseInt($price_basket_item);
        });


        $('.empty-basket').hide();
        $('.status-basket')
            .html('')
            .html(redystatus)
        ;

        $('.status-basket span').html($total);


    });
//--------------------
// Action Order Button
//--------------------
    $('.oreder-link').click(function () {


        // $(this).addClass(' full-button');
        $(this).css({'height': '100%'});
        $('.back-button').css({'height': '30px'});
        $('.order-link-text').css({'font-size': '30px'});
        $('.submit-order-form').fadeIn(400);

    });

//--------------------
// Show Blocks
//--------------------
    /*$('.link-to-service').live('click', function (e) {
        e.preventDefault();
        var $getid = $(this).data('id');

        $('.service-contents-walp .service-contents').hide();
        $('.service-contents-walp').find('.' + $getid).fadeIn(400);




    });*/
//--------------------
// Show Blocks   Products
//--------------------
    $('.link-to-service').live('click', function (e) {
        e.preventDefault();
        var $getid = $(this).data('id');

        $('.link-to-service').removeClass('current');
        $('.service-contents-walp .service-contents').hide();
        $('.service-contents').removeClass('display');
        $('.service-contents-walp').find('.' + $getid).fadeIn(400).removeClass('no-display').addClass(' display');

        $(this).addClass(' current');

        //$('html, body').animate({scrollTop: $('.service-contents.display').offset().top - 100}, 500);
        $('html, body').animate({scrollTop: $('.'+$getid).offset().top }, 500);
    });

//---------------------------
//  Add to order
// ---------------------------

    $("#order_form").submit(function (e) {

        e.preventDefault();

        var $nameOrder = $(this).find("input[name=name-order]").val();
        var $emailOrder = $(this).find("input[name=email-order]").val();
        var $phoneOrder = $(this).find("input[name=phone-order]").val();
        var $cityOrder = $(this).find("select[name=zhk-order]").val();
        var $adressOrder = $(this).find("input[name=adress-order]").val();
        var $textOrder = $(this).find("textarea[name=text-order]").val();
        var $arr = [];
        $('.basket-item').each(function () {

            var $price_basket_item = $(this).data('price');
            var $name_basket_item = $(this).find('.basket-name-item').html();
            var $number_basket_item = $(this).find('.basket-count').html();

            $arr.push({
                'PRODUCT_ID': parseInt($number_basket_item),
                'NAME': $name_basket_item,
                'PRICE': parseInt($price_basket_item),
                'CURRENCY': 'RUB',
                'QUANTITY': '1'
            });
        });

        // var $arr = {'PRODUCT_ID': '1811', 'NAME' : 'Товар 1', 'PRICE': '500', 'CURRENCY' : 'RUB', 'QUANTITY': '5'};

        var objTest = {
            nameorder: $nameOrder,
            emailorder: $emailOrder,
            phoneorder: $phoneOrder,
            cityorder: $cityOrder,
            adressorder: $adressOrder,
            products: JSON.stringify($arr),
            text: $textOrder
        };

        $('.submit-order-form ').fadeOut(400);
        $('.spiner-order').delay(400).fadeIn(400);


        $.post("/bitrix/templates/asmart/ajax/addtoorder.php", objTest, function (res) {

            console.log(res);
            if (res == 'Ваш заказ оформлен') {
                /* $('.oreder-link')
                     .hide()
                     .removeClass('full-button')
                 ;*/
                // $(this).addClass(' full-button');
                $('.oreder-link').css({'height': '80px'});
                $('.back-button').css({'height': '0'});
                $('.order-link-text').css({'font-size': '16px '});
                $('.spiner-order').hide();

                $('.status-basket').html(' ');
                $('.content-basket')
                    .html(' ')
                    .html('<div class="succes-send-order"><h3>Спасибо!</h3>\n' +
                        'Наши менеджеры свяжутся с вами в ближайшее время.</div>');
                // clean basket in header
                $('.header-cart .count-cart').html('0');
                $('.status-basket').html('');
                $('.empty-basket').fadeIn(300);
                $('.header-cart').removeClass('full-cart-show');
                $('.oreder-link').delay('400').fadeOut(400);

                // clean in products
                $('.overlay-img-layer').fadeOut(400);
                $(this).find('.link-to-basket-in-item').removeClass('link-to-basket-show');
                $('.addtocard').removeClass('remove-item').val('Заказать');

                // remove text
                setTimeout(function () {
                    $(".succes-send-order").remove();
                }, 4000);

                // clean cookies
                Cookies.remove('product_id');
                // clear local storage
                localStorage.clear();

            }
        });
    });

//--------------------
// Delete Items In Basket
//--------------------

    $('.basket-delete-item i').live('click', function (e) {

        e.preventDefault();
        var $thisParent = $(this).parent().parent();
        var currentPriceValue = $thisParent.data('price');

        if (parseInt($('.header-cart .count-cart').html()) == '1') {

            $('.header-cart .count-cart').html('0');
            $('.status-basket').html('');
            $('.empty-basket').fadeIn(300);
            $('.oreder-link').fadeOut(300);
            $('.header-cart').removeClass('full-cart-show');


        } else {

            var value_cart_small = $('.header-cart .count-cart').html();
            var value_cart_small = parseInt(value_cart_small) - 1;
            $('.header-cart .count-cart')
                .html('')
                .html(value_cart_small);

            var $basketValue = $('.status-basket span').html();
            var $basketCountValue = $('.status-basket .count-item-value').html();

            if (parseInt($basketCountValue) == '2') {  // if in status block 2 count item  change last letter

                var $changesWord = $('.status-basket .basket-name-changes').html();
                res = $changesWord.replace("Товара", "Товар");
                $('.status-basket .basket-name-changes')
                    .html('')
                    .html(res)
                ;
            }


            $('.status-basket span')
                .html('')
                .html(parseInt($basketValue - currentPriceValue));

            $('.status-basket .count-item-value')
                .html('')
                .html(parseInt($basketCountValue - 1));


        }

        // hide blocks 'товар в корзине и текст удалить' in page products
        var $itemid = $thisParent.data('id');

        // delete id from cookie
        var valuecookies = Cookies.get('product_id');

        if (valuecookies !== undefined) {

            //var arrayproducts = valuecookies.split(",");
            var arrayproducts = _.split(valuecookies, ',');

            var lasdasd = _.remove(arrayproducts, function (n) {
                return n == $itemid;
            });
            Cookies.remove('product_id');

            Cookies.set('product_id', arrayproducts.toString(), {expires: 7});

            localStorage.removeItem($itemid);


        }
        // for single item detail page
        if ($('.product-detail').length > 0) {

            var priceVlaue = $('.price-value-detail span').html();
            var idVlaue = $('.block-price-order-walp').attr('data-id');

            $('.block-price-order').html(' ').append('<div class="container">\n' +
                '                <div class="block-price-order-walp  "  data-id="' + idVlaue + '">\n' +
                '                    <div class="price-value-detail">\n' +
                '                        <span>' + priceVlaue + '</span><i class="fas fa-ruble-sign"></i>\n' +
                '                    </div>\n' +
                '                    <a href="#" class="addtocard  ">Заказать</a>\n' +
                '                </div>\n' +
                '            </div>');


        }
        $('.item-product').each(function (i, v) {


            if ($(v).data('item-id') == $itemid) {

                $(v).find('.overlay-img-layer').fadeOut(400);
                $(v).find('.link-to-basket-in-item').removeClass(' link-to-basket-show');
                $(v).find('.addtocard').removeClass('remove-item').val('Заказать');

            }
        });
        $thisParent.remove();


    });

//--------------------
// Delete Item in Basket from product page
//--------------------
    $('.addtocard.remove-item').live('click', function (e) {
        //  $('body').delegate('.addtocard.remove-item','click', function (e) {

        e.preventDefault();


        var $thisitemid = $(this).parent().parent().parent();
        var $valitemid = $thisitemid.data('item-id');
        if ($valitemid === undefined) {
            var $valitemid = $(this).parent().parent().parent().parent().parent().data('item-id');


            $('.item-product').each(function (i, v) {


                if ($(v).data('item-id') == $valitemid) {
                    $(v).find('.overlay-img-layer').fadeOut(400);
                    $(v).find('.link-to-basket-in-item').removeClass('link-to-basket-show');
                    $(v).find('.addtocard').removeClass('remove-item').val('Заказать');


                }
            });


        } else {

            $thisitemid.find('.overlay-img-layer').fadeOut(400);
            $(this).parent().find('.link-to-basket-in-item').removeClass('link-to-basket-show');
            $(this).removeClass('remove-item').val('Заказать'); // remove class and chabge text value


        }


        if (parseInt($('.header-cart .count-cart').html()) == '1') {

            $('.header-cart .count-cart').html('0');
            $('.header-cart').removeClass('full-cart-show');
            $('.status-basket').html('');
            $('.empty-basket').fadeIn(300);
            $('.oreder-link').fadeOut(300);
            /* $('.full-cart').hide();
             $('.empty-cart').show();*/

        } else {
            var value_cart_small = $('.header-cart .count-cart').html();
            var value_cart_small = parseInt(value_cart_small) - 1;
            $('.header-cart .count-cart')
                .html('')
                .html(value_cart_small);


        }

        // var currentPriceValue = $thisParent.data('price');


        // delete id from cookie
        var valuecookies = Cookies.get('product_id');
        if ($('.product-detail').length > 0) {

            $valitemid = $('.block-price-order-walp').attr('data-id');
        }

        if (valuecookies !== undefined) {

            //var arrayproducts = valuecookies.split(",");
            var arrayproducts = _.split(valuecookies, ',');

            _.remove(arrayproducts, function (n) {
                return n == $valitemid;
            });
            Cookies.remove('product_id');

            Cookies.set('product_id', arrayproducts.toString(), {expires: 7});
            localStorage.removeItem($valitemid);
        }


        var $basketValue = $('.status-basket span').html();
        var $basketCountValue = $('.status-basket .count-item-value').html();

        if (parseInt($basketCountValue) == '2') {  // if in status block 2 count item  change last letter

            var $changesWord = $('.status-basket .basket-name-changes').html();
            res = $changesWord.replace("Товара", "Товар");
            $('.status-basket .basket-name-changes')
                .html('')
                .html(res)
            ;
        }
        /*
                  $('.status-basket span')
                      .html('')
                      .html(parseInt($basketValue - currentPriceValue));
        */
        $('.status-basket .count-item-value')
            .html('')
            .html(parseInt($basketCountValue - 1));
        // for single item detail page
        if ($('.product-detail').length > 0) {

            $valitemid = $(this).parent().data('id');
        }

        $('.basket-item').each(function (i, v) {


            if ($(v).data('id') == $valitemid) {
                $(v).remove();


            }
        });


    });

//--------------------
// Show Description Item Product
//--------------------
    $('.item-product .overlay-img , .item-product h3').live('click', function (e) {

        var $blockid = $(this).parent().parent().data('block-id');
        var $blockName = $(this).parent().parent().data('block-name');
        var $itemid = $(this).parent().parent().data('item-id');
        var $itemurl = $(this).parent().parent().data('url');
        var $itemurltype = $(this).parent().parent().data('type-img-url');


        var url = document.location.href + $itemurl.slice(1);


        window.history.replaceState(null, null, url);

        var objTest = {
            itemid: $itemid,
            blockid: $blockid
        };

        $.post("/bitrix/templates/asmart/ajax/detail.php", objTest, function (res) {

            obj = $.parseJSON(res);
            console.log(obj);
            if (obj != '') {
                var priceValue = obj.PRICE;
                $('.item-product-modal').fadeIn(500);

                $('body').addClass(' fix-scroll');
                $('.container-item .col-md-4').html(' ');
                $('.container-item .col-md-8').html(' ');
                $('.block-price-order').html(' ');
                $('.price-value-modal span').html(' ');
                $('.bx-breadcrumb-item.last span').html(' ');
                $('.bx-breadcrumb-item.second span').html(' ');
                $('.bx-breadcrumb-item.second a').attr('href',' ');
                $('.bx-breadcrumb-item.second a').attr('href','/index.php?ID='+$blockid);
                $('.bx-breadcrumb-item.second span').html($blockName);
                $('.bx-breadcrumb-item.last span').html(obj.NAME);
                if($itemurltype.length !=''){
                    var contenttypeimg = '<br/><br/><img class="aboniment-img"  src="'+$itemurltype+'"/>';
                }else{
                    var contenttypeimg = ''
                }
                $('.container-item .col-md-4').append('<img src="' + obj.DETAIL_PICTURE + '"/>'+contenttypeimg);
                $('.container-item .col-md-8').append('<h1>' + obj.NAME + '</h1>\n' +
                    '<div class="content-item-modal">' + obj.DETAIL_TEXT + '</div>');
                //$('.price-value-modal span').append();
                $('.item-product-modal').attr('data-item-id', $itemid);
                $('.item-product-modal').attr('data-item-price', priceValue);
                $('header').addClass(' fix-header');
                var valuecookies = Cookies.get('product_id');

                if (valuecookies !== undefined) {
                    if (valuecookies.indexOf($itemid) > -1) {

                        $('.block-price-order').append('<div class="container">\n' +
                            '                   <a href="#" class="link-to-basket-in-item link-to-basket-show">Перейти в корзину</a> <div class="block-price-order-walp remove-item">\n' +
                            '                        <div class="price-value-modal" data-id="' + $itemid + '">\n' +
                            '                            <span>' + priceValue + '</span><i class="fas fa-ruble-sign"></i>\n' +
                            '                        </div>\n' +
                            '                        <a href="#" class="addtocard remove-item">Удалить</a>\n' +
                            '                    </div>\n' +
                            '                </div>');
                    } else {

                        $('.block-price-order').append('<div class="container">\n' +
                            '                    <div class="block-price-order-walp">\n' +
                            '                        <div class="price-value-modal" data-id="' + $itemid + '">\n' +
                            '                            <span>' + priceValue + '</span><i class="fas fa-ruble-sign"></i>\n' +
                            '                        </div>\n' +
                            '                        <a href="#" class="addtocard">Заказать</a>\n' +
                            '                    </div>\n' +
                            '                </div>');
                    }
                }else{
                    $('.block-price-order').append('<div class="container">\n' +
                        '                    <div class="block-price-order-walp">\n' +
                        '                        <div class="price-value-modal" data-id="' + $itemid + '">\n' +
                        '                            <span>' + priceValue + '</span><i class="fas fa-ruble-sign"></i>\n' +
                        '                        </div>\n' +
                        '                        <a href="#" class="addtocard">Заказать</a>\n' +
                        '                    </div>\n' +
                        '                </div>');
                }

            }
        });


    });

//--------------------
// Hide  Description Item Product
//--------------------
    $("body").on("click", ".item-product-modal i", function () {
        //$('').live('click', function () {
        $('.item-product-modal').fadeOut(500);
        $('body').removeClass('fix-scroll');
        $('header').removeClass(' fix-header');
        var url = document.location.host;

        window.history.pushState({}, document.title, "/");


    });

//--------------------
// Hide Order Block
//--------------------
    $('.back-button').live('click', function (e) {

        e.preventDefault();
        $(this).css({'height': '0'});
        /*
                    $('.oreder-link')
                        .removeClass('full-button')
                    ;*/
        // $(this).addClass(' full-button');
        $('.oreder-link').css({'height': '80px'});

        $('.order-link-text').css({'font-size': '16px'});
        $('.submit-order-form').hide();

    });

//--------------------
// Hide Show Modal Feedback
//--------------------
    $('.feedback-modal i').live('click', function (e) {

        e.preventDefault();

        $('.feedback-modal').fadeOut(500);

    });
    $('.btn-modal-feedback').live('click', function (e) {

        e.preventDefault();

        $('.feedback-modal').fadeIn(500);

    });
//--------------------
// Add to basket form modal description item
//--------------------


    $('.item-modal-order .addtocard').live('click', function (e) {
        "use strict";
        e.preventDefault();


        if ($('.block-price-order-walp').is('.remove-item')) {
            $('.block-price-order-walp .addtocard').removeClass('remove-item').html(' ').html('Заказать');
            $('.block-price-order-walp').removeClass('remove-item');

            $(this).parent().parent().find('.link-to-basket-in-item').removeClass('link-to-basket-show');

            return;
        }
        var $this = $(this).parent().parent().parent().parent().parent();


        if (parseInt($('.header-cart .count-cart').html()) == '0') {
            $('.header-cart').addClass(' full-cart-show');
            $('.header-cart .count-cart').html('1');
        } else {
            var value_cart_small = $('.header-cart .count-cart').html();
            var value_cart_small = parseInt(value_cart_small) + 1;
            $('.header-cart .count-cart').html('').html(value_cart_small);
        }
        // show button order
        $('.oreder-link').fadeIn(300);

        var countitem,
            redystatus;

        if ($('.product-detail').length > 0) { // for single item  detail
            var $id = $(this).parent().attr('data-id');
            var $name_product = $(".product-detail  h3").html();
            //var $price_product =   $('.price-value-modal span').html();
            var $price_product = $('.price-value-detail span').html();
            var $image_product = $(".product-detail img").attr('src');
        } else {
            var $id = $this.attr('data-item-id');
            var $name_product = $this.find("h2").html();
            //var $price_product =   $('.price-value-modal span').html();
            var $price_product = $this.attr('data-item-price');
            var $image_product = $this.find("img").attr('src');
        }
        // add to cookie
        var valuecookies = Cookies.get('product_id');

        if (valuecookies === undefined || valuecookies === null) {

            Cookies.set('product_id', $id, {expires: 7});

        } else {
            var arrayfromjson = valuecookies;

            //var redycookies = arrayfromjson.concat(',' + $('.price-value-modal').data('id'));
            var redycookies = arrayfromjson.concat(',' + $id);

            Cookies.set('product_id', redycookies, {expires: 7});
        }


        // save in localstorage
        var obj = {
            price: $price_product,
            img: $image_product,
            name: $name_product
        };

        var serialObj = JSON.stringify(obj);

        localStorage.setItem($id, serialObj);


        //    Cookies.remove('product_id');
        // replcae label order
        $('.item-product').each(function (i, v) {


            if ($(v).data('item-id') == $id) {
                $(v).find('.link-to-basket-in-item').addClass(' link-to-basket-show');
                $(v).find('.addtocard').val('Удалить').addClass(' remove-item');

                $(v).find('.overlay-img-layer').fadeIn(400);

            }
        });

        // for button add in modal form item
        $(this).html('Удалить');
        $(this).addClass(' remove-item');
        $(this).parent().addClass(' remove-item');
        $(this).parent().parent().append('<a href="#" class="link-to-basket-in-item">Перейти в корзину</a>');
        $(this).parent().parent().find('.link-to-basket-in-item').addClass(' link-to-basket-show');


        var $lengthitems = $('.content-basket .basket-item ').length;

        if ($lengthitems == '0') {
            countitem = 1;
            redystatus = '1 Товар на сумму ' + parseInt($price_product) + ' <i class="fas fa-ruble-sign"></i>';

        } else {

            countitem = parseInt($lengthitems + 1);
            redystatus = '<div class="count-item-value">' + countitem + '</div> <div class="basket-name-changes">Товара</div> на сумму <span></span> <i class="fas fa-ruble-sign"></i>';

        }

        $('.content-basket').append('<div class="basket-item" data-price="' + parseInt($price_product) + '" data-id="' + $id + '">' +
            '<div class="basket-count">' + countitem + '</div>' +
            '<img src="' + $image_product + '" /> ' +
            '<div class="basket-name-item">' + $name_product + '</div> ' +
            '<div class="basket-delete-item"><i class="fas fa-times"></i></div> ' +
            '</div>');

        // var $price_basket_item = $('.content-basket').find(".basket-item").data('price');
        var $total = 0;
        $('.basket-item').each(function () {

            var $price_basket_item = $(this).data('price');

            $total += parseInt($price_basket_item);
        });


        $('.empty-basket').hide();
        $('.status-basket')
            .html('')
            .html(redystatus)
        ;

        $('.status-basket span').html($total);


    });


// end redy function

});

//---------------------------
//  Show Basket
// ---------------------------
function ShowBasket() {

    if ($(window).width() > 665) {
        $('.header-cart a, .link-to-basket-in-item').live('click', function (e) {
            e.preventDefault();

            if ($('body').hasClass('show-basket')) {
                $('body').removeClass('show-basket');
            } else {
                $('body').addClass(' show-basket');
            }
        });
        $('.overlay-layer').live('click', function () {
            $('body').removeClass('show-basket');
        });
    } else {
        $('.header-cart a, .link-to-basket-in-item').live('click', function (e) {
            e.preventDefault();
            if ($('body').hasClass('show-basket-mobile')) {
                $('body').removeClass('show-basket-mobile');
                $('header').removeClass(' fix-header');
            } else {
                $('body').addClass(' show-basket-mobile');
                $('header').addClass(' fix-header');
            }
        });
        $('.overlay-layer').live('click', function () {
            $('body').removeClass('show-basket-mobile');
            $('header').removeClass(' fix-header');
        });
    }
}

//-------------------------------
//  Carousel Items
// -----------------------------
function CarouselItems() {


    var owl = $('.service-content-list');
    if ($(window).width() > 550) {

        owl.owlCarousel({
            loop: false,
            nav: false,
            autoWidth: true,
            margin: 30
        });
        owl.on('mousewheel', '.owl-stage', function (e) {
            if (e.deltaY > 0) {
                owl.trigger('next.owl');
            } else {
                owl.trigger('prev.owl');
            }
            e.preventDefault();
        });


    } else {
        owl.owlCarousel({
            loop: false,
            nav: false,
            touchDrag: true,
            margin: 30,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                960: {
                    items: 5
                },
                1200: {
                    items: 6
                }
            }
        });
    }

}

/*
*  Function for Get Params
 */

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};