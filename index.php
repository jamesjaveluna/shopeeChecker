<?php
// Load configuration data and reusable code
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

// Parse the request URL and determine the requested page or action
$request_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$script_name = $_SERVER['SCRIPT_NAME'];
$base_url = dirname($script_name);

if (strpos($request_url, $base_url) === 0) {
    $request_url = substr($request_url, strlen($base_url));
}

// Debugging code to log the requested URL
error_log("Requested URL: " . $request_url);

if ($request_url === '/') {
    $page = 'home';
} else {
    $page = ltrim($request_url, '/');
}

// Debugging code to log the page being loaded
error_log("Loading page: " . $page);

// Check if user is logged or not
$user_isLogged = true;
$user_type = 3;

// Render the requested page or action
switch ($page) {
    case 'home':
        include __DIR__ . '/pages/home.php';
        break;
    case 'about':
        include __DIR__ . '/pages/about.php';
        break;
    case 'contact':
        include __DIR__ . '/pages/contact.php';
        break;
    case 'rewards':
        include __DIR__ . '/pages/rewards.php';
        break;
    case 'login':
        include __DIR__ . '/pages/login.php';
        break;
    case 'logout':
        include __DIR__ . '/pages/logout.php';
        break;
    case 'register':
        include __DIR__ . '/pages/register.php';
        break;
    case 'earn-points':
        include __DIR__ . '/actions/earn-points.php';
        break;
    case 'redeem-reward':
        include __DIR__ . '/actions/redeem-reward.php';
        break;

    case 'product':
        include __DIR__ . '/pages/product.php';
        break;

    default:
        //include __DIR__ . '/pages/404.php';
        header("Location: https://djaveluna.online/shopee/Dwarf-Papaya-Seeds-10pcs-seeds");
        break;
}


?>