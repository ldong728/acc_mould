<?php
include_once 'includePackage.php';

session_start();


if(isset($_GET['img'])){
    $imgPath=$GLOBALS['mypath'].'/'.$_GET['img'];
    if(file_exists($imgPath)){
        include $imgPath;
    }
}

$href=isset($_GET['href'])?$_GET['href']:'index';
$href=$GLOBALS['mypath']."/view/$href.html";
if(file_exists($href)){
    include $href;
}else{
    echo 'error';
}


exit;
