/*=========================================================================================
	File Name: form-number-input.js
	Description: Number Input
	----------------------------------------------------------------------------------------
	Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
	Author: PIXINVENT
	Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

(function (window, document, $) {
    'use strict';

    // Default Spin
    $('.touchspin').TouchSpin({
        buttondown_class: 'btn btn-primary',
        buttonup_class: 'btn btn-primary',
        buttondown_txt: feather.icons['minus'].toSvg(),
        buttonup_txt: feather.icons['plus'].toSvg()
    });

    // Icon Change
    $('.touchspin-icon').TouchSpin({
        buttondown_txt: feather.icons['chevron-down'].toSvg(),
        buttonup_txt: feather.icons['chevron-up'].toSvg()
    });


    //Quantity
    var touchspinValue = $('.touchspin-min-max'),
        selection = document.getElementById("productSelect"),
        tPrice = document.getElementById("total_price"),
        btnPurchase = $('#item-buttons'),
        price = 500,
        fee = document.getElementById("prodFee"),
        btnCart = $('.btn-cart'),
        wishlist = $('.btn-wishlist'),
        prdColorOpt = $('.product-color-options'),
        btsTouchSpin = $('.bootstrap-touchspin'),
        lineBrdr = $('#lineBorder'),
        checkout = 'app-ecommerce-checkout.html',
        isRtl = $('html').attr('data-textdirection') === 'rtl';

    var counterMin = 1;
    var counterMax = 10;

    selection.onchange = function (event) {

        if (event.target.value != 0) {
            counterMax = event.target.options[event.target.selectedIndex].dataset.stock;
            price = event.target.options[event.target.selectedIndex].dataset.price;
            //console.log("Stock: " + counterMax);
            //console.log("Price: " + price);
            prdColorOpt.removeClass('hidden');
            btsTouchSpin.removeClass('hidden');
            lineBrdr.removeClass('hidden');
            btnPurchase.removeClass('hidden');
            $('.bootstrap-touchspin-up').removeClass('disabled-max-min');
            $('.bootstrap-touchspin-down').removeClass('disabled-max-min');
            touchspinValue.trigger("touchspin.updatesettings", { max: counterMax });

            updatePrice();
        } else {
            counterMax = 0;
            price = 0;
            btsTouchSpin.addClass('hidden');
            prdColorOpt.addClass('hidden');
            lineBrdr.addClass('hidden');
            btnPurchase.addClass('hidden');
        }
    };

    // On cart & view cart btn click to v
    if (btnCart.length) {
        btnCart.on('click', function (e) {
            var $this = $(this),
                addToCart = $this.find('.add-to-cart');
            if (addToCart.length > 0) {
                buyItem();
                e.preventDefault();
                //addToCart.text('View In Cart').removeClass('add-to-cart').addClass('view-in-cart');
                //$this.attr('href', checkout);
                /*toastr['success']('', 'Added Item In Your Cart 🛒', {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                });*/
            }
        });
    }

    function buyItem() {
        $.ajax({
            url: '../../api/shop/product.php?op=buy',
            method: 'POST',
            data: {
                product_id: document.getElementById("prodID").value,
                item_id: document.getElementById("productSelect").value,
                quantity: touchspinValue.val()
            },
            beforeSend: function () {
                
            },
            error: err => {
                //console.log(err)
            },
            success: function (resp) {
                const test = JSON.parse(resp);
                //console.log(test);

                if (test.id == 100016) {
                    get_notification();
                    //reload_points();
                }

                toastr[test.type](test.desc, test.title, {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                });
            }
        })
    }


    function updatePrice() {
        let total = (price * touchspinValue.val()) + Number(fee.value);
        total.toLocaleString(undefined, { maximumFractionDigits: 2 })
        const decimalsFormated = total.toLocaleString(undefined, { maximumFractionDigits: 2 });
        const finalFormated = String(decimalsFormated).replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        if (!isDecimal(decimalsFormated)) {
            tPrice.innerHTML = '<img src=\"../../../app-assets/images/ico/coins-32.png\" alt=\"Points\">  ' + finalFormated+'.00';
        } else {
            tPrice.innerHTML = '<img src=\"../../../app-assets/images/ico/coins-32.png\" alt=\"Points\">   ' + finalFormated;
        }
    }

    function isDecimal(input) {
        var regex = /^\d+\.\d{0,2}$/;
        return (regex.test(input));
    }

    if (touchspinValue.length > 0) {
        touchspinValue
            .TouchSpin({
                min: counterMin,
                max: counterMax,
                buttondown_txt: feather.icons['minus'].toSvg(),
                buttonup_txt: feather.icons['plus'].toSvg()
            })
            .on('touchspin.on.startdownspin', function () {
                var $this = $(this);
                $('.bootstrap-touchspin-up').removeClass('disabled-max-min');
                if ($this.val() == counterMin) {
                    $(this).siblings().find('.bootstrap-touchspin-down').addClass('disabled-max-min');
                }
            })
            .on('touchspin.on.startupspin', function () {
                var $this = $(this);
                $('.bootstrap-touchspin-down').removeClass('disabled-max-min');
                if ($this.val() == counterMax) {
                    $(this).siblings().find('.bootstrap-touchspin-up').addClass('disabled-max-min');
                }
            })
            .on('change', function () {
                updatePrice();
            });
    }

  
  // Color Options
  $('.touchspin-color').each(function (index) {
    var down = 'btn btn-primary',
      up = 'btn btn-primary',
      $this = $(this);
    if ($this.data('bts-button-down-class')) {
      down = $this.data('bts-button-down-class');
    }
    if ($this.data('bts-button-up-class')) {
      up = $this.data('bts-button-up-class');
    }
    $this.TouchSpin({
      mousewheel: false,
      buttondown_class: down,
      buttonup_class: up,
      buttondown_txt: feather.icons['minus'].toSvg(),
      buttonup_txt: feather.icons['plus'].toSvg()
    });
  });
})(window, document, jQuery);
