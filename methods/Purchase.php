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

}