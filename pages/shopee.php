<?php
// Load configuration data and reusable code
require_once __DIR__ . '../../includes/config.php';
require_once __DIR__ . '../../includes/functions.php';

ob_start();

$slug = isset($_GET['slug']) ? $_GET['slug'] : null;


// Check if slug is empty
if($slug == null || json_decode(getData($slug))->status == false ){
    http_response_code(404);
	include($_SERVER['DOCUMENT_ROOT'].'/pages/404.php');
	die();
}

// Fetch review data
$review = json_decode(getData($slug));
$product_raw = json_decode(getProductData($review->itemID));
$seller_raw = json_decode(getSellerData($review->shopID));
$ratings_raw = json_decode(getRatingsData($review->ratingsID));


// Debugging code to log the requested URL
if($product_raw->status == false || $seller_raw->status == false || $ratings_raw->status == false)
error_log("Failed to request some of the data: ". $review->id);

// Real Data
$product = $product_raw->data;
$seller = $seller_raw->data;
$ratings = $ratings_raw->data;

// Implementation of Other Products
//$other_products = json_decode(getSiblingProducts($seller->shopid))->items;

// Fetch good, bad, normal
$sellerRate = json_decode(getSellerRate($seller->rating_good, $seller->rating_bad, $seller->rating_normal));

// Fetch result
$result = json_decode(computeResult($seller_raw, $product_raw, $ratings_raw, $review));

// Fetch Rationale
$displayIds = array(1, 2, 3, 4, 5);
$rationale = json_decode(getRationale($displayIds), true);

$page_title = SITE_NAME." - ".$product_raw->name;
$page_header = "Homepage";

// For the meta
$page_description = "";
$page_keywords = "";
$page_keywords = "";

// For the CSS files
$page_content = "";
$page_vendor_css = ["extensions/jquery.rateyo.min.css", "charts/apexcharts.css","vendors.min.css", "forms/spinner/jquery.bootstrap-touchspin.css", "extensions/swiper.min.css", "extensions/toastr.min.css"];
$page_theme_css = ["bootstrap.css", "bootstrap-extended.css", "colors.css", "components.css", "themes/dark-layout.css", "themes/bordered-layout.css", "themes/semi-dark-layout.css"];
$page_css = ["plugins/extensions/ext-component-swiper.css", "plugins/charts/chart-apex.css", "core/menu/menu-types/horizontal-menu.css", "pages/app-ecommerce-details.css", "plugins/forms/form-number-input.css", "plugins/extensions/ext-component-toastr.css"];

// For the JS files
$vendor_js = ["vendors.min.js"];
$page_vendor_js = ["extensions/swiper-bundle.min.js", "extensions/jquery.rateyo.min.js", "charts/apexcharts.min.js", "ui/jquery.sticky.js", "forms/spinner/jquery.bootstrap-touchspin.js", "extensions/toastr.min.js"];
$page_theme_js = ["core/app-menu.js", "core/app.js"];
$page_js = ["scripts/main.js", "scripts/forms/form-number-input.js"];
//"scripts/pages/dashboard-ecommerce.js"
?>

<div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Product Analysis</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Shopee</a>
                                    </li>
                                    <li class="breadcrumb-item active"><?php echo substr($product->name, 0, 110).'...'; ?>
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
            <!-- main start -->
                <div class="row">
                    <div class="col-12 col-md-2 d-flex align-items-center justify-content-center mb-2 mb-md-0 ">
                    <div class="profile-title">
                        <div class="d-flex align-items-center justify-content-center">
                            <div id="result-chart" data-value="<?php echo $result->value; ?>" data-excess="<?php echo $result->excess; ?>"></div>
                        </div>
                        

                        
                        <div class="mt-2 progress">
                                    <div class="progress-bar bg-light-danger" role="progressbar" style="width: 50%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">
                                        50%
                                    </div>
                                    <div class="progress-bar bg-light-success" role="progressbar" style="width: 50%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                        50%
                                    </div>
                                    
                        </div>
                    </div>
                    </div>
                    <div class="col-12 col-md-10">
                        <!-- Analysis Content start -->
                            <div id="summary-report" class="card card-user-timeline bg-light-<?php echo $result->data->color; ?>">
                                <div class="card-header">
                                    <div class="d-flex align-items-center text-<?php echo $result->data->color; ?>">
                                        <i data-feather="<?php echo $result->data->icon; ?>" class="user-timeline-title-icon"></i>
                                        <h4 class="card-title text-<?php echo $result->data->color; ?>"><?php echo $result->data->text; ?></h4>
                                    </div>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li>
                                                <!-- URL: https://www.virustotal.com/gui/file/b56c905c0df19536e2ab0e6ca89fafda784820d253017c458822e3663d94dab8/detection/f-b56c905c0df19536e2ab0e6ca89fafda784820d253017c458822e3663d94dab8-1419811247 -->
                                                <a data-action="reload"><i data-feather="rotate-cw"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-9 mb-1">
                                            <p class="card-text m-auto text-light">
                                                <?php echo $result->data->desc; ?>
                                            </p>

                                            
                                        </div>
                                        <div class="col-xl-3 border-start mb-1">
                                            <p class="card-text m-auto text-light">
                                                <?php echo $review->createdDate.' UTC'; ?>
                                            </p>
                                            <p class="card-text m-auto text-dark">
                                                <?php echo format_time_ago(strtotime($review->createdDate)); ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-9 mb-1 mt-1">
                                            <div class="list-group-horizontal">
                                                <span class="badge rounded-pill badge-light-secondary">Debug: <?php echo $result->debug; ?> (total)</span>
                                                <span class="badge rounded-pill badge-light-secondary">Tags</span>
                                                <span class="badge rounded-pill badge-light-secondary">Tags</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 d-flex flex-column flex-sm-row pt-1">
                                            <a onclick="window.open('<?php echo $result->url; ?>', '_blank');" class="btn btn-primary btn-cart me-0 me-sm-1 mb-1 mb-sm-0">
                                                <i data-feather="shopping-cart" class="me-50"></i>
                                                <span class="add-to-cart">Buy on Shopee</span>
                                            </a>
                                            <div class="btn-group dropdown-icon-wrapper btn-share">
                                                <button type="button" class="btn btn-icon hide-arrow btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i data-feather="share-2"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="#" class="dropdown-item">
                                                        <i data-feather="facebook"></i><span class="ms-50">Facebook</span>
                                                    </a>
                                                    <a href="#" class="dropdown-item">
                                                        <i data-feather="twitter"></i><span class="ms-50"> Twitter</span>
                                                    </a>
                                                    <a href="#" class="dropdown-item">
                                                        <i data-feather="youtube"></i><span class="ms-50"> Youtube</span>
                                                    </a>
                                                    <a href="#" class="dropdown-item">
                                                        <i data-feather="instagram"></i><span class="ms-50"> Instagram</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        <!-- Analysis Content end -->

                     </div>
                </div>
            <!-- main end -->    

            <!-- menu start -->
            <div class="col-xl-12">
                        <ul class="nav nav-tabs my-1 list-group list-group-horizontal-lg" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link fw-bolder active list-group-item mt-50" id="legitimacy-tab" data-bs-toggle="tab" href="#legitimacyTab" aria-controls="Legitimacy Check" role="tab" aria-selected="true"><i data-feather="check"></i> Summary</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bolder list-group-item mt-50" id="product-tab" data-bs-toggle="tab" href="#productTab" aria-controls="Product Details" role="tab" aria-selected="false"><i data-feather="shopping-bag"></i> Product Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bolder list-group-item mt-50" id="seller-tab" data-bs-toggle="tab" href="#sellerTab" aria-controls="Seller Information" role="tab" aria-selected="false"><i data-feather="archive"></i> Seller Information
                                   <!-- <span class="badge badge-light-danger rounded-pill ms-75 me-2">2</span> -->
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bolder list-group-item mt-50" id="price-tab" data-bs-toggle="tab" href="#priceTab" aria-controls="Price & Discounts" role="tab" aria-selected="false"><i data-feather="dollar-sign"></i> Price & Discounts
                                     <!--<div class="spinner-border  spinner-border-sm text-primary ms-75" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                     </div>-->
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bolder list-group-item mt-50" id="community-tab" data-bs-toggle="tab" href="#communityTab" aria-controls="Community" role="tab" aria-selected="false"><i data-feather="users"></i> Community
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bolder list-group-item mt-50" id="community-tab" data-bs-toggle="tab" href="#communityTab" aria-controls="Community" role="tab" aria-selected="false"><i data-feather="users"></i> History
                                </a>
                            </li>
                        </ul>    
            </div>
            <!-- menu end -->

            <!-- Tab Content -->
            <div class="row">

                <!-- Main -->
                <div class="col-lg-8 col-12 order-2 order-lg-1">
                    <div class="tab-content">
                    
                        <!-- Legitimacy start -->
                        <section class="tab-pane active" id="legitimacyTab" aria-labelledby="legitimacy-tab" role="tabpanel">
                             <div class="card card card-transaction">
                                        <div class="card-body row">
                                           <!-- First Column Card -->
                                           <div class="col-lg-6 col-md-6 col-12">
                                              <div class="transaction-item">
                                                 <div class="d-flex">
                                                    <div class="transaction-percentage">
                                                       <h5 class="transaction-title mt-75" data-bs-toggle="tooltip" data-bs-placement="right" title="Rate it receives from Shopee Users">Shopee Score</h5>
                                                    </div>
                                                 </div>
                                                 <div class="d-flex align-items-center">
                                                    <span data-bs-toggle="tooltip" data-bs-placement="right" title="<?php echo round($product->item_rating->rating_star, 1).'/5'; ?>"><?php echo identify_score(round($product->item_rating->rating_star, 1)); ?></span>
                                                 </div>
                                              </div>
                                              <div class="transaction-item">
                                                 <div class="d-flex">
                                                    <div class="transaction-percentage">
                                                       <h5 class="transaction-title mt-75" data-bs-toggle="tooltip" data-bs-placement="right" title="Rate it receives from Shopee Users">Community Score</h5>
                                                    </div>
                                                 </div>
                                                 <div class="d-flex align-items-center">
                                                    <span><?php echo identify_score(null); ?></span>
                                                 </div>
                                              </div>
                                              <div class="transaction-item">
                                                 <div class="d-flex">
                                                    <div class="transaction-percentage">
                                                       <h5 class="transaction-title mt-75" data-bs-toggle="tooltip" data-bs-placement="right" title="Rate it receives from Shopee Users">Shopee Verified</h5>
                                                    </div>
                                                 </div>
                                                 <div class="d-flex align-items-center">
                                                    <?php display_data_yes_or_no($product->shopee_verified); ?>
                                                 </div>
                                              </div>
                                              <div class="transaction-item">
                                                 <div class="d-flex">
                                                    <div class="transaction-percentage">
                                                       <h5 class="transaction-title mt-75" data-bs-toggle="tooltip" data-bs-placement="right" title="Rate it receives from Shopee Users">Shopee Mall</h5>
                                                    </div>
                                                 </div>
                                                 <div class="d-flex align-items-center">
                                                    <?php display_data_yes_or_no($product->is_official_shop); ?>
                                                 </div>
                                              </div>
                                              <!-- Under Shoppee Mall -->
                                              <div class="transaction-item ms-50">
                                                 <div class="d-flex">
                                                    <div class="transaction-percentage">
                                                       <h5 class="transaction-title mt-75" data-bs-toggle="tooltip" data-bs-placement="right" title="Rate it receives from Shopee Users"><i class="me-25" data-feather="corner-down-right" class="font-medium-2"></i> Business Permit</h5>
                                                    </div>
                                                 </div>
                                                 <div class="d-flex align-items-center">
                                                    <?php display_data_yes_or_no($product->is_official_shop); ?>
                                                 </div>
                                              </div>
                                              <div class="transaction-item ms-50">
                                                 <div class="d-flex">
                                                    <div class="transaction-percentage">
                                                       <h5 class="transaction-title mt-75" data-bs-toggle="tooltip" data-bs-placement="right" title="Rate it receives from Shopee Users"><i class="me-25" data-feather="corner-down-right" class="font-medium-2"></i> BIR Form 2303</h5>
                                                    </div>
                                                 </div>
                                                 <div class="d-flex align-items-center">
                                                    <?php display_data_yes_or_no($product->is_official_shop); ?>
                                                 </div>
                                              </div>
                                              <div class="transaction-item ms-50">
                                                 <div class="d-flex">
                                                    <div class="transaction-percentage">
                                                       <h5 class="transaction-title mt-75" data-bs-toggle="tooltip" data-bs-placement="right" title="Rate it receives from Shopee Users"><i class="me-25" data-feather="corner-down-right" class="font-medium-2"></i> Brand Certification</h5>
                                                    </div>
                                                 </div>
                                                 <div class="d-flex align-items-center">
                                                    <?php display_data_yes_or_no($product->is_official_shop); ?>
                                                 </div>
                                              </div>
                                              <!-- Under Shoppee Mall-->
                                              <div class="transaction-item mb-1">
                                                 <div class="d-flex">
                                                    <div class="transaction-percentage">
                                                       <h5 class="transaction-title mt-75" data-bs-toggle="tooltip" data-bs-placement="right" title="Rate it receives from Shopee Users">Lower Price Guarantee</h5>
                                                    </div>
                                                 </div>
                                                 <div class="d-flex align-items-center">
                                                    <?php display_data_yes_or_no($product->has_lowest_price_guarantee); ?>
                                                 </div>
                                              </div>
                                           </div>
                                           <!--/ First Column Card -->
                                           <!-- Second Column Card -->
                                           <div class="col-lg-6 col-md-6 col-12">
                                              <div class="transaction-item">
                                                 <div class="d-flex">
                                                    <div class="transaction-percentage">
                                                       <h5 class="transaction-title mt-75" data-bs-toggle="tooltip" data-bs-placement="right" title="Rate it receives from Shopee Users">Sold</h5>
                                                    </div>
                                                 </div>
                                                 <div class="d-flex align-items-center">
                                                    <span class="text-secondary"><?php echo number_format(($product->sold + $product->historical_sold), 0, '', ',').' Products'; ?></span>
                                                 </div>
                                              </div>
                                              <div class="transaction-item">
                                                 <div class="d-flex">
                                                    <div class="transaction-percentage">
                                                       <h5 class="transaction-title mt-75" data-bs-toggle="tooltip" data-bs-placement="right" title="Rate it receives from Shopee Users">Preferred Seller</h5>
                                                    </div>
                                                 </div>
                                                 <div class="d-flex align-items-center">
                                                    <?php display_data_yes_or_no($seller->is_preferred_plus_seller); ?>
                                                 </div>
                                              </div>
                                              <!-- Preferred Seller -->
                                              <div class="transaction-item ms-25">
                                                 <div class="d-flex">
                                                    <div class="transaction-percentage">
                                                       <h5 class="transaction-title mt-75" data-bs-toggle="tooltip" data-bs-placement="right" title="Rate it receives from Shopee Users"><i class="me-25" data-feather="corner-down-right" class="font-medium-2"></i> Engagement</h5>
                                                    </div>
                                                 </div>
                                                 <div class="d-flex align-items-center">
                                                    <?php echo identify_passing_status($seller->response_rate); ?>
                                                 </div>
                                              </div>
                                              <div class="transaction-item ms-50">
                                                 <div class="d-flex">
                                                    <div class="transaction-percentage">
                                                       <h5 class="transaction-title mt-75" data-bs-toggle="tooltip" data-bs-placement="right" title="Rate it receives from Shopee Users"><i class="me-25" data-feather="corner-down-right" class="font-medium-2"></i> Response Time</h5>
                                                    </div>
                                                 </div>
                                                 <div class="d-flex align-items-center">
                                                    <?php 
                                                    echo getResponseTime($seller->response_time); ?>
                                                 </div>
                                              </div>
                                              <!--/ Preferred Seller -->
                                              <div class="transaction-item">
                                                 <div class="d-flex">
                                                    <div class="transaction-percentage">
                                                       <h5 class="transaction-title mt-75" data-bs-toggle="tooltip" data-bs-placement="right" title="Rate it receives from Shopee Users">Ratings</h5>
                                                    </div>
                                                 </div>
                                                 <div class="d-flex align-items-center">
                                                    <span><?php echo identify_ratings($seller->rating_good, $seller->rating_normal, $seller->rating_bad); ?></span>
                                                 </div>
                                              </div>
                                              <!-- Ratings -->
                                              <div class="transaction-item ms-25">
                                                 <div class="d-flex">
                                                    <div class="transaction-percentage">
                                                       <h5 class="transaction-title mt-75" data-bs-toggle="tooltip" data-bs-placement="right" title="Rate it receives from Shopee Users"><i class="me-25" data-feather="corner-down-right" class="font-medium-2"></i> Good</h5>
                                                    </div>
                                                 </div>
                                                 <div class="d-flex align-items-center">
                                                    <span class="text-secondary"><?php echo number_format($seller->rating_good, 0, '', ',').' Ratings'; ?></span>
                                                 </div>
                                              </div>
                                              <div class="transaction-item ms-50">
                                                 <div class="d-flex">
                                                    <div class="transaction-percentage">
                                                       <h5 class="transaction-title mt-75" data-bs-toggle="tooltip" data-bs-placement="right" title="Rate it receives from Shopee Users"><i class="me-25" data-feather="corner-down-right" class="font-medium-2"></i> Normal</h5>
                                                    </div>
                                                 </div>
                                                 <div class="d-flex align-items-center">
                                                    <span class="text-secondary"><?php echo number_format($seller->rating_normal, 0, '', ',').' Ratings'; ?></span>
                                                 </div>
                                              </div>
                                              <div class="transaction-item ms-50">
                                                 <div class="d-flex">
                                                    <div class="transaction-percentage">
                                                       <h5 class="transaction-title mt-75" data-bs-toggle="tooltip" data-bs-placement="right" title="Rate it receives from Shopee Users"><i class="me-25" data-feather="corner-down-right" class="font-medium-2"></i> Bad</h5>
                                                    </div>
                                                 </div>
                                                 <div class="d-flex align-items-center">
                                                    <span class="text-secondary"><?php echo number_format($seller->rating_bad, 0, '', ',').' Ratings'; ?></span>
                                                 </div>
                                              </div>
                                              <!--/ Ratings -->
                                           </div>
                                           <!--/ Second Column Card -->
                                        </div>
                             </div>
                        </section>
                        <!--/ Legitimacy -->

                        <!-- Product start -->
                          <section class="tab-pane" id="productTab" aria-labelledby="product-tab" role="tabpanel">
                           
                             <div class="app-ecommerce-details card">
                                 <div class="card-body">
                                     <div class="col-12 col-md-12 align-items-center justify-content-center mb-2 mb-md-0">
                                         <h4><?php echo $product->name; ?></h4>
                                         <span class="card-text item-company">By <a id="seller-tab" data-bs-toggle="tab" href="#sellerTab" aria-controls="Seller Name" role="tab" aria-selected="false" class="company-name"><?php echo $seller->name; ?></a></span>
                                     </div>
                                     <div class="row my-2">
                                         <div class="col-12 col-md-5 mb-2 mb-md-0">
                                            <div class="swiper-autoplay swiper-container">
                                                <div class="swiper-wrapper">
                                                    <?php 
                                                    
                                                    foreach ($product->images as $image) {
                                                      echo '<div class="swiper-slide">';
                                                      echo '<img class="img-fluid" src="https://cf.shopee.ph/file/'.$image.'" alt="banner" />';
                                                      echo '</div>';
                                                    }
                                                    
                                                    ?>
                                                </div>
                                                <!-- Add Pagination -->
                                                <div class="swiper-pagination"></div>
                                                <!-- Add Arrows -->
                                                <div class="swiper-button-next"></div>
                                                <div class="swiper-button-prev"></div>
                                            </div>


                                             <div class="d-flex align-items-center justify-content-center">
                                                 <!--<img src="https://cf.shopee.ph/file/<?php echo $product->image; ?>" class="img-fluid product-img" alt="product image" />-->
                                             </div>
                                         </div>
                                         <div class="col-12 col-md-7">
                                             <!-- Product Quick Details Start -->
                                             <div class="card card-transaction">
                                                 <div class="transaction-item">
                                                     <div class="d-flex">
                                                         <div class="avatar bg-light-info rounded float-start">
                                                         </div>
                                                         <div class="transaction-percentage">
                                                             <h5 class="transaction-title mt-75" data-bs-toggle="tooltip" data-bs-placement="right" title="Rate it receives from Shopee Users">Price</h5>
                                                         </div>
                                                     </div>
                                                     <div class="d-flex align-items-center">
                                                         <h4 class="item-price me-1">&#x20B1;<?php echo number_format($product->price_min/100000, 2).' - &#x20B1;'.number_format($product->price_max/100000, 2); ?></h4>
                                                     </div>
                                                 </div>
                                                 <div class="transaction-item">
                                                     <div class="d-flex">
                                                         <div class="avatar bg-light-info rounded float-start">
                                                         </div>
                                                         <div class="transaction-percentage">
                                                             <h5 class="transaction-title mt-75" data-bs-toggle="tooltip" data-bs-placement="right" title="Rate it receives from Shopee Users">Before Price</h5>
                                                         </div>
                                                     </div>
                                                     <div class="d-flex align-items-center">
                                                         <h4 class="item-price me-1">&#x20B1;<?php echo number_format($product->price_min/100000, 2).' - &#x20B1;'.number_format($product->price_max/100000, 2); ?></h4>
                                                     </div>
                                                 </div>
                                                 <div class="transaction-item">
                                                     <div class="d-flex">
                                                         <div class="avatar bg-light-info rounded float-start">
                                                             
                                                         </div>
                                                         <div class="transaction-percentage">
                                                             <h5 class="transaction-title mt-75" data-bs-toggle="tooltip" data-bs-placement="right" title="Rate it receives from Shopee Users">Shopee Score</h5>
                                                         </div>
                                                     </div>
                                                     <div class="d-flex align-items-center">
                                                         <div id="shopee-star" class="read-only-ratings" data-rateyo-read-only="true" data-rating="<?php echo round($product->item_rating->rating_star, 1); ?>" data-bs-toggle="tooltip" data-bs-placement="right" title="<?php echo round($product->item_rating->rating_star, 1); ?>/5"></div>
                                                     </div>
                                                 </div>
                                             </div>
                                             <!-- Product Quick Details End -->

                                             
                                             <hr />
                                             <!-- Product Quick Details Start -->
                                             <div class="card card-transaction mt-2">
                                                <div class="transaction-item">
                                                     <div class="d-flex">
                                                         <div class="avatar bg-light-danger rounded float-start">
                                                         </div>
                                                         <div class="transaction-percentage">
                                                             <h5 class="transaction-title mt-75">Favorite</h5>
                                                         </div>
                                                     </div>
                                                     <div class="d-flex align-items-center">
                                                             <?php
                                                                 echo number_format(($product->liked_count), 0, '', ',');
                                                             ?>
                                                     </div>
                                                 </div>

                                                 <div class="transaction-item">
                                                     <div class="d-flex">
                                                         <div class="avatar bg-light-danger rounded float-start">
                                                         </div>
                                                         <div class="transaction-percentage">
                                                             <h5 class="transaction-title mt-75">Total Sold</h5>
                                                         </div>
                                                     </div>
                                                     <div class="d-flex align-items-center">
                                                             <?php
                                                                 echo number_format(($product->sold + $product->historical_sold), 0, '', ',').' Products';
                                                             ?>
                                                     </div>
                                                 </div>

                                                 <div class="transaction-item">
                                                     <div class="d-flex">
                                                         <div class="avatar bg-light-success rounded float-start">
                                                             <!--<div class="avatar-content">
                                                                  <i data-feather="trending-up" class="avatar-icon font-medium-3"></i>
                                                             </div>-->
                                                         </div>
                                                         <div class="transaction-percentage">
                                                             <h5 class="transaction-title mt-75">Discount</h5>
                                                         </div>
                                                     </div>
                                                     <div class="d-flex align-items-center">
                                                         <span class="text-dark"><i class="me-50"></i><span><?php echo $product->discount; ?></span></span>
                                                     </div>
                                                 </div>

                                                 <div class="transaction-item">
                                                     <div class="d-flex">
                                                         <div class="avatar bg-light-danger rounded float-start">
                                                             <!--<div class="avatar-content">
                                                                  <i data-feather="x" class="avatar-icon font-medium-3"></i>
                                                             </div>-->
                                                         </div>
                                                         <div class="transaction-percentage">
                                                             <h5 class="transaction-title mt-75">Lower Price Guarantee</h5>
                                                         </div>
                                                     </div>
                                                     <div class="d-flex align-items-center">
                                                         <?php
                                                                 display_data_yes_or_no($product->has_lowest_price_guarantee);
                                                         ?>
                                                     </div>
                                                 </div>

                                                 <div class="transaction-item">
                                                     <div class="d-flex">
                                                         <div class="avatar bg-light-danger rounded float-start">
                                                             <!--<div class="avatar-content">
                                                                  <i data-feather="x" class="avatar-icon font-medium-3"></i>
                                                             </div>-->
                                                         </div>
                                                         <div class="transaction-percentage">
                                                             <h5 class="transaction-title mt-75">Free Return</h5>
                                                         </div>
                                                     </div>
                                                     <div class="d-flex align-items-center">
                                                         <?php
                                                                 echo $product->show_free_return;
                                                         ?>
                                                     </div>
                                                 </div>
                                             </div>
                                             <!-- Product Quick Details End -->
                                             <hr />
                                             <div class="d-flex flex-column flex-sm-row pt-1">
                                                 <a href="#" class="btn btn-info btn-cart me-0 me-sm-1 mb-1 mb-sm-0">
                                                     <i data-feather="eye" class="me-50"></i>
                                                     <span id="view-result">View Result</span>
                                                 </a>
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
                             </div>
                          </section>
                        <!-- Product end -->

                        <!-- Seller start -->
                          <section class="tab-pane" id="sellerTab" aria-labelledby="seller-tab" role="tabpanel">
                                     <div class="row">
                                        <div class="col-xl-6 col-lg-5 col-md-5 order-1 order-md-0">
                                            <div class="card">
                                                 <div class="card-body">
                                                     <div class="user-avatar-section">
                                                         <div class="d-flex align-items-center flex-column">
                                                             <img class="img-fluid rounded mt-3 mb-2" src="<?php echo checkAvatar($seller->account->portrait); ?>" height="110" width="110" alt="User avatar" />
                                                             <div class="user-info text-center">
                                                                 <?php 
                                                                 
                                                                 echo '<h4>'.$seller->name.'</h4>'; 
                                                                 echo getSellerBadge($seller->is_official_shop, $seller->is_preferred_plus_seller);
                                                                 ?>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="d-flex justify-content-around my-2 pt-75">
                                                         <div class="d-flex align-items-start me-2">
                                                             <span class="badge bg-light-primary p-75 rounded">
                                                                 <i data-feather="users" class="font-medium-2"></i>
                                                             </span>
                                                             <div class="ms-75">
                                                                 <h4 class="mb-0"><?php echo number_format($seller->follower_count, 0, '', ','); ?></h4>
                                                                 <small>Followers</small>
                                                             </div>
                                                         </div>
                                                         <div class="d-flex align-items-start">
                                                             <span class="badge bg-light-primary p-75 rounded">
                                                                 <i data-feather="shopping-cart" class="font-medium-2"></i>
                                                             </span>
                                                             <div class="ms-75">
                                                                 <h4 class="mb-0"><?php echo number_format($seller->item_count, 0, '', ','); ?></h4>
                                                                 <small>Products</small>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
                                                     <div class="info-container">
                                                         <ul class="list-unstyled">
                                                             <li class="mb-75">
                                                                 <span class="fw-bolder me-25">Username:</span>
                                                                 <span><?php echo $seller->account->username; ?></span>
                                                             </li>
                                                             <li class="mb-75 row">
                                                                 <span class="fw-bolder me-25 col-3 ">Stars:</span>
                                                                 <span id="seller_star" class="read-only-ratings col-9" data-rateyo-read-only="true" data-rating="<?php echo round($seller->rating_star, 1); ?>" data-bs-toggle="tooltip" data-bs-placement="right" title="<?php echo round($seller->rating_star, 1); ?>/5"></span>
                                                             </li>
                                                             <li class="mb-75">
                                                                 <span class="fw-bolder me-25">Place:</span>
                                                                 <span><?php echo $seller->shop_location    ; ?></span>
                                                             </li>
                                                             <li class="mb-75">
                                                                 <span class="fw-bolder me-25">Rating:</span>
                                                                 <span><?php echo identify_ratings($seller->rating_good, $seller->rating_normal, $seller->rating_bad); ?></span>
                                                             </li>
                                                             <li class="mb-75">
                                                                 <span class="fw-bolder me-25"><i class="me-25" data-feather="corner-down-right" class="font-medium-2"></i> Good:</span>
                                                                 <span><?php echo number_format($seller->rating_good, 0, '', ','); ?></span>
                                                             </li>
                                                             <li class="mb-75">
                                                                 <span class="fw-bolder me-25"><i class="me-25" data-feather="corner-down-right" class="font-medium-2"></i> Normal:</span>
                                                                 <span><?php echo number_format($seller->rating_normal, 0, '', ','); ?></span>
                                                             </li>
                                                             <li class="mb-75">
                                                                 <span class="fw-bolder me-25"><i class="me-25" data-feather="corner-down-right" class="font-medium-2"></i>  Bad:</span>
                                                                 <span><?php echo number_format($seller->rating_bad, 0, '', ','); ?></span>
                                                             </li>
                                                             <li class="mb-75">
                                                                 <span class="fw-bolder me-25">Joined:</span>
                                                                 <span><?php echo format_time_ago($seller->ctime); ?></span>
                                                             </li>
                                                         </ul>
                                                     </div>
                                                 </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-5 col-md-5 order-1 order-md-0">
                                            <div class="card card-transaction">
                                                <div class="card-header">
                                                    <h4 class="card-title">Other Products</h4>
                                                    <div class="dropdown chart-dropdown">
                                                        <i data-feather='alert-circle' data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Only recorded products will be shown."></i>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <?php 
                                                    
                                                        getOtherProducts($seller->shopid, $product->itemid);

                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                          </section>
                        <!-- Seller end -->

                        <!-- Price & Discounts start -->
                          <section class="tab-pane" id="priceTab" aria-labelledby="price-tab" role="tabpanel">
                             <div class="card">
                                 <div class="card-body">
                                     <div class="card card-company-table">
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Company</th>
                                                                <th>Category</th>
                                                                <th>Views</th>
                                                                <th>Revenue</th>
                                                                <th>Sales</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="avatar rounded">
                                                                            <div class="avatar-content">
                                                                                <img src="../../../app-assets/images/icons/toolbox.svg" alt="Toolbar svg" />
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <div class="fw-bolder">Dixons</div>
                                                                            <div class="font-small-2 text-muted">meguc@ruj.io</div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="avatar bg-light-primary me-1">
                                                                            <div class="avatar-content">
                                                                                <i data-feather="monitor" class="font-medium-3"></i>
                                                                            </div>
                                                                        </div>
                                                                        <span>Technology</span>
                                                                    </div>
                                                                </td>
                                                                <td class="text-nowrap">
                                                                    <div class="d-flex flex-column">
                                                                        <span class="fw-bolder mb-25">23.4k</span>
                                                                        <span class="font-small-2 text-muted">in 24 hours</span>
                                                                    </div>
                                                                </td>
                                                                <td>$891.2</td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="fw-bolder me-1">68%</span>
                                                                        <i data-feather="trending-down" class="text-danger font-medium-1"></i>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="avatar rounded">
                                                                            <div class="avatar-content">
                                                                                <img src="../../../app-assets/images/icons/parachute.svg" alt="Parachute svg" />
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <div class="fw-bolder">Motels</div>
                                                                            <div class="font-small-2 text-muted">vecav@hodzi.co.uk</div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="avatar bg-light-success me-1">
                                                                            <div class="avatar-content">
                                                                                <i data-feather="coffee" class="font-medium-3"></i>
                                                                            </div>
                                                                        </div>
                                                                        <span>Grocery</span>
                                                                    </div>
                                                                </td>
                                                                <td class="text-nowrap">
                                                                    <div class="d-flex flex-column">
                                                                        <span class="fw-bolder mb-25">78k</span>
                                                                        <span class="font-small-2 text-muted">in 2 days</span>
                                                                    </div>
                                                                </td>
                                                                <td>$668.51</td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="fw-bolder me-1">97%</span>
                                                                        <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="avatar rounded">
                                                                            <div class="avatar-content">
                                                                                <img src="../../../app-assets/images/icons/brush.svg" alt="Brush svg" />
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <div class="fw-bolder">Zipcar</div>
                                                                            <div class="font-small-2 text-muted">davcilse@is.gov</div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="avatar bg-light-warning me-1">
                                                                            <div class="avatar-content">
                                                                                <i data-feather="watch" class="font-medium-3"></i>
                                                                            </div>
                                                                        </div>
                                                                        <span>Fashion</span>
                                                                    </div>
                                                                </td>
                                                                <td class="text-nowrap">
                                                                    <div class="d-flex flex-column">
                                                                        <span class="fw-bolder mb-25">162</span>
                                                                        <span class="font-small-2 text-muted">in 5 days</span>
                                                                    </div>
                                                                </td>
                                                                <td>$522.29</td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="fw-bolder me-1">62%</span>
                                                                        <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="avatar rounded">
                                                                            <div class="avatar-content">
                                                                                <img src="../../../app-assets/images/icons/star.svg" alt="Star svg" />
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <div class="fw-bolder">Owning</div>
                                                                            <div class="font-small-2 text-muted">us@cuhil.gov</div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="avatar bg-light-primary me-1">
                                                                            <div class="avatar-content">
                                                                                <i data-feather="monitor" class="font-medium-3"></i>
                                                                            </div>
                                                                        </div>
                                                                        <span>Technology</span>
                                                                    </div>
                                                                </td>
                                                                <td class="text-nowrap">
                                                                    <div class="d-flex flex-column">
                                                                        <span class="fw-bolder mb-25">214</span>
                                                                        <span class="font-small-2 text-muted">in 24 hours</span>
                                                                    </div>
                                                                </td>
                                                                <td>$291.01</td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="fw-bolder me-1">88%</span>
                                                                        <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="avatar rounded">
                                                                            <div class="avatar-content">
                                                                                <img src="../../../app-assets/images/icons/book.svg" alt="Book svg" />
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <div class="fw-bolder">Cafés</div>
                                                                            <div class="font-small-2 text-muted">pudais@jife.com</div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="avatar bg-light-success me-1">
                                                                            <div class="avatar-content">
                                                                                <i data-feather="coffee" class="font-medium-3"></i>
                                                                            </div>
                                                                        </div>
                                                                        <span>Grocery</span>
                                                                    </div>
                                                                </td>
                                                                <td class="text-nowrap">
                                                                    <div class="d-flex flex-column">
                                                                        <span class="fw-bolder mb-25">208</span>
                                                                        <span class="font-small-2 text-muted">in 1 week</span>
                                                                    </div>
                                                                </td>
                                                                <td>$783.93</td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="fw-bolder me-1">16%</span>
                                                                        <i data-feather="trending-down" class="text-danger font-medium-1"></i>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="avatar rounded">
                                                                            <div class="avatar-content">
                                                                                <img src="../../../app-assets/images/icons/rocket.svg" alt="Rocket svg" />
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <div class="fw-bolder">Kmart</div>
                                                                            <div class="font-small-2 text-muted">bipri@cawiw.com</div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="avatar bg-light-warning me-1">
                                                                            <div class="avatar-content">
                                                                                <i data-feather="watch" class="font-medium-3"></i>
                                                                            </div>
                                                                        </div>
                                                                        <span>Fashion</span>
                                                                    </div>
                                                                </td>
                                                                <td class="text-nowrap">
                                                                    <div class="d-flex flex-column">
                                                                        <span class="fw-bolder mb-25">990</span>
                                                                        <span class="font-small-2 text-muted">in 1 month</span>
                                                                    </div>
                                                                </td>
                                                                <td>$780.05</td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="fw-bolder me-1">78%</span>
                                                                        <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="avatar rounded">
                                                                            <div class="avatar-content">
                                                                                <img src="../../../app-assets/images/icons/speaker.svg" alt="Speaker svg" />
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <div class="fw-bolder">Payers</div>
                                                                            <div class="font-small-2 text-muted">luk@izug.io</div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="avatar bg-light-warning me-1">
                                                                            <div class="avatar-content">
                                                                                <i data-feather="watch" class="font-medium-3"></i>
                                                                            </div>
                                                                        </div>
                                                                        <span>Fashion</span>
                                                                    </div>
                                                                </td>
                                                                <td class="text-nowrap">
                                                                    <div class="d-flex flex-column">
                                                                        <span class="fw-bolder mb-25">12.9k</span>
                                                                        <span class="font-small-2 text-muted">in 12 hours</span>
                                                                    </div>
                                                                </td>
                                                                <td>$531.49</td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="fw-bolder me-1">42%</span>
                                                                        <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                 </div>
                             </div>
                          </section>
                        <!-- Price & Discounts end -->

                        <!-- Community start -->
                          <section class="tab-pane" id="communityTab" aria-labelledby="community-tab" role="tabpanel">
                                <!-- Product Comments start -->
                                        <h6 class="section-label mt-25">Comment</h6>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start">
                                                    <div class="avatar me-75">
                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-9.jpg" width="38" height="38" alt="Avatar">
                                                    </div>
                                                    <div class="author-info">
                                                        <h6 class="fw-bolder mb-25">James Javeluna</h6>
                                                        <p class="card-text">March 1, 2023</p>
                                                        <p class="card-text">
                                                            This is currently a fixed comment but the idea is like this and will be implemented in the future.
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
                          </section>
                        <!-- Community end -->
                    </div>
                </div>
                <!--/ Main -->

                <!-- Sidebar -->
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
                                        <span class="timeline-point">
                                                <i data-feather="edit"></i>
                                        </span>
                                        <div class="timeline-event">
                                            <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                                <h6>First Record</h6>
                                                <span class="timeline-event-time">March 1, 2023</span>
                                            </div>
                                            <p>Transition will be available on the next update of records.</p>
                                            <small>Added by: <b>Guest</b></small>
                                        </div>
                                    </li>
                                    <li class="timeline-item">
                                        <span class="timeline-point">
                                                <i data-feather="book-open"></i>
                                        </span>
                                        <div class="timeline-event">
                                            <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                                <h6>History Available</h6>
                                                <span class="timeline-event-time">March 1, 2023</span>
                                            </div>
                                            <p>You can view the changes and progress of this product.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Ads start -->
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
                         <!-- Ads end -->
                    </div>
                    <!--/ Sidebar -->   
            </div>
        </div>
    </div>


<?php

$page_content = ob_get_clean();

include "../templates/main.php";

?>
