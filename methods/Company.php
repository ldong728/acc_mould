<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/14
 * Time: 13:53
 */

class Company {
//    private $userId;
    public function __construct(){
//        $this->userId=API::userVerify();
    }

    public function company_inf($data){
        $companyId=$data['company_id'];
        $query=pdoQuery('company_tbl',null,['company_id'=>$companyId],'limit 1');
        $query->setFetchMode(PDO::FETCH_ASSOC);
        echoBack($query->fetch());
    }


} 