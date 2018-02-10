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
        if(!$data){

            $id=API::userVerify();
            $data['user']=$id;

        }
        if(count($data)>0){
            try{
                $query=pdoQuery('company_tbl',null,$data,'limit 1');
//                $query->setFetchMode(PDO::FETCH_ASSOC);
                $inf=$query->fetch(PDO::FETCH_ASSOC);
                if($inf){
                    echoBack($inf);
                    return;
                }else{
                    echoBack(null,120,'无数据');
                    return;
                }
            }catch(PDOException $e){
                echoBack(null,131,'数据库错误');
                return;
            }
        }
        echoBAck(null,121,'缺乏参数');
    }

    public function update_company_inf($data){
        $user=API::userVerify();
        $data['user']=$user;
        pdoInsert('company_tbl',$data,'update');
        if(!isset($_SESSION['user']['company'])){
            $companyInf=pdoQuery('company_tbl',null,['user'=>$user],'limit 1')->fetch(PDO::FETCH_ASSOC);
            if($companyInf)$_SESSION['user']['company']=$companyInf;
            echoBack('ok');
        }
        echoBack('ok');

    }
//    public function company_profile


} 