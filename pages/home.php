<?php

ob_start();

$page_title = "GainPoints";
$page_header = "Homepage";

// For the meta
$page_description = "";
$page_keywords = "";
$page_keywords = "";

// For the CSS files
$page_content = "";
$page_vendor_css = ["vendors.min.css", "extensions/toastr.min.css"];
$page_theme_css = ["bootstrap.css", "bootstrap-extended.css", "colors.css", "components.css", "themes/dark-layout.css", "themes/bordered-layout.css", "themes/semi-dark-layout.css"];
$page_css = ["core/menu/menu-types/horizontal-menu.css", "pages/dashboard-ecommerce.css", "plugins/charts/chart-apex.css", "plugins/extensions/ext-component-toastr.css"];

// For the JS files
$vendor_js = ["vendors.min.js"];
$page_vendor_js = ["extensions/toastr.min.js"];
$page_theme_js = ["core/app-menu.js", "core/app.js"];
$page_js = [];

?>
<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0"><?php echo $page_header; ?></h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active"><?php echo $page_header; ?>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Report Issue"><i data-feather="file-text"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <div class="alert-body">
                                <strong>Info:</strong> This layout can be useful for getting started with empty content section. Please check
                                the&nbsp;<a class="text-primary" href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/documentation-layout-empty.html" target="_blank">Layout empty documentation</a>&nbsp; for more details.
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</div>
<?php

$page_content = ob_get_clean();

include "./templates/main.php";

?>
