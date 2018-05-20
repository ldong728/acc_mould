<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/02/26
 * Time: 10:59
 */

class Purchase {
//    private $userId;
    public function __construct(){
//        $this->userId=API::userVerify();
    }

    public function add_purchase($data){
        $companyId=API::companyVerify();
        $data['company']=$companyId;
        $data['end_time_unix']=timeMysqlToUnix($data['end_time']);
        $data['start_time']=timeUnixToMysql(time());
        $data['start_time_unix']=time();
        $id=pdoInsert('purchase_tbl',$data,'ignore');
        if($id)echoBack('ok');
        else echoBack(null,109,'数据库错误');
    }

    public function purchase_detail($data){
        $id=$data['id'];
        $companyId=API::companyVerify();
        exeNew("update bidding_inquiry_tbl set look_count=look_count+1 where bidding_inquiry_id=$id limit 1");
        $record=pdoQuery('tender_tbl',null,['bidding_inquiry'=>$id,'company'=>$companyId],'limit 1')->fetch(PDO::FETCH_ASSOC);
        $tenders=pdoQuery('tender_inquiry_view',null,['bidding_inquiry'=>$id],'limit 5')->fetchAll(PDO::FETCH_ASSOC);
        $companyInf=pdoQuery('company_tbl',null,['company_id'=>$companyId],'limit 1')->fetch(PDO::FETCH_ASSOC);
        $processInf=pdoQuery('bidding_inquiry_list_view',null,['bidding_inquiry_id'=>$id],'limit 1')->fetch(PDO::FETCH_ASSOC);
        echoBack(['record'=>$record,'biddingInf'=>$processInf,'companyInf'=>$companyInf,'tenders'=>$tenders]);
    }

    public function add_cart($data){
        $userId=API::userVerify();
        $data['user']=$userId;
        $data['order_id']=time().rand(0,9999);
        $data['product_attr']=json_encode($data['product_attr']);
        $id=pdoInsert('cart_detail_tbl',$data);
        if($id){
            echoBack('ok');
        }else{
            echoBack(null,9,'数据库错误');
        }
    }
    public function cart_count($data){
        $userId=API::userVerify();
        $number=pdoQuery('cart_detail_tbl',['count(*) as number'],['user'=>$userId,'status'=>1],null)->fetch();
        $count=$number?$number['number']:0;
        echoBack($count);
    }
    public function delete_cart($data){
        $userId=API::userVerify();
        $cartDetailId=$data['id'];
        if(is_array($cartDetailId)){
            foreach ($cartDetailId as $singleId) {
                pdoDelete('cart_detail_tbl',['user'=>$userId,'cart_detail_id'=>$singleId,'status'=>1]);
            }

        }else{
            pdoDelete('cart_detail_tbl',['user'=>$userId,'cart_detail_id'=>$cartDetailId,'status'=>1]);

        }
        echoBack('ok');
    }
    public function pre_order($data){
        $userId=API::userVerify();
        pdoUpdate('cart_detail_tbl',['user'=>$userId,'status'=>2],['cart_detail_id'=>$data['id'],'status'=>1]);
        echoBack('ok');
    }
    public function set_order($data){
        $userId=API::userVerify();
        $payType=$data['pay_type'];
        $remark=$data['remark'];
        pdoUpdate('cart_detail_tbl',['user'=>$userId,'status'=>4,'pay_type'=>$payType,'buyer_remark'=>$remark],['cart_detail_id'=>$data['id'],'status'=>[2,3]]);
        echoBack('ok');
    }
    public function shipping_confirm($data){
        $cartDetailId=$data['id'];
        $companyId=API::companyVerify();
        $cartInf=pdoQuery('cart_detail_admin_view',['cart_detail_id'],['cart_detail_id'=>$cartDetailId,'seller_company'=>$companyId],' limit 1')->fetch();
        if($cartInf){
            $value=['status'=>6,'shipping_order'=>$data['shipping_order']];
            if($data['shipping_type'])$value['shipping_type']=$data['shipping_type'];
            pdoUpdate('cart_detail_tbl',$value,['cart_detail_id'=>$cartDetailId]);
            echoBack('ok');
        }else{
            echoBack(null,123,'数据错误');
        }
    }
    public function cart_detail_seller($data){
        $companyId=API::companyVerify();
        $id=$data['id'];
        $inf=pdoQuery('cart_detail_admin_view',null,['seller_company'=>$companyId,'cart_detail_id'=>$id],' limit 1')->fetch(PDO::FETCH_ASSOC);
        if($inf){
            echoBack($inf);
        }else{
            echoBack(null,123,'数据错误');
        }
    }

}