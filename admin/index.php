<?php

include_once '../includePackage.php';
include_once 'menu.php';
session_start();
if (isset($_GET['logout'])) {//登出
    unset($_SESSION[DOMAIN]);
    include 'view/login.html.php';
    exit;
}
if(isset($_GET['img'])){
    $imgPath=$GLOBALS['mypath'].'/'.$_GET['img'];
    if(file_exists($imgPath)){
        include $imgPath;
    }
}
if (isset($_SESSION[DOMAIN]['login']) && DOMAIN == $_SESSION[DOMAIN]['login']) {
    if (isset($_GET['menu']) && array_key_exists($_GET['menu'], $_SESSION[DOMAIN]['pms'])) {
        $_GET['sub']();
        exit;
    }
    printAdminView('blank.html.php', '管理后台');
    exit;
} else {
    if (isset($_GET['login'])) {
        $name = $_POST['adminName'];
        $pwd = $_POST['password'];
        if ($_POST['adminName'] . $_POST['password'] == ADMIN . PASSWORD) {
            $_SESSION[DOMAIN]['login'] = DOMAIN;
            $_SESSION[DOMAIN]['operator_name']="系统管理员";
            $_SESSION[DOMAIN]['operator_id'] = -1;
            printAdminView('blank.html.php', '管理后台');
        } else {
            $query = pdoQuery('operator_tbl',array('id','name'), array('name' => $name, 'md5' => md5($pwd)), ' limit 1');
            $op_inf = $query->fetch();
            if ($op_inf) {
                $_SESSION[DOMAIN]['login'] = DOMAIN;
                $_SESSION[DOMAIN]['operator_id'] = $op_inf['id'];
                $_SESSION[DOMAIN]['operator_name']=$op_inf['name'];
                printAdminView('blank.html.php', '管理后台');
                exit;
            } else {
                include 'view/login.html.php';
                exit;
            }

        }
        exit;
    }

    include 'view/login.html.php';
    exit;
}

function category_edit(){
    printAdminView('category_edit.html.php','分类管理');

}
function company_list(){
    printAdminView('company_list.html.php','供应商列表');
}
function company_edit(){
    global $companyInf,$companyCategory;
    $companyId=isset($_GET['company_id'])?$_GET['company_id']:0;
    $modeName='编辑供应商';
    if($companyId){
        $companyQuery=pdoQuery('company_tbl',null,['company_id'=>$companyId],'limit 1');
        $companyQuery->setFetchMode(PDO::FETCH_ASSOC);
        $companyInf=$companyQuery->fetch();
        $companyCategory=pdoQuery('company_category_tbl',null,['company'=>$companyId],null);
        $companyCategory->setFetchMode(PDO::FETCH_ASSOC);
        $companyCategory=$companyCategory->fetchAll();
    }else{
        $companyInf=0;
        $companyCategory=0;
        $modeName='新建供应商';
    }
    printAdminView('company_edit.html.php',$modeName);
}
function product_edit(){
    global $productInf;
    $productId=isset($_GET['product_id'])?$_GET['product_id']:0;
    $modeName='编辑商品';
    if($productId){
        $productQuery=pdoQuery('product_tbl',null,['product_id'=>$productId],'limit 1');
        $productQuery->setFetchMode(PDO::FETCH_ASSOC);
        $productInf=$productQuery->fetch();
    }else{
        $productInf=0;
        $modeName='新建商品';
    }
    printAdminView('product_edit.html.php',$modeName);
}
function product_list(){
    printAdminView('product_list.html.php','商品列表');
}
function user_list(){
    printAdminView('user_list.html.php','用户列表');
}
function index_manage(){
    printAdminView('index_manage.html.php','首页设置');
}
function regist_request(){
    printAdminView('regist_request.html.php','首页设置');
}
function cart_manage(){
    printAdminView('cart_manage.html.php','交易管理');
}
function process_manage(){
    printAdminView('process_manage.html.php','加工需求管理');
}
function process_quote_manage(){
    global $processNeedId;
    $processNeedId=isset($_GET['process_need_id'])?$_GET['process_need_id']:0;
    printAdminView('process_quote_manage.html.php','加工需求报价管理');
}
function purchase_manage(){
    printAdminView('purchase_manage.html.php','采购管理');
}
function purchase_quote_manage(){
    global $purchaseId;
    $purchaseId=isset($_GET['purchase_id'])?$_GET['purchase_id']:0;
    printAdminView('purchase_quote_manage.html.php','采购报价管理');
}
function bidding_manage(){
    printAdminView('bidding_manage.html.php','投标管理');
}
function tender_manage() {
    global $biddingId;
    $biddingId=isset($_GET['bidding_id'])?$_GET['bidding_id']:0;
    printAdminView('tender_manage.html.php','采购报价管理');
}
function bidding_inquiry_manage(){
    printAdminView('bidding_inquiry_manage.html.php','询价管理');
}
function tender_inquiry_manage() {
    global $biddingInquiryId;
    $biddingInquiryId=isset($_GET['biding_inquiry_id'])?$_GET['biding_inquiry_id']:0;
    printAdminView('tender_inquiry_manage.html.php','采购报价管理');
}




//以下为admin通用方法
function options(){
    global $pmsList,$subMenuList;
    $query=pdoQuery('sub_menu_view',null,null,null);
    foreach ($query as $row) {
        if(isset($row['s_id']))$subMenuList[]=$row;
    }

    $pmsList = pdoQuery('pms_tbl',null,null,null)->fetchAll();
    printAdminView('option.html.php','功能菜单');
}
function operator(){
    global $pmsList,$opList;
    $pms=pdoQuery('pms_tbl',null,null,null);
    foreach ($pms as $row) {
        $pmsList[$row['id']]=$row;
    }

    $op=pdoQuery('op_pms_view',null,null,null);
    foreach ($op as $row) {

        if(!isset($opList[$row['id']])){
            $opList[$row['id']]=$row;
            $opList[$row['id']]['pms']=$pmsList;
        }
        if($row['pms_id'])$opList[$row['id']]['pms'][$row['pms_id']]['checked']='checked';
    }
//    mylog(getArrayInf($opList));
    printAdminView('operator.html.php','操作员管理');

}

