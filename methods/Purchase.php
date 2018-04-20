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


        echoBack('ok');
    }

}