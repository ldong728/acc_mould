<?php
//以下为测试公众号用
//define('APP_ID','wx03393af10613da23');
//define('APP_SECRET','40751854901cc489eddd055538224e8a');
//define('WEIXIN_ID','gh_964192c927cb');
//define('MCH_ID','now is null');
//define('KEY','now is null');
//define("TOKEN", "godlee");
//define('DOMAIN',"mmzrb");
//define('NOTIFY_URL',"now is null");
//define("DB_NAME","gshop_db");
//define("DB_USER","gshopUser");
//define("DB_PSW","cT9vVpxBLQaFQYrh");
//$mypath = $_SERVER['DOCUMENT_ROOT'] . '/'.DOMAIN;   //用于直接部署




define('ADMIN','admin');
define('PASSWORD','admin');

//alipay
//define("ALI_PAY_APP_ID","2016082100305102");
//define("ALI_PAY_GATEWAY","https://openapi.alipaydev.com/gateway.do");

//server&database
define("PRO","http://");


//define('DOMAIN',"");//测试服务器
//define('DB_IP','localhost');
//define("DB_NAME","acc_mould_db");
//define("DB_USER","acc_mould_user");
//define("DB_PSW","QLPyxyVfTCmvC9ET");

//本机测试
define('DOMAIN',"/acc_mould");
define('DB_IP','localhost');
define("DB_NAME","acc_mould_db");
define("DB_USER","root");
define("DB_PSW","");

//牛魔王2
//define('DOMAIN',"/");
//define('DB_IP','localhost');
//define("DB_NAME","acc_mould_db");
//define("DB_USER","nmw");
//define("DB_PSW","!1234nmw");

$mypath = $_SERVER['DOCUMENT_ROOT'] .DOMAIN;   //用于直接部署
include_once $mypath . '/includes/magicquotes.inc.php';
include_once $mypath . '/includes/db.inc.php';
include_once $mypath . '/includes/helpers.inc.php';
header("Content-Type:text/html; charset=utf-8");