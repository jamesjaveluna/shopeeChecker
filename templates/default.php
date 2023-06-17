<!DOCTYPE html>
<html class="loading dark-layout" lang="en" data-layout="dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="<?php echo $page_description; ?>">
    <meta name="keywords" content="<?php echo $page_keywords; ?>">
    <meta name="author" content="<?php echo SITE_AUTHOR; ?>">
    <title><?php echo $page_title; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo SITE_ICON; ?>">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <?php 
    echo PHP_EOL.'    <!-- BEGIN: Vendor CSS-->';
    if (isset($page_vendor_css)) { 
        foreach($page_vendor_css as $css) {
            echo PHP_EOL.'    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/'.$css.'">';
        } 
    }
    echo PHP_EOL.'    <!-- END: Vendor CSS-->';


    echo PHP_EOL.'    <!-- BEGIN: Theme CSS-->';
    if (isset($page_theme_css)) { 
        foreach($page_theme_css as $css) {
            echo PHP_EOL.'    <link rel="stylesheet" type="text/css" href="../app-assets/css/'.$css.'">';
        } 
    }
    echo PHP_EOL.'    <!-- END: Theme CSS-->';
   
    echo PHP_EOL.'    <!-- BEGIN: Page CSS-->';
    if (isset($page_css)) { 
        foreach($page_css as $css) {
            echo PHP_EOL.'    <link rel="stylesheet" type="text/css" href="../app-assets/css/'.$css.'">';
        } 
    }
    echo PHP_EOL.'    <!-- END: Page CSS-->';
    ?>


</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern navbar-floating footer-static " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    <?php 
        include('./includes/header-vertical.php')
    ?>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php 
        include('./includes/menu-vertical.php')
    ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <?php echo $page_content; ?>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <?php 
        include('./includes/footer.php')
    ?>
    <!-- END: Footer-->

    <?php 
    echo PHP_EOL.'    <!-- BEGIN: Vendor JS-->';
    if (isset($vendor_js)) { 
        foreach($vendor_js as $js) {
            echo PHP_EOL.'    <script type="text/javascript" src="../app-assets/vendors/js/'.$js.'"></script>';
        } 
    }
    echo PHP_EOL.'    <!-- BEGIN Vendor JS-->';

    echo PHP_EOL.'    <!-- BEGIN: Page Vendor JS-->';
    if (isset($page_vendor_js)) { 
        foreach($page_vendor_js as $js) {
            echo PHP_EOL.'    <script type="text/javascript" src="../app-assets/vendors/js/'.$js.'"></script>';
        } 
    }
    echo PHP_EOL.'    <!-- END: Page Vendor JS-->';

    echo PHP_EOL.'    <!-- BEGIN: Theme JS-->';
    if (isset($page_theme_js)) { 
        foreach($page_theme_js as $js) {
            echo PHP_EOL.'    <script type="text/javascript" src="../app-assets/js/'.$js.'"></script>';
        } 
    }
    echo PHP_EOL.'    <!-- END: Theme JS-->';

    echo PHP_EOL.'    <!-- BEGIN: Page JS-->';
    if (isset($page_js)) { 
        foreach($page_js as $js) {
            echo PHP_EOL.'    <script type="text/javascript" src="../app-assets/js/'.$js.'"></script>';
        } 
    }
    echo PHP_EOL.'    <!-- END: Page JS-->';
    ?>

    <script>
        $(window).on('load', function () {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }

        })


       
    </script>
</body>
<!-- END: Body-->

</html>