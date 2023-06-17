<?php 
include $_SERVER['DOCUMENT_ROOT'].'/api/class/user.php';
include $_SERVER['DOCUMENT_ROOT'].'/api/class/shop.php';
include $_SERVER['DOCUMENT_ROOT'].'/api/title.php';
include $_SERVER['DOCUMENT_ROOT'].'/api/config.php';

$function = new User();
$shop = new Shop();

$slug = $_GET['slug'];
$page = $_GET['page']; 


$details = json_decode($shop->get_product_details_v2($slug));


/*if(isset($_GET['id'])) {// && is_numeric($_GET['id']) && $shop->check_item_exist($_GET['id'])){
    $id = $_GET['id'];
    $details = json_decode($shop->get_item_details($id));
} else {
    //http_response_code(404);
	//include($_SERVER['DOCUMENT_ROOT'].'/page/not_found.php'); // provide your own HTML for the error page
	//die();
}
*/


?>
<!DOCTYPE html>
<html class="loading dark-layout" lang="en" data-layout="dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="<?php echo $meta_description; ?>">
    <meta name="keywords" content="<?php echo $meta_keywords; ?>">
    <meta name="author" content="<?php echo $meta_author; ?>">
    <title><?php echo $page_title.' '.$details->name; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $link_icon; ?>">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

     <!-- BEGIN: Vendor CSS-->
    <?php
        foreach($vendors_css as $css){
            echo '<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/'.$css.'">';
        }

        unset($css);
    ?>
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <?php
        foreach($theme_css as $css){
            echo '<link rel="stylesheet" type="text/css" href="../../../app-assets/css/'.$css.'">';
        }

        unset($css);
    ?>
    
    <!-- BEGIN: Page CSS-->
    <?php
        foreach($page_css as $css){
            echo '<link rel="stylesheet" type="text/css" href="../../../app-assets/css/'.$css.'">';
        }

        unset($css);
    ?>
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern navbar-floating footer-static <?php if(isset($_SESSION['sys']['menu_collapsed']) && $_SESSION['sys']['menu_collapsed'] == 1)  {  echo 'menu-collapsed';  }  ?>" data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    <?php 
    

    include './app-assets/inc/header.php';

    
    ?>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <?php
    include './app-assets/inc/menu.php';

    ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
     <?php

        include './content/item-details.php';

    ?>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

     <!-- BEGIN: Footer-->
   <?php

   include './app-assets/inc/footer.php';
   
   ?>
    
    <!-- END: Footer-->
    <!-- BEGIN: Vendor JS-->
    <?php
        foreach($vendor_js as $js){
            echo '<script src="../../../app-assets/vendors/js/'.$js.'"></script>';
        }

        unset($js);
    ?>
    <!-- BEGIN Vendor JS-->
    <!-- BEGIN: Page Vendor JS-->
    <?php
        foreach($page_vendor_js as $js){
            echo '<script src="../../../app-assets/vendors/js/'.$js.'"></script>';
        }

        unset($js);
    ?>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->
    <?php
        foreach($theme_js as $js){
            echo '<script src="../../../app-assets/js/'.$js.'"></script>';
        }

        unset($js);
    ?>
    <!-- END: Theme JS-->
    <!-- BEGIN: Page JS-->
    <?php
        foreach($page_js as $js){
            echo '<script src="../../../app-assets/js/'.$js.'"></script>';
        }

        unset($js);
    ?>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
   </script>

   <?php 
   /*
   <script>
   var touchspinValue = $('.touchspin-min-max'),
    counterMin = 0,
    counterMax = <?php echo $details->items[0]->stock; ?>;

   var selection = document.getElementById("productSelect");
   var tPrice = document.getElementById("total_price");
   var price = <?php echo number_format($details->items[0]->price,2); ?>;
   var fee = <?php echo number_format($details->fee,2); ?>;

   selection.onchange = function(event){
     counterMax = event.target.options[event.target.selectedIndex].dataset.stock;
     price = event.target.options[event.target.selectedIndex].dataset.price;
     console.log("Stock: " + counterMax);
     console.log("Price: " + price);
     updatePrice();
   };

   function updatePrice(){
          var total = (price * touchspinValue.val())+fee;
          tPrice.innerHTML = '<?php echo $_config['general']['currency_symbol']; ?> '+total;
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
      });
  }
    </script>*/
    ?>
</body>
<!-- END: Body-->

</html>