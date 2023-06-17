<?php

ob_start();

$page_title = "Test";
$page_header = "Homepage";

// For the meta
$page_description = "";
$page_keywords = "";
$page_keywords = "";

// For the CSS files
$page_content = "";
$page_vendor_css = ["vendors.min.css", "forms/spinner/jquery.bootstrap-touchspin.css", "extensions/swiper.min.css", "extensions/toastr.min.css"];
$page_theme_css = ["bootstrap.css", "bootstrap-extended.css", "colors.css", "components.css", "themes/dark-layout.css", "themes/bordered-layout.css", "themes/semi-dark-layout.css"];
$page_css = ["core/menu/menu-types/horizontal-menu.css", "pages/app-ecommerce-details.css", "plugins/forms/form-number-input.css", "plugins/extensions/ext-component-toastr.css"];

// For the JS files
$vendor_js = ["vendors.min.js"];
$page_vendor_js = ["ui/jquery.sticky.js", "forms/spinner/jquery.bootstrap-touchspin.js", "extensions/swiper.min.js", "extensions/toastr.min.js"];
$page_theme_js = ["core/app-menu.js", "core/app.js"];
$page_js = ["scripts/pages/app-ecommerce-details.js", "scripts/forms/form-number-input.js"];

echo 'Page:'.$page;
?>

<div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Apple Watch Series 5</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Products</a>
                                    </li>
                                    <li class="breadcrumb-item active">Apple Watch Series 5
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="app-todo.html"><i class="me-1" data-feather="alert-triangle"></i><span class="align-middle">Report Page</span></a>
                            </div>
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
                                        <img src="https://cf.shopee.ph/file/ede986c827449d7ed8f60c80ad062578" class="img-fluid product-img" alt="product image" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-7">
                                    <h4>Electronic Piggy Bank Simulated Face Recognition ATM Machine Cash Box Without Electric Auto Scroll Paper Banknote Kids</h4>
                                    <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                                        <h4 class="item-price me-1">$499.99</h4>
                                        <ul class="unstyled-list list-inline ps-1 border-start"><span class="text-warning">5.0</span>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                        </ul>
                                    </div>
                                    <p class="card-text">Available - <span class="text-success">In stock</span></p>
                                    <p class="card-text">
                                        GPS, Always-On Retina display, 30% larger screen, Swimproof, ECG app, Electrical and optical heart sensors,
                                        Built-in compass, Elevation, Emergency SOS, Fall Detection, S5 SiP with up to 2x faster 64-bit dual-core
                                        processor, watchOS 6 with Activity trends, cycle tracking, hearing health innovations, and the App Store on
                                        your wrist
                                    </p>
                                    <ul class="product-features list-unstyled">
                                        <li><i data-feather="shopping-cart"></i> <span>Free Shipping</span></li>
                                        <li>
                                            <i data-feather="dollar-sign"></i>
                                            <span>EMI options available</span>
                                        </li>
                                    </ul>
                                    <hr />
                                    <div class="product-color-options">
                                        <h6>Colors</h6>
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-inline-block selected">
                                                <div class="color-option b-primary">
                                                    <div class="filloption bg-primary"></div>
                                                </div>
                                            </li>
                                            <li class="d-inline-block">
                                                <div class="color-option b-success">
                                                    <div class="filloption bg-success"></div>
                                                </div>
                                            </li>
                                            <li class="d-inline-block">
                                                <div class="color-option b-danger">
                                                    <div class="filloption bg-danger"></div>
                                                </div>
                                            </li>
                                            <li class="d-inline-block">
                                                <div class="color-option b-warning">
                                                    <div class="filloption bg-warning"></div>
                                                </div>
                                            </li>
                                            <li class="d-inline-block">
                                                <div class="color-option b-info">
                                                    <div class="filloption bg-info"></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <hr />
                                    <div class="d-flex flex-column flex-sm-row pt-1">
                                        <a href="#" class="btn btn-primary btn-cart me-0 me-sm-1 mb-1 mb-sm-0">
                                            <i data-feather="shopping-cart" class="me-50"></i>
                                            <span class="add-to-cart">Buy in Shopee</span>
                                        </a>
                                        <div class="btn-group dropdown-icon-wrapper btn-share">
                                            <button type="button" class="btn btn-icon hide-arrow btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i data-feather="share-2"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#" class="dropdown-item">
                                                    <i data-feather="facebook"></i>
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i data-feather="twitter"></i>
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i data-feather="youtube"></i>
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i data-feather="instagram"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Product Details ends -->
                    </div>

                   
                    <!-- Product Statistics start -->
                        <div class="col-lg-12 col-12">
                                
                            <div class="card card-user-timeline bg-light-danger">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="list" class="user-timeline-title-icon"></i>
                                        <h4 class="card-title">Report Summary</h4>
                                    </div>
                                    <div class="dropdown chart-dropdown">
                                        <p class="text-secondary">7d ago</p>
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <div class="avatar avatar-xl bg-primary shadow bg-danger">
                                        <div class="avatar-content">
                                            <i data-feather="thumbs-down" class="font-large-1"></i>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <h1 class="mb-1 mt-2 text-white">Potentially Legit</h1>
                                        <p class="card-text m-auto w-75 text-light">
                                            We found nothing wrong with this product.
                                        </p>

                                        <p class="card-text m-auto w-75 mt-2 text-dark">
                                            <b>Here is how we get the result:</b>
                                        </p>

                                        
                                    </div>
                                </div>



                                </div>
                            </div>  
                        </div>
                    <!-- Product Statistics end -->

                    
                    <div class="row">
                        <div class="col-lg-8 col-12 order-2 order-lg-1">
                            <!-- Seller's Reputation start -->
                            <div class="card card-user-timeline">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="user-check" class="user-timeline-title-icon"></i>
                                        <h4 class="card-title">Seller's Reputation</h4>
                                    </div>
                                </div>
                                <div class="card-body card-transaction">
                                    <p>Check the seller's reputation and reviews. Look for sellers with a high rating and positive feedback from previous buyers.</p>
                                        
                                            <div class="transaction-item mt-2">
                                                <div class="d-flex">
                                                    <div class="avatar bg-light-primary rounded float-start">
                                                        <div class="avatar-content">
                                                            <i data-feather="star" class="avatar-icon font-medium-3"></i>
                                                        </div>
                                                    </div>
                                                    <div class="transaction-percentage">
                                                        <h6 class="transaction-title">Ratings</h6>
                                                        <small>Seller's performance</small>
                                                    </div>
                                                </div>
                                                <div class="fw-bolder">
                                                        <ul class="unstyled-list list-inline ps-1">
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="transaction-item">
                                                <div class="d-flex">
                                                    <div class="avatar bg-light-primary rounded float-start">
                                                        <div class="avatar-content">
                                                            <i data-feather="users" class="avatar-icon font-medium-3"></i>
                                                        </div>
                                                    </div>
                                                    <div class="transaction-percentage">
                                                        <h6 class="transaction-title">Followers</h6>
                                                        <small>Interested customers</small>
                                                    </div>
                                                </div>
                                                <div class="fw-bolder text-primary">4.9K</div>
                                            </div>
                                            <div class="transaction-item">
                                                <div class="d-flex">
                                                    <div class="avatar bg-light-primary rounded float-start">
                                                        <div class="avatar-content">
                                                            <i data-feather="activity" class="avatar-icon font-medium-3"></i>
                                                        </div>
                                                    </div>
                                                    <div class="transaction-percentage">
                                                        <h6 class="transaction-title">Engagement</h6>
                                                        <small>Seller's interaction</small>
                                                    </div>
                                                </div>
                                                <div class="fw-bolder text-danger">- 79% (2%)</div>
                                            </div>
                                 </div>
                            </div>  
                            <!-- Seller's Reputation end -->

                            <!-- Product Information start -->
                            <div class="card card-user-timeline">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="info" class="user-timeline-title-icon"></i>
                                        <h4 class="card-title">Product Information</h4>
                                    </div>
                                </div>
                                <div class="card-body card-transaction">
                                    <p>Check the product information carefully. Look for clear descriptions, specifications, and clear product images. Be wary of vague or incomplete product information.</p>
                                            <div class="transaction-item mt-2">
                                                <div class="d-flex">
                                                    <div class="avatar bg-light-primary rounded float-start">
                                                        <div class="avatar-content">
                                                            <i data-feather="star" class="avatar-icon font-medium-3"></i>
                                                        </div>
                                                    </div>
                                                    <div class="transaction-percentage">
                                                        <h6 class="transaction-title">Ratings</h6>
                                                        <small>Product's Feedback</small>
                                                    </div>
                                                </div>
                                                    <div class="fw-bolder">
                                                        <ul class="unstyled-list list-inline ps-1">
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                    </ul>
                                                    </div>
                                            </div>
                                            <div class="transaction-item">
                                                <div class="d-flex">
                                                    <div class="avatar bg-light-primary rounded float-start">
                                                        <div class="avatar-content">
                                                            <i data-feather="align-center" class="avatar-icon font-medium-3"></i>
                                                        </div>
                                                    </div>
                                                    <div class="transaction-percentage">
                                                        <h6 class="transaction-title">Thoroughness</h6>
                                                        <small>Detailed information</small>
                                                    </div>
                                                </div>
                                                <div class="fw-bolder text-success">90%</div>
                                            </div>
                                            <div class="transaction-item">
                                                <div class="d-flex">
                                                    <div class="avatar bg-light-primary rounded float-start">
                                                        <div class="avatar-content">
                                                            <i data-feather="pocket" class="avatar-icon font-medium-3"></i>
                                                        </div>
                                                    </div>
                                                    <div class="transaction-percentage">
                                                        <h6 class="transaction-title">Image Veracity</h6>
                                                        <small>Accurate product images</small>
                                                    </div>
                                                </div>
                                                <div class="fw-bolder text-success">90%</div>
                                            </div>
                                            
                                 </div>
                            </div>
                            <!-- Product Information end -->

                            <!-- Product Price start -->
                            <div class="card card-user-timeline">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="dollar-sign" class="user-timeline-title-icon"></i>
                                        <h4 class="card-title">Price</h4>
                                    </div>
                                </div>
                                <div class="card-body card-transaction">
                                    <p>If the price is too good to be true, it probably is. Compare the price of the product with similar products from other sellers to determine if it is reasonable.</p>
                                       
                                    <div class="table-responsive mt-2">
                                            <table class="table">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>Details</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <img src="../../../app-assets/images/icons/angular.svg" class="me-75" height="20" width="20" alt="Angular">
                                                            <span class="fw-bold">Similar Product</span>
                                                        </td>
                                                        <td>P 1,231.00</td>
                                                        <td>
                                                            <button type="button" class="btn btn-info waves-effect waves-float waves-light">View</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <img src="../../../app-assets/images/icons/angular.svg" class="me-75" height="20" width="20" alt="Angular">
                                                            <span class="fw-bold">Similar Product</span>
                                                        </td>
                                                        <td>P 1,231.00</td>
                                                        <td>
                                                            <button type="button" class="btn btn-info waves-effect waves-float waves-light">View</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                       </div>     
                                </div>
                            </div>
                            <!-- Product Price end -->

                            <!-- Product Payment & Shipping start -->
                            <div class="card card-user-timeline">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="shopping-bag" class="user-timeline-title-icon"></i>
                                        <h4 class="card-title">Payment & Shipping</h4>
                                    </div>
                                </div>
                                <div class="card-body card-transaction">
                                    <p>Be wary of sellers who only accept payment via untraceable methods such as bank transfer or cryptocurrencies. Check the shipping details and delivery timeframe to ensure they are reasonable and consistent with other sellers.</p>
                                     
                                </div>
                            </div>
                            <!-- Product Payment & Shipping end -->

                            <!-- Product Commenting start -->
                                <div class="card">
                                    <div class="card-body">
                                       <h5>Leave a comment</h5>
                                        <form action="javascript:void(0)" class="form mt-2">
                                            <div class="row">
                                                <div class="col-sm-6 col-12">
                                                    <div class="mb-2">
                                                        <input type="text" class="form-control" placeholder="Name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <div class="mb-2">
                                                        <input type="email" class="form-control" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <div class="mb-2">
                                                        <input type="url" class="form-control" placeholder="Website">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <textarea class="form-control mb-2" rows="4" placeholder="Comment"></textarea>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input" id="blogCheckbox">
                                                        <label class="form-check-label" for="blogCheckbox">Save my name, email, and website in this browser for the next time I comment.</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">Post Comment</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <!-- Product Commenting end -->
                            
                            <!-- Product Comments start -->
                                    <h6 class="section-label mt-25">Comment</h6>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-start">
                                                <div class="avatar me-75">
                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-9.jpg" width="38" height="38" alt="Avatar">
                                                </div>
                                                <div class="author-info">
                                                    <h6 class="fw-bolder mb-25">Chad Alexander</h6>
                                                    <p class="card-text">May 24, 2020</p>
                                                    <p class="card-text">
                                                        A variation on the question technique above, the multiple-choice question great way to engage your
                                                        reader.
                                                    </p>
                                                    <a href="#">
                                                        <div class="d-inline-flex align-items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-up-left font-medium-3 me-50"><polyline points="9 14 4 9 9 4"></polyline><path d="M20 20v-7a4 4 0 0 0-4-4H4"></path></svg>
                                                            <span>Reply</span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <!-- Product Comments end -->
                        </div>
                        
                        <!-- Sidebar Start -->
                            <div class="col-lg-4 col-12 order-2 order-lg-1">
                                <div class="card card-user-timeline">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <i data-feather="list" class="user-timeline-title-icon"></i>
                                            <h4 class="card-title">Product Timeline</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <ul class="timeline ms-50">
                                            <li class="timeline-item">
                                                <span class="timeline-point timeline-point-indicator"></span>
                                                <div class="timeline-event">
                                                    <h6>Unclaimed Product</h6>
                                                    <p>Waiting for Shopee seller to own this product.</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Ads Sidebar start -->
                                <div class="card card-user-timeline">
                                   <div class="card-header">
                                       <div class="d-flex align-items-center">
                                           <h4 class="card-title">Advertisement</h4>
                                       </div>
                                   </div>
                                   <div class="card-body">
                                       <p>Advertisement will be displayed here.</p>
                                   </div>
                                </div>
                                 <!-- Ads Sidebar end -->


                                <!-- Related Product start -->
                                <div class="card card-user-timeline">
                                   <div class="card-header">
                                       <div class="d-flex align-items-center">
                                           <h4 class="card-title">Other Products</h4>
                                       </div>
                                   </div>
                                   <div class="card-body">
                                       <div class="d-flex mb-2">
                                           <a href="page-blog-detail.html" class="me-2">
                                               <img class="rounded" src="../../../app-assets/images/banner/banner-22.jpg" width="100" height="70" alt="Recent Post Pic">
                                           </a>
                                           <div class="blog-info">
                                               <h6 class="blog-recent-post-title">
                                                   <a href="page-blog-detail.html" class="text-body-heading">Similar Products #1</a>
                                               </h6>
                                               <p>Description</p>
                                               <div class="text-muted mb-0">Jan 14 2020</div>
                                           </div>
                                       </div>

                                       <div class="d-flex mb-2">
                                           <a href="page-blog-detail.html" class="me-2">
                                               <img class="rounded" src="../../../app-assets/images/banner/banner-22.jpg" width="100" height="70" alt="Recent Post Pic">
                                           </a>
                                           <div class="blog-info">
                                               <h6 class="blog-recent-post-title">
                                                   <a href="page-blog-detail.html" class="text-body-heading">Similar Products #2</a>
                                               </h6>
                                               <p>Description</p>
                                               <div class="text-muted mb-0">Jan 14 2020</div>
                                           </div>
                                       </div>

                                       <div class="d-flex mb-2">
                                           <a href="page-blog-detail.html" class="me-2">
                                               <img class="rounded" src="../../../app-assets/images/banner/banner-22.jpg" width="100" height="70" alt="Recent Post Pic">
                                           </a>
                                           <div class="blog-info">
                                               <h6 class="blog-recent-post-title">
                                                   <a href="page-blog-detail.html" class="text-body-heading">Similar Products #3</a>
                                               </h6>
                                               <p>Description</p>
                                               <div class="text-muted mb-0">Jan 14 2020</div>
                                           </div>
                                       </div>

                                       <div class="d-flex mb-2">
                                           <a href="page-blog-detail.html" class="me-2">
                                               <img class="rounded" src="../../../app-assets/images/banner/banner-22.jpg" width="100" height="70" alt="Recent Post Pic">
                                           </a>
                                           <div class="blog-info">
                                               <h6 class="blog-recent-post-title">
                                                   <a href="page-blog-detail.html" class="text-body-heading">Similar Products #4</a>
                                               </h6>
                                               <p>Description</p>
                                               <div class="text-muted mb-0">Jan 14 2020</div>
                                           </div>
                                       </div>

                                       <div class="d-flex mb-2">
                                           <a href="page-blog-detail.html" class="me-2">
                                               <img class="rounded" src="../../../app-assets/images/banner/banner-22.jpg" width="100" height="70" alt="Recent Post Pic">
                                           </a>
                                           <div class="blog-info">
                                               <h6 class="blog-recent-post-title">
                                                   <a href="page-blog-detail.html" class="text-body-heading">Similar Products #5</a>
                                               </h6>
                                               <p>Description</p>
                                               <div class="text-muted mb-0">Jan 14 2020</div>
                                           </div>
                                       </div>

                                   </div>
                                </div>
                                 <!-- Related Product end -->


                                <!-- Product Comments start -->
                                <div class="d-flex align-items-center">
                                        <div class="avatar avatar-tag bg-light-success me-1">
                                            <i data-feather="star" class="font-medium-4"></i>
                                        </div>
                                        <div>
                                            <h4 class="mb-0">GainReviews</h4>
                                            <span>Things you need to know</span>
                                        </div>
                                    </div>

                                    <!-- frequent answer and question  collapse  -->
                                    <div class="accordion accordion-margin mt-2" id="faq-payment-qna">
                                        <div class="card accordion-item">
                                            <h2 class="accordion-header" id="paymentOne">
                                                <button class="accordion-button collapsed" data-bs-toggle="collapse" role="button" data-bs-target="#faq-payment-one" aria-expanded="false" aria-controls="faq-payment-one">
                                                    We are open to all
                                                </button>
                                            </h2>

                                            <div id="faq-payment-one" class="collapse accordion-collapse" aria-labelledby="paymentOne" data-bs-parent="#faq-payment-qna">
                                                <div class="accordion-body">
                                                    Pastry pudding cookie toffee bonbon jujubes jujubes powder topping. Jelly beans gummi bears sweet roll
                                                    bonbon muffin liquorice. Wafer lollipop sesame snaps. Brownie macaroon cookie muffin cupcake candy
                                                    caramels tiramisu. Oat cake chocolate cake sweet jelly-o brownie biscuit marzipan. Jujubes donut
                                                    marzipan chocolate bar. Jujubes sugar plum jelly beans tiramisu icing cheesecake.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card accordion-item">
                                            <h2 class="accordion-header" id="paymentTwo">
                                                <button class="accordion-button" data-bs-toggle="collapse" role="button" data-bs-target="#faq-payment-two" aria-expanded="true" aria-controls="faq-payment-two">
                                                    What is GainReview?
                                                </button>
                                            </h2>
                                            <div id="faq-payment-two" class="collapse" aria-labelledby="paymentTwo" data-bs-parent="#faq-payment-qna">
                                                <div class="accordion-body">
                                                    Sweet pie candy jelly. Sesame snaps biscuit sugar plum. Sweet roll topping fruitcake. Caramels
                                                    liquorice biscuit ice cream fruitcake cotton candy tart. Donut caramels gingerbread jelly-o
                                                    gingerbread pudding. Gummi bears pastry marshmallow candy canes pie. Pie apple pie carrot cake.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-grid col-lg-12 col-md-12 mt-2">
                                            <button type="button" class="btn btn-primary waves-effect waves-float waves-light">View More</button>
                                        </div>
                                    </div>
                                <!-- Product Comments start -->
                            </div>
                        <!-- Sidebar end -->
                    </div>
                    

                </section>
                <!-- app e-commerce details end -->

            </div>
        </div>
    </div>


<?php

$page_content = ob_get_clean();

include "./templates/main.php";

?>
