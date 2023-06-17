<div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Product Details</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../../">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="../../shop/1">Shop</a>
                                    </li>
                                    <li class="breadcrumb-item active"><?php echo $details->name; ?>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- app e-commerce details start -->
                <section class="app-ecommerce-details">
                    <div class="card">
                        <!-- Product Details starts -->
                        <div class="card-body">
                            <div class="row my-2">
                                <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="../../../app-assets/images/pages/eCommerce/<?php echo $details->img; ?>" class="img-fluid product-img" alt="product image" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-7">
                                    <h4><?php echo $details->name; ?></h4>
                                    <span class="card-text item-company">By <a href="../../profile/1" class="company-name">Owner</a></span>
                                    <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                                        <select class="form-control col-md-2 item-price" id="productSelect" required="">
                                            <option value="0">Select</option>
                                        <?php
                                           // var_dump($details);
                                            foreach($details->items as $value){
                                                echo '<option value="'.$value->id.'" data-price="'.$value->price.'" data-stock="'.$value->stock.'"';
                                                
                                                if($value->stock <= 0){
                                                    echo 'disabled';
                                                }

                                                echo '>'.$value->amount.'</option>';
                                            }
                                        ?>
                                                 
                                            </select>
                                        
                                    </div>
                                    <br>
                                    <p class="card-text">
                                    <?php
                                    if($details->status == 1){
                                        echo 'Available - <span class="text-success">In stock</span>';
                                    } else {
                                        echo 'Unavailable - <span class="text-danger">Out of Stock</span>';
                                    }
                                    ?>
                                    </p>
                                    <p class="card-text">
                                        <?php echo $details->description; ?>
                                    </p>
                                    <ul class="product-features list-unstyled">
                                        <?php

                                        if($details->fee == 0){
                                            echo '<li><i data-feather="shopping-cart"></i> <span>Free of Service</span></li>';
                                        } else {
                                            echo '<li><i data-feather="shopping-cart"></i> <span> Service Fee: <b class="item-price">'.stripslashes($_config['general']['currency_symbol']).' '.number_format($details->fee,2).'</b></span></li>';
                                        }

                                        ?>
                                        <li>
                                            <i data-feather="dollar-sign"></i>
                                            <span>EMI options available</span>
                                        </li>
                                    </ul>
                                    <hr />
                                    <div class="product-color-options hidden">
                                        <h6>Quantity</h6>
                                        <div class="input-group bootstrap-touchspin">
                                            <span class="input-group-btn input-group-prepend bootstrap-touchspin-injected"></span><input type="number" class="touchspin-min-max form-control" value="1" ><span class="input-group-btn input-group-append bootstrap-touchspin-injected"></span>
                                        </div>
                                        <?php
                                        ?>
                                        <input id="prodID" type="hidden" name="product_id" value="<?php echo $details->id; ?>">
                                        <input id="prodFee" type="hidden" name="product_fee" value="<?php echo $details->fee; ?>">
                                    </div>
                                    <hr id="lineBorder" class="hidden"/>
                                    <div class="product-color-options hidden">
                                        <h6>Price</h6>
                                        <h4 id="total_price" class="item-price mr-1"><?php echo stripslashes($_config['general']['currency_symbol']).' '.number_format(0,2); ?></h4>
                                    </div>
                                    <hr id="lineBorder" class="hidden"/>
                                    <div id="item-buttons" class="d-flex flex-column flex-sm-row pt-1 hidden">

                                        <?php if($details->status == 0) { 
                                        
                                        echo ' <a href="javascript:void(0)" class="btn btn-outline-secondary mr-0 mr-sm-1 mb-1 mb-sm-0">
                                            <i data-feather="shopping-cart" class="mr-50"></i>
                                            <span class="add-to-cart">Purchase</span>
                                        </a>'; 
                                        } else {
                                            echo ' <a href="javascript:void(0)" class="btn btn-primary btn-cart mr-0 mr-sm-1 mb-1 mb-sm-0">
                                            <i data-feather="shopping-cart" class="mr-50"></i>
                                            <span class="add-to-cart">Purchase</span>
                                        </a>'; 
                                        }
                                        
                                        if(isset($_SESSION['loggedIn']) && $_SESSION['user_type'] == 5) {
                                            echo '<a href="javascript:void(0)" class="btn btn-info btn-wishlist mr-0 mr-sm-1 mb-1 mb-sm-0">
                                                    <i data-feather="heart" class="mr-50"></i>
                                                    <span>Edit (admin)</span>
                                                 </a>';
                                        }

                                        ?>
                                        

                                        
                                        <div class="btn-group dropdown-icon-wrapper btn-share">
                                            <button type="button" class="btn btn-icon hide-arrow btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i data-feather="share-2"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:void(0)" class="dropdown-item">
                                                    <i data-feather="facebook"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="dropdown-item">
                                                    <i data-feather="twitter"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="dropdown-item">
                                                    <i data-feather="youtube"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="dropdown-item">
                                                    <i data-feather="instagram"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Product Details ends -->

                        <!-- Item features starts -->
                        <div class="item-features">
                            <div class="row text-center">
                                <div class="col-12 col-md-4 mb-4 mb-md-0">
                                    <div class="w-75 mx-auto">
                                        <i data-feather="award"></i>
                                        <h4 class="mt-2 mb-1">100% Original</h4>
                                        <p class="card-text">Chocolate bar candy canes ice cream toffee. Croissant pie cookie halvah.</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mb-4 mb-md-0">
                                    <div class="w-75 mx-auto">
                                        <i data-feather="clock"></i>
                                        <h4 class="mt-2 mb-1">10 Day Replacement</h4>
                                        <p class="card-text">Marshmallow biscuit donut dragée fruitcake. Jujubes wafer cupcake.</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mb-4 mb-md-0">
                                    <div class="w-75 mx-auto">
                                        <i data-feather="shield"></i>
                                        <h4 class="mt-2 mb-1">1 Year Warranty</h4>
                                        <p class="card-text">Cotton candy gingerbread cake I love sugar plum I love sweet croissant.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Item features ends -->

                        <!-- Related Products starts -->
                        <div class="card-body">
                            <div class="mt-4 mb-2 text-center">
                                <h4>Related Products</h4>
                                <p class="card-text">People also search for this items</p>
                            </div>
                            <div class="swiper-responsive-breakpoints swiper-container px-4 py-2">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <a href="javascript:void(0)">
                                            <div class="item-heading">
                                                <h5 class="text-truncate mb-0">Apple Watch Series 6</h5>
                                                <small class="text-body">by Apple</small>
                                            </div>
                                            <div class="img-container w-50 mx-auto py-75">
                                                <img src="../../../app-assets/images/elements/apple-watch.png" class="img-fluid" alt="image" />
                                            </div>
                                            <div class="item-meta">
                                                <ul class="unstyled-list list-inline mb-25">
                                                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                    <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                </ul>
                                                <p class="card-text text-primary mb-0">$399.98</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="javascript:void(0)">
                                            <div class="item-heading">
                                                <h5 class="text-truncate mb-0">Apple MacBook Pro - Silver</h5>
                                                <small class="text-body">by Apple</small>
                                            </div>
                                            <div class="img-container w-50 mx-auto py-50">
                                                <img src="../../../app-assets/images/elements/macbook-pro.png" class="img-fluid" alt="image" />
                                            </div>
                                            <div class="item-meta">
                                                <ul class="unstyled-list list-inline mb-25">
                                                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                    <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                    <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                    <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                </ul>
                                                <p class="card-text text-primary mb-0">$2449.49</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="javascript:void(0)">
                                            <div class="item-heading">
                                                <h5 class="text-truncate mb-0">Apple HomePod (Space Grey)</h5>
                                                <small class="text-body">by Apple</small>
                                            </div>
                                            <div class="img-container w-50 mx-auto py-75">
                                                <img src="../../../app-assets/images/elements/homepod.png" class="img-fluid" alt="image" />
                                            </div>
                                            <div class="item-meta">
                                                <ul class="unstyled-list list-inline mb-25">
                                                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                    <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                    <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                </ul>
                                                <p class="card-text text-primary mb-0">$229.29</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="javascript:void(0)">
                                            <div class="item-heading">
                                                <h5 class="text-truncate mb-0">Magic Mouse 2 - Black</h5>
                                                <small class="text-body">by Apple</small>
                                            </div>
                                            <div class="img-container w-50 mx-auto py-75">
                                                <img src="../../../app-assets/images/elements/magic-mouse.png" class="img-fluid" alt="image" />
                                            </div>
                                            <div class="item-meta">
                                                <ul class="unstyled-list list-inline mb-25">
                                                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                </ul>
                                                <p class="card-text text-primary mb-0">$90.98</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="javascript:void(0)">
                                            <div class="item-heading">
                                                <h5 class="text-truncate mb-0">iPhone 12 Pro</h5>
                                                <small class="text-body">by Apple</small>
                                            </div>
                                            <div class="img-container w-50 mx-auto py-75">
                                                <img src="../../../app-assets/images/elements/iphone-x.png" class="img-fluid" alt="image" />
                                            </div>
                                            <div class="item-meta">
                                                <ul class="unstyled-list list-inline mb-25">
                                                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                    <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                </ul>
                                                <p class="card-text text-primary mb-0">$1559.99</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- Add Arrows -->
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                        <!-- Related Products ends -->
                    </div>
                </section>
                <!-- app e-commerce details end -->

            </div>
        </div>
    </div>