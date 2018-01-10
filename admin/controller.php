<?php
/**
 * Created by PhpStorm.
 * User: godlee
 * Date: 2015/10/29
 * Time: 10:50
 */
include_once '../includePackage.php';
session_start();

if (isset($_SESSION[DOMAIN]['login']) && DOMAIN == $_SESSION[DOMAIN]['login']) {
    if (isset($_GET['menu']) && array_key_exists($_GET['menu'], $_SESSION[DOMAIN]['pms'])) {

    }
    //公众号操作


    exit;
}
header('location:index.php');

exit;

