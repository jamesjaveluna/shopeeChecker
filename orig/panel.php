<?php
include $_SERVER['DOCUMENT_ROOT'].'/api/class/user.php';
include $_SERVER['DOCUMENT_ROOT'].'/api/title.php';

$view = $_GET['viewing'] ? $_GET['viewing'] : 1;

$isLogged = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : false;
$userID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
$fullname = isset($_SESSION['user_fullname']) ? $_SESSION['user_fullname'] : false;
$avatar = isset($_SESSION['user_avatar']) ? $_SESSION['user_avatar'] : false;
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
    <title><?php echo $page_title; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $link_icon; ?>">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

<!-- BEGIN: Vendor CSS-->

<?php
    foreach($vendors_css as $css){
        echo PHP_EOL.'<link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/'.$css.'">';
    }

    unset($css);
?>

<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->

<?php
    foreach($theme_css as $css){
        echo PHP_EOL.'<link rel="stylesheet" type="text/css" href="../app-assets/css/'.$css.'">';
    }

    unset($css);
?>

<!-- BEGIN: Page CSS-->

<?php
    foreach($page_css as $css){
        echo PHP_EOL.'<link rel="stylesheet" type="text/css" href="../app-assets/css/'.$css.'">';
    }

    unset($css);
?>

<!-- END: Page CSS-->

<!-- BEGIN: Custom CSS-->

<link rel="stylesheet" type="text/css" href="../assets/css/style.css">

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


       switch ($view) {
        case 'home':
            if ($isLogged == true) {
                include './content/panel_transaction_view.php';
            } else {
                include './content/not-authorized.php';
            }
            break;

        case 'transaction':
            if ($isLogged == true) {
                include './content/panel_transaction_view.php';
            } else {
                include './content/not-authorized.php';
            }
            break;

        case 'withdrawal':
            if ($isLogged == true) {
                include './content/panel_withdrawal_view.php';
            } else {
                include './content/not-authorized.php';
            }
            break;

        case 'offer':
            if ($isLogged == true) {
                include './content/panel_offers_view.php';
            } else {
                include './content/not-authorized.php';
            }
            break;

        case 'referral':
            if ($isLogged == true) {
                include './content/panel_transaction_view.php';
            } else {
                include './content/not-authorized.php';
            }
            break;

        default:
            include './content/panel_transaction_view.php';
            break;
        }

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
        echo PHP_EOL.'<script src="../app-assets/vendors/js/'.$js.'"></script>';
    }

    unset($js);
?>

<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->

<?php
    foreach($page_vendor_js as $js){
        echo PHP_EOL.'<script src="../app-assets/vendors/js/'.$js.'"></script>';
    }

    unset($js);
?>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->

<?php
    foreach($theme_js as $js){
        echo PHP_EOL.'<script src="../app-assets/js/'.$js.'"></script>';
    }

    unset($js);
?>

<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->

<?php
    foreach($page_js as $js){
        echo PHP_EOL.'<script src="../app-assets/js/'.$js.'"></script>';
    }

    unset($js);

    switch ($view) {
        case 'home':
            echo PHP_EOL.'<script src="../app-assets/js/scripts/tables/offer.js"></script>';
            break;

        case 'transaction':
            echo PHP_EOL.'<script src="../app-assets/js/scripts/tables/transaction.js"></script>';
            break;

        case 'withdrawal':
            echo PHP_EOL.'<script src="../app-assets/js/scripts/tables/withdrawal.js"></script>';
            break;

        case 'offer':
            echo PHP_EOL.'<script src="../app-assets/js/scripts/tables/offer.js"></script>';
            break;

        case 'referral':
            echo PHP_EOL.'<script src="../app-assets/js/scripts/tables/referral.js"></script>';
            break;

        default:
            break;
        }
    
?>

<!-- END: Page JS-->

    <script>
        $(window).on('load', function () {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }

        })

        const img = document.querySelector('img')
    img.ondragstart = () => {
      return false;
    };

       
    </script>
</body>
<!-- END: Body-->

</html>