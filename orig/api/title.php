<?php
//Also used in menu
$file = pathinfo($_SERVER['SCRIPT_FILENAME'])['filename'];

//SEO
$title = "Title";
$meta_description = "not_set";
$meta_keywords  = "not_set";
$meta_author = "not_set";
$link_icon = "../../app-assets/images/ico/favicon.ico";


switch($file){
	case "index":
		$page_title = $title." | Home";
		$vendors_css = array(
			"vendors.min.css", 
			"charts/apexcharts.css", 
			"extensions/toastr.min.css"
		);

		$theme_css = array(
			"bootstrap.css", 
			"bootstrap-extended.css", 
			"colors.css", 
			"components.css", 
			"themes/dark-layout.css", 
			"themes/bordered-layout.css", 
			"themes/semi-dark-layout.css" 
		);

		$page_css = array(
			"core/menu/menu-types/vertical-menu.css", 
			"pages/dashboard-ecommerce.css", 
			"plugins/charts/chart-apex.css", 
			"plugins/extensions/ext-component-toastr.css"
		);

		$vendor_js = array(
			"vendors.min.js"
		);

		$page_vendor_js = array(
			"charts/apexcharts.min.js", 
			"extensions/toastr.min.js"
		);

		$theme_js = array(
			"core/app-menu.js", 
			"core/app.js"
		);

		$page_js = array(
			"scripts/pages/dashboard-ecommerce.js", 
			"scripts/pages/notification.js"
		);
		break;

	case 'earn':
		$page_title = $title." | Earn";

		$vendors_css = array(
			"vendors.min.css", 
			"editors/quill/katex.min.css", 
			"editors/quill/monokai-sublime.min.css", 
			"editors/quill/quill.snow.css", 
			"forms/select/select2.min.css", 
			"pickers/flatpickr/flatpickr.min.css", 
			"extensions/dragula.min.css", 
			"extensions/toastr.min.css"
		);

		$theme_css = array(
			"bootstrap.css", 
			"bootstrap-extended.css", 
			"colors.css", 
			"components.css", 
			"themes/dark-layout.css", 
			"themes/bordered-layout.css", 
			"themes/semi-dark-layout.css" 
		);

		$page_css = array(
			"core/menu/menu-types/vertical-menu.css", 
			"plugins/forms/form-quill-editor.css", 
			"plugins/forms/pickers/form-flat-pickr.css", 
			"plugins/extensions/ext-component-toastr.css",
			"plugins/forms/form-validation.css",
			"pages/app-todo.css"
		);

		$vendor_js = array(
			"vendors.min.js"
		);

		$page_vendor_js = array(
			"editors/quill/katex.min.js", 
			"editors/quill/highlight.min.js",
			"editors/quill/quill.min.js", 
			"forms/select/select2.full.min.js",
			"pickers/flatpickr/flatpickr.min.js", 
			"extensions/dragula.min.js",
			"forms/validation/jquery.validate.min.js", 
			"extensions/toastr.min.js"
		);

		$theme_js = array(
			"core/app-menu.js", 
			"core/app.js"
		);

		$page_js = array(
			"scripts/pages/app-todo.js",
			"scripts/pages/notification.js"
		);
		break;

	case 'shop':
		$page_title = $title." | Withdraw";

		$vendors_css = array(
			"vendors.min.css", 
			"extensions/nouislider.min.css", 
			"extensions/toastr.min.css"
		);

		$theme_css = array(
			"bootstrap.css", 
			"bootstrap-extended.css", 
			"colors.css", 
			"components.css", 
			"themes/dark-layout.css", 
			"themes/bordered-layout.css", 
			"themes/semi-dark-layout.css" 
		);

		$page_css = array(
			"core/menu/menu-types/vertical-menu.css", 
			"plugins/extensions/ext-component-sliders.css", 
			"pages/app-ecommerce.css",
			"plugins/extensions/ext-component-toastr.css"
		);

		$vendor_js = array(
			"vendors.min.js"
		);

		$page_vendor_js = array(
			"extensions/wNumb.min.js",
			"extensions/nouislider.min.js", 
			"extensions/toastr.min.js"
		);

		$theme_js = array(
			"core/app-menu.js", 
			"core/app.js"
		);

		$page_js = array(
			"scripts/pages/shop.js",
			"scripts/pages/notification.js"
		);
		break;

	case 'item-details':
		$page_title = $title." | ";

		$vendors_css = array(
			"vendors.min.css", 
			"forms/spinner/jquery.bootstrap-touchspin.css",
			"extensions/swiper.min.css", 
			"extensions/toastr.min.css"
		);

		$theme_css = array(
			"bootstrap.css", 
			"bootstrap-extended.css", 
			"colors.css", 
			"components.css", 
			"themes/dark-layout.css", 
			"themes/bordered-layout.css", 
			"themes/semi-dark-layout.css" 
		);

		$page_css = array(
			"core/menu/menu-types/vertical-menu.css", 
			"plugins/extensions/ext-component-sliders.css", 
			"pages/app-ecommerce-details.css",
			"plugins/extensions/ext-component-toastr.css"
		);

		$vendor_js = array(
			"vendors.min.js"
		);

		$page_vendor_js = array(
			"forms/spinner/jquery.bootstrap-touchspin.js",
			"extensions/swiper.min.js", 
			"extensions/toastr.min.js"
		);

		$theme_js = array(
			"core/app-menu.js", 
			"core/app.js"
		);

		$page_js = array(
			"scripts/pages/shop-details.js",
			"scripts/forms/item.js",
			"scripts/pages/notification.js"
		);
		break;


	case 'user-profile':
		$page_title = $title." | ";

		$vendors_css = array(
			"vendors.min.css",
			"extensions/toastr.min.css",
			"pickers/flatpickr/flatpickr.min.css"
		);

		$theme_css = array(
			"bootstrap.css", 
			"bootstrap-extended.css", 
			"colors.css", 
			"components.css", 
			"themes/dark-layout.css", 
			"themes/bordered-layout.css", 
			"themes/semi-dark-layout.css" 
		);

		$page_css = array(
			"core/menu/menu-types/vertical-menu.css", 
			"pages/page-profile.css",
			"plugins/extensions/ext-component-toastr.css",
			"plugins/forms/pickers/form-flat-pickr.css"
		);

		$vendor_js = array(
			"vendors.min.js"
		);

		$page_vendor_js = array(
			"extensions/toastr.min.js",
			"pickers/flatpickr/flatpickr.min.js"
		);

		$theme_js = array(
			"core/app-menu.js", 
			"core/app.js"
		);

		$page_js = array(
			"scripts/pages/page-profile.js",
			"scripts/pages/notification.js"
		);
		break;

	case 'leaderboard':
		$page_title = $title." | Leaderboard";

		$vendors_css = array(
			"vendors.min.css",
			"extensions/toastr.min.css"
		);

		$theme_css = array(
			"bootstrap.css", 
			"bootstrap-extended.css", 
			"colors.css", 
			"components.css", 
			"themes/dark-layout.css", 
			"themes/bordered-layout.css", 
			"themes/semi-dark-layout.css" 
		);

		$page_css = array(
			"core/menu/menu-types/vertical-menu.css", 
			"pages/page-pricing.css",
			"plugins/extensions/ext-component-toastr.css"
		);

		$vendor_js = array(
			"vendors.min.js"
		);

		$page_vendor_js = array(
			"extensions/toastr.min.js"
		);

		$theme_js = array(
			"core/app-menu.js", 
			"core/app.js"
		);

		$page_js = array(
			"scripts/pages/page-pricing.js",
			"scripts/pages/notification.js"
		);
		break;

	case 'support':
		$page_title = $title." | Support";

		$vendors_css = array(
			"vendors.min.css",
			"extensions/toastr.min.css"
		);

		$theme_css = array(
			"bootstrap.css", 
			"bootstrap-extended.css", 
			"colors.css", 
			"components.css", 
			"themes/dark-layout.css", 
			"themes/bordered-layout.css", 
			"themes/semi-dark-layout.css" 
		);

		$page_css = array(
			"core/menu/menu-types/vertical-menu.css", 
			"pages/app-chat.css",
			"pages/app-chat-list.css",
			"plugins/extensions/ext-component-toastr.css"
		);

		$vendor_js = array(
			"vendors.min.js"
		);

		$page_vendor_js = array(
			"extensions/toastr.min.js"
		);

		$theme_js = array(
			"core/app-menu.js", 
			"core/app.js"
		);

		$page_js = array(
			"scripts/pages/app-support.js",
			"scripts/pages/notification.js",
			"scripts/components/components-tooltips.js"
		);
		break;


		case 'achievements':
		$page_title = $title." | Achievements";

		$vendors_css = array(
			"vendors.min.css",
			"charts/apexcharts.css"
		);

		$theme_css = array(
			"bootstrap.css", 
			"bootstrap-extended.css", 
			"colors.css", 
			"components.css", 
			"themes/dark-layout.css", 
			"themes/bordered-layout.css", 
			"themes/semi-dark-layout.css" 
		);

		$page_css = array(
			"core/menu/menu-types/vertical-menu.css", 
			"pages/page-pricing.css"
		);

		$vendor_js = array(
			"vendors.min.js"
		);

		$page_vendor_js = array(
			"charts/apexcharts.min.js",
			"extensions/toastr.min.js"
		);

		$theme_js = array(
			"core/app-menu.js", 
			"core/app.js"
		);

		$page_js = array(
			"scripts/cards/card-statistics.js",
			"scripts/pages/notification.js"
		);
		break;

		case 'support':
		$page_title = $title." | Support";

		$vendors_css = array(
			"vendors.min.css"
		);

		$theme_css = array(
			"bootstrap.css", 
			"bootstrap-extended.css", 
			"colors.css", 
			"components.css", 
			"themes/dark-layout.css", 
			"themes/bordered-layout.css", 
			"themes/semi-dark-layout.css" 
		);

		$page_css = array(
			"core/menu/menu-types/vertical-menu.css", 
			"pages/app-chat.css",
			"pages/app-chat-list.css"
		);

		$vendor_js = array(
			"vendors.min.js"
		);

		$page_vendor_js = array(
			"extensions/toastr.min.js"
		);

		$theme_js = array(
			"core/app-menu.js", 
			"core/app.js"
		);

		$page_js = array(
			"scripts/pages/app-support.js",
			"scripts/pages/notification.js",
			"scripts/components/components-tooltips.js"
		);
		break;


		case 'blog_list':
		$page_title = $title." | Blog";

		$vendors_css = array(
			"vendors.min.css",
			"charts/apexcharts.css",
			"extensions/toastr.min.css"
		);

		$theme_css = array(
			"bootstrap.css", 
			"bootstrap-extended.css", 
			"colors.css", 
			"components.css", 
			"themes/dark-layout.css", 
			"themes/bordered-layout.css", 
			"themes/semi-dark-layout.css" 
		);

		$page_css = array(
			"core/menu/menu-types/vertical-menu.css", 
			"pages/page-blog.css"
		);

		$vendor_js = array(
			"vendors.min.js"
		);

		$page_vendor_js = array(
			
		);

		$theme_js = array(
			"core/app-menu.js", 
			"core/app.js"
		);

		$page_js = array(
			"scripts/cards/card-statistics.js",
			"scripts/pages/notification.js"
		);
		break;

	case 'panel':
		$page_title = $title." | User Panel";
		$vendors_css = array(
			"vendors.min.css", 
			"extensions/toastr.min.css",
			"tables/datatable/dataTables.bootstrap4.min.css",
			"tables/datatable/dataTables.bootstrap4.min.css",
			"tables/datatable/dataTables.bootstrap4.min.css",
			"tables/datatable/rowGroup.bootstrap4.min.css"
		);

		$theme_css = array(
			"bootstrap.css", 
			"bootstrap-extended.css", 
			"colors.css", 
			"components.css", 
			"themes/dark-layout.css", 
			"themes/bordered-layout.css", 
			"themes/semi-dark-layout.css" 
		);

		$page_css = array(
			"core/menu/menu-types/vertical-menu.css", 
			"pages/dashboard-ecommerce.css", 
			"plugins/charts/chart-apex.css", 
			"plugins/extensions/ext-component-toastr.css"
		);

		$vendor_js = array(
			"vendors.min.js"
		);

		$page_vendor_js = array(
			"extensions/toastr.min.js",
			"tables/datatable/jquery.dataTables.min.js",
			"tables/datatable/datatables.bootstrap4.min.js",
			"tables/datatable/dataTables.responsive.min.js",
			"tables/datatable/responsive.bootstrap4.js",
			"tables/datatable/datatables.checkboxes.min.js",
			"tables/datatable/datatables.buttons.min.js",
			"tables/datatable/jszip.min.js",
			"tables/datatable/vfs_fonts.js",
			"tables/datatable/buttons.html5.min.js",
			"tables/datatable/buttons.print.min.js",
			"tables/datatable/dataTables.rowGroup.min.js",
			"pickers/flatpickr/flatpickr.min.js"
		);

		$theme_js = array(
			"core/app-menu.js", 
			"core/app.js"
		);

		$page_js = array(
			"scripts/pages/notification.js"
		);
		break;

	default:
		$page_title = "Error - Page not found";
			http_response_code(404);
			include($_SERVER['DOCUMENT_ROOT'].'/page/not_found.php'); // provide your own HTML for the error page
			die();
		break;
}

?>