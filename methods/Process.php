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

}