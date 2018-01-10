<?php

include_once $GLOBALS['mypath'].'/libs/ali_pay/AopSdk.php';
include_once $GLOBALS['mypath'] . '/includes/db.inc.php';
class AliNotify{


    function notify(){
        $publicKey=file_get_contents($GLOBALS['mypath'].'/libs/ali_pay/publicKey.cfg');
        $aop= new AopClient;
        $aop->alipayPublicKey=$publicKey;
        $flag=$aop->rsaCheckV1($_POST,null,"RSA2");
        return $flag;
    }
}
echo 'success';
$notify=new AliNotify();
if($notify->notify()){
    mylog(json_encode($_POST));
    $status=$_POST['trade_status'];
    $order_number=$_POST['out_trade_no'];
    $value=['status'=>1];
    switch($status){
        case 'TRADE_SUCCESS':
            $value['status']=2;
            $value['pay_platform_id']=$_POST['trade_no'];
            break;
        default:

            break;
    }
    pdoUpdate('order_tbl',$value,['order_num'=>$order_number],' limit 1');
}


exit;