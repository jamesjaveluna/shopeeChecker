<div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Shop</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../../">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Shop
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
            <div class="content-detached content-right">
                <div class="content-body">
                    <!-- E-commerce Content Section Starts -->
                    <section id="ecommerce-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="ecommerce-header-items">
                                    <div class="result-toggler">
                                        <button class="navbar-toggler shop-sidebar-toggler" type="button" data-toggle="collapse">
                                            <span class="navbar-toggler-icon d-block d-lg-none"><i data-feather="menu"></i></span>
                                        </button>
                                        <div class="search-results" style="display: none;"></div>
                                    </div>
                                    <div class="view-options d-flex">
                                        <div class="btn-group dropdown-sort">
                                            <button type="button" class="btn btn-outline-primary dropdown-toggle mr-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="active-sorting">Featured</span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);">Featured</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Lowest</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Highest</a>
                                            </div>
                                        </div>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-icon btn-outline-primary view-btn grid-view-btn">
                                                <input type="radio" name="radio_options" id="radio_option1" checked />
                                                <i data-feather="grid" class="font-medium-3"></i>
                                            </label>
                                            <label class="btn btn-icon btn-outline-primary view-btn list-view-btn">
                                                <input type="radio" name="radio_options" id="radio_option2" />
                                                <i data-feather="list" class="font-medium-3"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- E-commerce Content Section Starts -->

                    <!-- background Overlay when sidebar is shown  starts-->
                    <div class="body-content-overlay"></div>
                    <!-- background Overlay when sidebar is shown  ends-->

                    <!-- E-commerce Search Bar Starts -->
                    <section id="ecommerce-searchbar" class="ecommerce-searchbar">
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <input type="hidden" id="page-id" value="<?php echo $page; ?>" />
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control search-product" id="shop-search" placeholder="Search Product" aria-label="Search..." aria-describedby="shop-search" />
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- E-commerce Search Bar Ends -->

                    <!-- E-commerce Products Starts -->
                    <section id="ecommerce-products" class="grid-view">
                       
                        <?php
                        /*//Check if users are changing the pages

                        if($page <= 0 || $page > $number_of_page){
                        echo '<div class="col-12 col-md-4 mb-4 mb-md-0"></div>';

                            echo '<center><lottie-player src="http://localhost:8090/app-assets/animation/not_found.json" mode="bounce" background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>';
                            echo '<br><h2>No results</h2></center>';
                             echo '<div class="col-12 col-md-4 mb-4 mb-md-0"></div>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';
                             echo '<br>';

                        } else {
                            $shop->get_products($num_results_on_page, $page);
                        }
                            */
                        ?>

                       
                    </section>
                    <!-- E-commerce Products Ends -->

                    <!-- E-commerce Pagination Starts -->
                    <?php
                        //Check if users are changing the page

                        if($page <= 0){} 
                        else {
                            echo '<section id="ecommerce-pagination" style="display: none;">
                        <div class="row">
                            <div class="col-sm-12">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center mt-2">';
                                   
                                          echo '<li class="page-item prev-item"><a class="page-link" href="';
                                                
                                                 if($page-1 > 0){
                                                    echo $page-1;
                                                } else {
                                                    echo '1#';
                                                }
                                                
                                          echo '"></a></li>';
                                          
                                          ?>
                                          
                                        <?php  for($pages = 1; $pages<= $number_of_page; $pages++) {  
                                                echo '<li class="page-item';
                                                
                                                if($page == $pages){
                                                    echo ' active';
                                                }
                                                
                                                echo '"><a class="page-link" href="'.$pages.'">'.$pages.'</a></li>';
                                          }  

                                          echo '<li class="page-item next-item"><a class="page-link" href="';
                                                if($page+1 > $number_of_page){
                                                    echo $number_of_page;
                                                } else {
                                                    echo $page+1;
                                                }
                                                
                                          echo '"></a></li>';
                                          
                                    echo '
                                     </ul>
                                </nav>
                            </div>
                        </div>
                    </section>';
                        }

                    ?>
                    <!-- E-commerce Pagination Ends -->

                </div>
            </div>
            <div class="sidebar-detached sidebar-left">
                <div class="sidebar">
                    <!-- Ecommerce Sidebar Starts -->
                    <div class="sidebar-shop">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6 class="filter-heading d-none d-lg-block">Filters</h6>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <!-- Price Slider starts -->
                                <div class="price-slider">
                                    <h6 class="filter-title">Filter by Price</h6>
                                    <div class="price-slider">
                                        <div class="range-slider mt-2" id="price-slider"></div>
                                    </div>
                                </div>
                                <!-- Price Range ends -->

                                <!-- Categories Starts -->
                                <div id="product-categories">
                                    <h6 class="filter-title">Categories</h6>
                                    <ul class="list-unstyled categories-list">
                                        <li>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="category1" name="category-filter" class="custom-control-input" checked/>
                                                <label class="custom-control-label" for="category1">All</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Categories Ends -->

                                <!-- Brands starts -->
                                <div class="brands">
                                    <h6 class="filter-title">Brands</h6>
                                    <ul class="list-unstyled brand-list">
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="productBrand1" />
                                                <label class="custom-control-label" for="productBrand1">Game Points</label>
                                            </div>
                                            <span>746</span>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="productBrand2" checked />
                                                <label class="custom-control-label" for="productBrand2">Money</label>
                                            </div>
                                            <span>633</span>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="productBrand3" />
                                                <label class="custom-control-label" for="productBrand3">Lifestyle</label>
                                            </div>
                                            <span>591</span>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Brand ends -->


                                <!-- Clear Filters Starts -->
                                <div id="clear-filters">
                                    <button type="button" class="btn btn-block btn-primary">Clear All Filters</button>
                                </div>
                                <!-- Clear Filters Ends -->
                            </div>
                        </div>
                    </div>
                    <!-- Ecommerce Sidebar Ends -->

                </div>
            </div>
        </div>
    </div>