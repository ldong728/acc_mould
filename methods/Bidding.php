<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/02/26
 * Time: 10:59
 */

class Bidding {
//    private $userId;
    public function __construct(){
//        $this->userId=API::userVerify();
    }

    public function add_bidding($data){
        $companyId=API::companyVerify();
        $data['company']=$companyId;
        $data['end_time_unix']=time($data['end_time']);
        $data['start_time']=timeUnixToMysql(time());
        $data['start_time_unix']=time();
        mylog(getArrayInf($data));
        $id=pdoInsertTemp('bidding_tbl',$data);
        if($id)echoBack('ok');
        else echoBack(null,109,'数据库错误');
    }



}