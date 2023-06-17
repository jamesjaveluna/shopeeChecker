/*=========================================================================================
    File Name: app-ecommerce.js
    Description: Ecommerce pages js
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

'use strict';

$(function () {
  // RTL Support
  var direction = 'ltr',
    isRTL = false;

  if ($('html').data('textdirection') == 'rtl') {
    direction = 'rtl';
  }

  if (direction === 'rtl') {
    isRTL = true;
  }


    var sidebarShop = $('.sidebar-shop'),
        btnCart = $('.btn-cart'),
        overlay = $('.body-content-overlay'),
        sidebarToggler = $('.shop-sidebar-toggler'),
        gridViewBtn = $('.grid-view-btn'),
        listViewBtn = $('.list-view-btn'),
        priceSlider = document.getElementById('price-slider'),
        ecommerceProducts = $('#ecommerce-products'),
        sortingDropdown = $('.dropdown-sort .dropdown-item'),
        sortingText = $('.dropdown-toggle .active-sorting'),
        wishlist = $('.btn-wishlist'),
        search = $('.search-product'),
        ecommercePagination = $('#ecommerce-pagination'),
        searchResults = $('.search-results'),
        checkout = 'app-ecommerce-checkout.html';
        
        

  if ($('body').attr('data-framework') === 'laravel') {
    var url = $('body').attr('data-asset-path');
    checkout = url + 'app/ecommerce/checkout';
  }

  // On sorting dropdown change
  if (sortingDropdown.length) {
    sortingDropdown.on('click', function () {
      var $this = $(this);
      var selectedLang = $this.text();
      sortingText.text(selectedLang);
    });
  }

  // Show sidebar
  if (sidebarToggler.length) {
    sidebarToggler.on('click', function () {
      sidebarShop.toggleClass('show');
      overlay.toggleClass('show');
      $('body').addClass('modal-open');
    });
  }

  // Overlay Click
  if (overlay.length) {
    overlay.on('click', function (e) {
      sidebarShop.removeClass('show');
      overlay.removeClass('show');
      $('body').removeClass('modal-open');
    });
  }

  // Init Price slider
  if (typeof priceSlider !== undefined && priceSlider !== null) {
    noUiSlider.create(priceSlider, {
      start: [1500, 3500],
      direction: direction,
      connect: true,
      tooltips: [true, true],
      format: wNumb({
        decimals: 0
      }),
      range: {
        min: 51,
        max: 5000
      }
    });
  }

  // Grid View
  if (gridViewBtn.length) {
    gridViewBtn.on('click', function () {
      ecommerceProducts.removeClass('list-view').addClass('grid-view');
      listViewBtn.removeClass('active');
      gridViewBtn.addClass('active');
    });
  }

  // List View
  if (listViewBtn.length) {
    listViewBtn.on('click', function () {
      ecommerceProducts.removeClass('grid-view').addClass('list-view');
      gridViewBtn.removeClass('active');
      listViewBtn.addClass('active');
    });
  }


     
    //Search
    search.on('keyup', function (event) {
        if (event.key === 'Backspace') {
            if (document.getElementById("shop-search").value.length == 0) {
                get_products();
            }
        }


        if (event.key === 'Enter' && document.getElementById("shop-search").value.length ) {
            $.ajax({
                url: '../../api/shop/product.php?op=search_product_v2',
                method: 'POST',
                data: {
                    keyword: document.getElementById("shop-search").value,
                    page: document.getElementById("page-id").value

                },
                beforeSend: function () {
                    const element = document.getElementById("ecommerce-products");
                    while (element.firstChild) {
                        element.removeChild(element.lastChild);
                    }
                    ecommercePagination.removeAttr("style").hide();
                },
                error: err => {
                    //console.log(err)
                   
                },
                success: function (resp) {
                    const obj = resp;
                    var listDiv = document.getElementById('ecommerce-products');

                    for (var i = 0; i < obj.results; i++) {
                        var product = obj.products[i];

                        var blockImg = document.createElement('img');
                        blockImg.className = "img-fluid card-img-top";
                        blockImg.src = "../../../app-assets/images/pages/eCommerce/" + product.img;

                        var blockA = document.createElement('a');
                        blockA.appendChild(blockImg);
                        blockA.href = "#s";

                        //var blockDiv = document.createElement('div');
                        //blockDiv.appendChild(blockA);
                        //blockDiv.className = "item-img text-center";

                        var ratings_svg_polygon_1 = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
                        ratings_svg_polygon_1.setAttribute("points", "12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2");

                        var ratings_svg_1 = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                        ratings_svg_1.setAttribute("viewBox", "0 0 24 24");
                        ratings_svg_1.setAttribute("width", "14");
                        ratings_svg_1.setAttribute("height", "14");
                        ratings_svg_1.setAttribute("fill", "none");
                        ratings_svg_1.setAttribute("stroke", "currentColor");
                        ratings_svg_1.setAttribute("stroke-width", "2");
                        ratings_svg_1.setAttribute("stroke-linecap", "round");
                        ratings_svg_1.setAttribute("stroke-linejoin", "round");
                        ratings_svg_1.setAttribute("class", "feather feather-star filled-star");
                        ratings_svg_1.appendChild(ratings_svg_polygon_1);

                        var item_rating_list_1 = document.createElement("li");
                        item_rating_list_1.className = "ratings-list-item";
                        item_rating_list_1.appendChild(ratings_svg_1);

                        var ratings_svg_polygon_2 = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
                        ratings_svg_polygon_2.setAttribute("points", "12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2");

                        var ratings_svg_2 = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                        ratings_svg_2.setAttribute("viewBox", "0 0 24 24");
                        ratings_svg_2.setAttribute("width", "14");
                        ratings_svg_2.setAttribute("height", "14");
                        ratings_svg_2.setAttribute("fill", "none");
                        ratings_svg_2.setAttribute("stroke", "currentColor");
                        ratings_svg_2.setAttribute("stroke-width", "2");
                        ratings_svg_2.setAttribute("stroke-linecap", "round");
                        ratings_svg_2.setAttribute("stroke-linejoin", "round");
                        ratings_svg_2.setAttribute("class", "feather feather-star filled-star");
                        ratings_svg_2.appendChild(ratings_svg_polygon_2);

                        var item_rating_list_2 = document.createElement("li");
                        item_rating_list_2.className = "ratings-list-item";
                        item_rating_list_2.appendChild(ratings_svg_2);

                        var ratings_svg_polygon_3 = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
                        ratings_svg_polygon_3.setAttribute("points", "12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2");

                        var ratings_svg_3 = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                        ratings_svg_3.setAttribute("viewBox", "0 0 24 24");
                        ratings_svg_3.setAttribute("width", "14");
                        ratings_svg_3.setAttribute("height", "14");
                        ratings_svg_3.setAttribute("fill", "none");
                        ratings_svg_3.setAttribute("stroke", "currentColor");
                        ratings_svg_3.setAttribute("stroke-width", "2");
                        ratings_svg_3.setAttribute("stroke-linecap", "round");
                        ratings_svg_3.setAttribute("stroke-linejoin", "round");
                        ratings_svg_3.setAttribute("class", "feather feather-star filled-star");
                        ratings_svg_3.appendChild(ratings_svg_polygon_3);

                        var item_rating_list_3 = document.createElement("li");
                        item_rating_list_3.className = "ratings-list-item";
                        item_rating_list_3.appendChild(ratings_svg_3);

                        var ratings_svg_polygon_4 = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
                        ratings_svg_polygon_4.setAttribute("points", "12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2");

                        var ratings_svg_4 = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                        ratings_svg_4.setAttribute("viewBox", "0 0 24 24");
                        ratings_svg_4.setAttribute("width", "14");
                        ratings_svg_4.setAttribute("height", "14");
                        ratings_svg_4.setAttribute("fill", "none");
                        ratings_svg_4.setAttribute("stroke", "currentColor");
                        ratings_svg_4.setAttribute("stroke-width", "2");
                        ratings_svg_4.setAttribute("stroke-linecap", "round");
                        ratings_svg_4.setAttribute("stroke-linejoin", "round");
                        ratings_svg_4.setAttribute("class", "feather feather-star filled-star");
                        ratings_svg_4.appendChild(ratings_svg_polygon_4);

                        var item_rating_list_4 = document.createElement("li");
                        item_rating_list_4.className = "ratings-list-item";
                        item_rating_list_4.appendChild(ratings_svg_4);

                        var ratings_svg_polygon_5 = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
                        ratings_svg_polygon_5.setAttribute("points", "12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2");

                        var ratings_svg_5 = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                        ratings_svg_5.setAttribute("viewBox", "0 0 24 24");
                        ratings_svg_5.setAttribute("width", "14");
                        ratings_svg_5.setAttribute("height", "14");
                        ratings_svg_5.setAttribute("fill", "none");
                        ratings_svg_5.setAttribute("stroke", "currentColor");
                        ratings_svg_5.setAttribute("stroke-width", "2");
                        ratings_svg_5.setAttribute("stroke-linecap", "round");
                        ratings_svg_5.setAttribute("stroke-linejoin", "round");
                        ratings_svg_5.setAttribute("class", "feather feather-star filled-star");
                        ratings_svg_5.appendChild(ratings_svg_polygon_5);

                        var item_rating_list_5 = document.createElement("li");
                        item_rating_list_5.className = "ratings-list-item";
                        item_rating_list_5.appendChild(ratings_svg_5);

                        var unstyled_list = document.createElement("ul");
                        unstyled_list.className = "unstyled-list list-inline";
                        unstyled_list.appendChild(item_rating_list_1);
                        unstyled_list.appendChild(item_rating_list_2);
                        unstyled_list.appendChild(item_rating_list_3);
                        unstyled_list.appendChild(item_rating_list_4);
                        unstyled_list.appendChild(item_rating_list_5);


                        var item_rating = document.createElement('div');
                        item_rating.className = "item-rating";
                        item_rating.appendChild(unstyled_list);

                        var blockH6 = document.createElement('h6');
                        blockH6.className = "item-price";
                        blockH6.innerText = "₱" + product.price, 2;

                        var wrapper = document.createElement('div');
                        wrapper.appendChild(item_rating);
                        wrapper.appendChild(blockH6);
                        wrapper.className = "item-wrapper";

                       
                        var item_name = document.createElement('H6');
                        item_name.className = "item-name";
                        var item_name_a = document.createElement('a');
                        item_name_a.className = "text-body";
                        item_name_a.href = "../../shop/" + product.slug + "/details";
                        item_name_a.innerHTML = product.name;
                        item_name.appendChild(item_name_a);

                        var item_description = document.createElement("p");
                        item_description.className = "card-text item-description";
                        item_description.innerHTML = product.description;

                        var card_body = document.createElement('div');
                        card_body.appendChild(wrapper);
                        card_body.appendChild(item_name);
                        card_body.appendChild(item_description);
                        card_body.className = "card-body";


                        var item_price = document.createElement("H4");
                        item_price.className = "item-price";
                        item_price.innerHTML = '<img src="../../../app-assets/images/ico/coins-16.png" alt="Points" draggable="false"> '+product.price;

                        var item_cost = document.createElement("div");
                        item_cost.className = "item-cost";
                        item_cost.appendChild(item_price);

                        var item_wrapper = document.createElement("div");
                        item_wrapper.className = "item-wrapper";
                        item_wrapper.appendChild(item_cost);

                        var wishlist_span = document.createElement("span");
                        wishlist_span.innerHTML = "Wishlist";

                        var wishlist_path = document.createElementNS("http://www.w3.org/2000/svg", "path");
                        wishlist_path.setAttribute("d", "M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z");

                        var wishlist_svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                        wishlist_svg.setAttribute("viewBox", "0 0 24 24");
                        wishlist_svg.setAttribute("width", "14");
                        wishlist_svg.setAttribute("height", "14");
                        wishlist_svg.setAttribute("fill", "none");
                        wishlist_svg.setAttribute("stroke", "currentColor");
                        wishlist_svg.setAttribute("stroke-width", "2");
                        wishlist_svg.setAttribute("stroke-linecap", "round");
                        wishlist_svg.setAttribute("stroke-linejoin", "round");
                        wishlist_svg.setAttribute("class", "feather feather-heart text-danger");
                        wishlist_svg.appendChild(wishlist_path);

                        var wishlist_a = document.createElement("a");
                        wishlist_a.href = "#wishlist";
                        wishlist_a.className = "btn btn-light btn-wishlist waves-effect waves-float waves-light";
                        wishlist_a.appendChild(wishlist_svg);
                        wishlist_a.appendChild(wishlist_span);

                        var select_span = document.createElement("span");
                        select_span.innerHTML = "Select";
                        select_span.className = "add-to-cart";

                        var select_circle_1 = document.createElementNS("http://www.w3.org/2000/svg", "circle");
                        select_circle_1.setAttribute("cx", "9");
                        select_circle_1.setAttribute("cy", "21");
                        select_circle_1.setAttribute("r", "1");

                        var select_circle_2 = document.createElementNS("http://www.w3.org/2000/svg", "circle");
                        select_circle_2.setAttribute("cx", "20");
                        select_circle_2.setAttribute("cy", "21");
                        select_circle_2.setAttribute("r", "1");

                        var select_line = document.createElementNS("http://www.w3.org/2000/svg", "line");
                        select_line.setAttribute("x1", "5");
                        select_line.setAttribute("y1", "12");
                        select_line.setAttribute("x2", "19");
                        select_line.setAttribute("y2", "12");

                        var select_polyline = document.createElementNS("http://www.w3.org/2000/svg", "polyline");
                        select_polyline.setAttribute("points", "12 5 19 12 12 19");

                        var select_path = document.createElementNS("http://www.w3.org/2000/svg", "path");
                        select_path.setAttribute("d", "M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6");

                        var select_svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                        select_svg.setAttribute("viewBox", "0 0 24 24");
                        select_svg.setAttribute("width", "24");
                        select_svg.setAttribute("height", "24");
                        select_svg.setAttribute("fill", "none");
                        select_svg.setAttribute("stroke", "currentColor");
                        select_svg.setAttribute("stroke-width", "2");
                        select_svg.setAttribute("stroke-linecap", "round");
                        select_svg.setAttribute("stroke-linejoin", "round");
                        select_svg.setAttribute("class", "feather feather-arrow-right");
                        //select_svg.appendChild(select_circle_1);
                        //select_svg.appendChild(select_circle_2);
                        //select_svg.appendChild(select_path);
                        select_svg.appendChild(select_line);
                        select_svg.appendChild(select_polyline);

                        var select_a = document.createElement("a");
                        select_a.href = "../../shop/"+product.slug+"/details";
                        select_a.className = "btn btn-primary btn-cart waves-effect waves-float waves-light";
                        select_a.appendChild(select_svg);
                        select_a.appendChild(select_span);

                        var item_options = document.createElement('div');
                        item_options.className = "item-options text-center";
                        item_options.appendChild(item_wrapper);
                        //item_options.appendChild(wishlist_a);
                        item_options.appendChild(select_a);
                        

                        var container = document.createElement('div');
                        container.className = "card ecommerce-card";
                        //container.appendChild(blockDiv);
                        container.appendChild(blockA); //FIX: Image
                        container.appendChild(card_body);
                        container.appendChild(item_options);

                        listDiv.appendChild(container);
                    }

                    searchResults.show();
                    searchResults.html(obj.results + " results found.");
                    
                }
            })
         }
    })
 


});

// on window resize hide sidebar
$(window).on('resize', function () {
  if ($(window).outerWidth() >= 991) {
    $('.sidebar-shop').removeClass('show');
    $('.body-content-overlay').removeClass('show');
  }
});

function get_products() {
    $.ajax({
        url: '../../api/shop/product.php?op=get_products_v2',
        method: 'POST',
        data: {
            keyword: document.getElementById("shop-search").value,
            page: document.getElementById("page-id").value

        },
        beforeSend: function () {
            const element = document.getElementById("ecommerce-products");
            while (element.firstChild) {
                element.removeChild(element.lastChild);
            }
            $('.search-results').removeAttr("style").hide();
        },
        error: err => {
            //console.log(err)

        },
        success: function (resp) {
            //console.log(resp);
            const obj = resp;
            var listDiv = document.getElementById('ecommerce-products');

            for (var i = 0; i < obj.results; i++) {
                var product = obj.products[i];

                var blockImg = document.createElement('img');
                blockImg.className = "img-fluid card-img-top";
                blockImg.src = "../../../app-assets/images/pages/eCommerce/" + product.img;

                var blockA = document.createElement('a');
                blockA.appendChild(blockImg);
                blockA.href = "../../shop/" + product.slug + "/details";

               // var blockDiv = document.createElement('div');
               // blockDiv.appendChild(blockA);
               // blockDiv.className = "item-img text-center";

                var ratings_svg_polygon_1 = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
                ratings_svg_polygon_1.setAttribute("points", "12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2");

                var ratings_svg_1 = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                ratings_svg_1.setAttribute("viewBox", "0 0 24 24");
                ratings_svg_1.setAttribute("width", "14");
                ratings_svg_1.setAttribute("height", "14");
                ratings_svg_1.setAttribute("fill", "none");
                ratings_svg_1.setAttribute("stroke", "currentColor");
                ratings_svg_1.setAttribute("stroke-width", "2");
                ratings_svg_1.setAttribute("stroke-linecap", "round");
                ratings_svg_1.setAttribute("stroke-linejoin", "round");
                ratings_svg_1.setAttribute("class", "feather feather-star filled-star");
                ratings_svg_1.appendChild(ratings_svg_polygon_1);

                var item_rating_list_1 = document.createElement("li");
                item_rating_list_1.className = "ratings-list-item";
                item_rating_list_1.appendChild(ratings_svg_1);

                var ratings_svg_polygon_2 = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
                ratings_svg_polygon_2.setAttribute("points", "12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2");

                var ratings_svg_2 = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                ratings_svg_2.setAttribute("viewBox", "0 0 24 24");
                ratings_svg_2.setAttribute("width", "14");
                ratings_svg_2.setAttribute("height", "14");
                ratings_svg_2.setAttribute("fill", "none");
                ratings_svg_2.setAttribute("stroke", "currentColor");
                ratings_svg_2.setAttribute("stroke-width", "2");
                ratings_svg_2.setAttribute("stroke-linecap", "round");
                ratings_svg_2.setAttribute("stroke-linejoin", "round");
                ratings_svg_2.setAttribute("class", "feather feather-star filled-star");
                ratings_svg_2.appendChild(ratings_svg_polygon_2);

                var item_rating_list_2 = document.createElement("li");
                item_rating_list_2.className = "ratings-list-item";
                item_rating_list_2.appendChild(ratings_svg_2);

                var ratings_svg_polygon_3 = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
                ratings_svg_polygon_3.setAttribute("points", "12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2");

                var ratings_svg_3 = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                ratings_svg_3.setAttribute("viewBox", "0 0 24 24");
                ratings_svg_3.setAttribute("width", "14");
                ratings_svg_3.setAttribute("height", "14");
                ratings_svg_3.setAttribute("fill", "none");
                ratings_svg_3.setAttribute("stroke", "currentColor");
                ratings_svg_3.setAttribute("stroke-width", "2");
                ratings_svg_3.setAttribute("stroke-linecap", "round");
                ratings_svg_3.setAttribute("stroke-linejoin", "round");
                ratings_svg_3.setAttribute("class", "feather feather-star filled-star");
                ratings_svg_3.appendChild(ratings_svg_polygon_3);

                var item_rating_list_3 = document.createElement("li");
                item_rating_list_3.className = "ratings-list-item";
                item_rating_list_3.appendChild(ratings_svg_3);

                var ratings_svg_polygon_4 = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
                ratings_svg_polygon_4.setAttribute("points", "12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2");

                var ratings_svg_4 = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                ratings_svg_4.setAttribute("viewBox", "0 0 24 24");
                ratings_svg_4.setAttribute("width", "14");
                ratings_svg_4.setAttribute("height", "14");
                ratings_svg_4.setAttribute("fill", "none");
                ratings_svg_4.setAttribute("stroke", "currentColor");
                ratings_svg_4.setAttribute("stroke-width", "2");
                ratings_svg_4.setAttribute("stroke-linecap", "round");
                ratings_svg_4.setAttribute("stroke-linejoin", "round");
                ratings_svg_4.setAttribute("class", "feather feather-star filled-star");
                ratings_svg_4.appendChild(ratings_svg_polygon_4);

                var item_rating_list_4 = document.createElement("li");
                item_rating_list_4.className = "ratings-list-item";
                item_rating_list_4.appendChild(ratings_svg_4);

                var ratings_svg_polygon_5 = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
                ratings_svg_polygon_5.setAttribute("points", "12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2");

                var ratings_svg_5 = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                ratings_svg_5.setAttribute("viewBox", "0 0 24 24");
                ratings_svg_5.setAttribute("width", "14");
                ratings_svg_5.setAttribute("height", "14");
                ratings_svg_5.setAttribute("fill", "none");
                ratings_svg_5.setAttribute("stroke", "currentColor");
                ratings_svg_5.setAttribute("stroke-width", "2");
                ratings_svg_5.setAttribute("stroke-linecap", "round");
                ratings_svg_5.setAttribute("stroke-linejoin", "round");
                ratings_svg_5.setAttribute("class", "feather feather-star filled-star");
                ratings_svg_5.appendChild(ratings_svg_polygon_5);

                var item_rating_list_5 = document.createElement("li");
                item_rating_list_5.className = "ratings-list-item";
                item_rating_list_5.appendChild(ratings_svg_5);

                var unstyled_list = document.createElement("ul");
                unstyled_list.className = "unstyled-list list-inline";
                unstyled_list.appendChild(item_rating_list_1);
                unstyled_list.appendChild(item_rating_list_2);
                unstyled_list.appendChild(item_rating_list_3);
                unstyled_list.appendChild(item_rating_list_4);
                unstyled_list.appendChild(item_rating_list_5);


                var item_rating = document.createElement('div');
                item_rating.className = "item-rating";
                item_rating.appendChild(unstyled_list);

                var blockH6 = document.createElement('h6');
                blockH6.className = "item-price";
                blockH6.innerHTML = '<img src="../../../app-assets/images/ico/coins-16.png" alt="Points" draggable="false"><strong class="text-primary"> ' + product.price, 2 + '</strong>';

                var wrapper = document.createElement('div');
                wrapper.appendChild(item_rating);
                wrapper.appendChild(blockH6);
                wrapper.className = "item-wrapper";


                var item_name = document.createElement('H6');
                item_name.className = "item-name";
                var item_name_a = document.createElement('a');
                item_name_a.className = "text-body";
                item_name_a.href = "../../shop/" + product.slug + "/details";
                item_name_a.innerHTML = product.name;
                item_name.appendChild(item_name_a);

                var item_description = document.createElement("p");
                item_description.className = "card-text item-description";
                item_description.innerHTML = product.description;

                var card_body = document.createElement('div');
                card_body.appendChild(wrapper);
                card_body.appendChild(item_name);
                card_body.appendChild(item_description);
                card_body.className = "card-body";


                var item_price = document.createElement("H4");
                item_price.className = "item-price";
                item_price.innerHTML = "₱ " + product.price;

                var item_cost = document.createElement("div");
                item_cost.className = "item-cost";
                item_cost.appendChild(item_price);

                var item_wrapper = document.createElement("div");
                item_wrapper.className = "item-wrapper";
                item_wrapper.appendChild(item_cost);

                var wishlist_span = document.createElement("span");
                wishlist_span.innerHTML = "Wishlist";

                var wishlist_path = document.createElementNS("http://www.w3.org/2000/svg", "path");
                wishlist_path.setAttribute("d", "M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z");

                var wishlist_svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                wishlist_svg.setAttribute("viewBox", "0 0 24 24");
                wishlist_svg.setAttribute("width", "14");
                wishlist_svg.setAttribute("height", "14");
                wishlist_svg.setAttribute("fill", "none");
                wishlist_svg.setAttribute("stroke", "currentColor");
                wishlist_svg.setAttribute("stroke-width", "2");
                wishlist_svg.setAttribute("stroke-linecap", "round");
                wishlist_svg.setAttribute("stroke-linejoin", "round");
                wishlist_svg.setAttribute("class", "feather feather-heart");
                wishlist_svg.appendChild(wishlist_path);

                var wishlist_a = document.createElement("a");
                wishlist_a.href = "#wishlist";
                wishlist_a.className = "btn btn-light btn-wishlist waves-effect waves-float waves-light";
                wishlist_a.appendChild(wishlist_svg);
                wishlist_a.appendChild(wishlist_span);

                var select_span = document.createElement("span");
                select_span.innerHTML = "Select";
                select_span.className = "add-to-cart";

                var select_circle_1 = document.createElementNS("http://www.w3.org/2000/svg", "circle");
                select_circle_1.setAttribute("cx", "9");
                select_circle_1.setAttribute("cy", "21");
                select_circle_1.setAttribute("r", "1");

                var select_circle_2 = document.createElementNS("http://www.w3.org/2000/svg", "circle");
                select_circle_2.setAttribute("cx", "20");
                select_circle_2.setAttribute("cy", "21");
                select_circle_2.setAttribute("r", "1");

                var select_line = document.createElementNS("http://www.w3.org/2000/svg", "line");
                select_line.setAttribute("x1", "5");
                select_line.setAttribute("y1", "12");
                select_line.setAttribute("x2", "19");
                select_line.setAttribute("y2", "12");

                var select_polyline = document.createElementNS("http://www.w3.org/2000/svg", "polyline");
                select_polyline.setAttribute("points", "12 5 19 12 12 19");

                var select_path = document.createElementNS("http://www.w3.org/2000/svg", "path");
                select_path.setAttribute("d", "M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6");

                var select_svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                select_svg.setAttribute("xmlns", "http://www.w3.org/2000/svg");
                select_svg.setAttribute("width", "24");
                select_svg.setAttribute("height", "24");
                select_svg.setAttribute("viewBox", "0 0 24 24");
                select_svg.setAttribute("fill", "none");
                select_svg.setAttribute("stroke", "currentColor");
                select_svg.setAttribute("stroke-width", "2");
                select_svg.setAttribute("stroke-linecap", "round");
                select_svg.setAttribute("stroke-linejoin", "round");
                select_svg.setAttribute("class", "feather feather-arrow-right");
                //select_svg.appendChild(select_circle_1);
                //select_svg.appendChild(select_circle_2);
                //select_svg.appendChild(select_path);
                select_svg.appendChild(select_line);
                select_svg.appendChild(select_polyline);

                var select_a = document.createElement("a");
                select_a.href = "../../shop/" + product.slug+"/details";
                select_a.className = "btn btn-primary btn-cart waves-effect waves-float waves-light";
                select_a.appendChild(select_svg);
                select_a.appendChild(select_span);

                var item_options = document.createElement('div');
                item_options.className = "item-options text-center";
                item_options.appendChild(item_wrapper);
                //item_options.appendChild(wishlist_a);
                item_options.appendChild(select_a);


                var container = document.createElement('div');
                container.className = "card ecommerce-card";
                //container.appendChild(blockDiv);
                container.appendChild(blockA); //FIX: Image
                container.appendChild(card_body);
                container.appendChild(item_options);

                listDiv.appendChild(container);
            }

            $('#ecommerce-pagination').show();

        }
    })
}
