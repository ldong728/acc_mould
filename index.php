<?php
include_once 'includePackage.php';
session_start();

if (isset($_GET['img'])) {
    $imgPath = $GLOBALS['mypath'] . '/' . $_GET['img'];
    if (file_exists($imgPath)) {
        include $imgPath;
        exit;
    }
    header('HTTP/1.1 404 Not Found');
    echo 'error';
    exit;
}
$href = isset($_GET['href']) ? $_GET['href'] : 'index';
$href = $GLOBALS['mypath'] . "/view/$href.html";
if (file_exists($href)) {
    if (isset($_GET['login'])) {
        if (!isset($_SESSION['user'])) {
            $href = $GLOBALS['mypath'] . "/view/login.html";
        }
    }
    include $GLOBALS['mypath'] . "/view/template/head.html.php";
    if (isset($_GET['static'])) {
        include $GLOBALS['mypath'] . "/view/template/entrance_static.html.php";
    } else {
        include $GLOBALS['mypath'] . "/view/template/entrance.html.php";
    }
    include $href;
    include $GLOBALS['mypath'] . "/view/template/foot.html.php";
} else {
    header('HTTP/1.1 404 Not Found');
    echo '页面不存在 error';
}


exit;
