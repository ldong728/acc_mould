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
    public function process_need_detail($data){
        $id=$data['id'];
        $companyId=API::companyVerify();
        exeNew("update process_need_tbl set look_count=look_count+1 where process_need_id=$id limit 1");
        $record=pdoQuery('process_need_quote_tbl',null,['provider'=>$companyId,'process_need'=>$id],'limit 1')->fetch(PDO::FETCH_ASSOC);
        $processInf=pdoQuery('process_need_list_view',null,['process_need_id'=>$id],'limit 1')->fetch(PDO::FETCH_ASSOC);
        if($processInf['process_steps']){
            $value=trim($processInf['process_steps'],',');
            $value=explode(',',$value);
            $processInf['process_steps']=$value;
        }
        echoBack(['record'=>$record,'processInf'=>$processInf]);

    }
    public function add_process_need_quote($data){
        $companyId=API::companyVerify();
        $data['provider']=$companyId;
        $data['create_time']=timeUnixToMysql(time());
        $data['create_time_unix']=time();
        $id=pdoInsert('process_need_quote_tbl',$data,'ignore');
        if($id)echoBack('ok');
        else echoBack(null,109,'数据库错误');
    }

}