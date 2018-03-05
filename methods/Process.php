<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/02/26
 * Time: 10:59
 */

class Process {
//    private $userId;
    public function __construct(){
//        $this->userId=API::userVerify();
    }

    public function get_process_step(){
        $back=pdoQuery('process_step_tbl',null,null,null)->fetchAll(PDO::FETCH_ASSOC);
        echoBack($back);
    }
    public function add_process_need($data){
        mylog($data);
        $companyId=API::companyVerify();
        $data['company']=$companyId;
        $data['end_time_unix']=timeMysqlToUnix($data['end_time']);
        $data['start_time']=timeUnixToMysql(time());
        $data['start_time_unix']=time();
        $data['process_steps']=trim($data['process_steps'],',');
        mylog($data);
        $id=pdoInsert('process_need_tbl',$data,'ignore');
        if($id)echoBack('ok');
        else echoBack(null,109,'数据库错误');
    }

}