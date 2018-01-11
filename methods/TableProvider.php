<?php

class TableProvider
{
    private $userId;

    public function __construct()
    {
//        $this->userId = API::userVerify()['user_id'];
    }

    public function user_type($data){
        $back=$this->getList('user_type_tbl',null,null,$data);
        echoBack($back);
    }



     /**
     * 通用获取列表内容的方法，和前端TableController联合使用
     * @param $tableName
     * @param $countTableName
     * @param $data
     * @param bool $needCount
     * @return mixed
     */
    public function company_list($data){
        mylog($data);
        echoBack($this->getList('company_tbl',['company_name','major_business','img'],null,$data,false));
    }

    private function getList($tableName,$fields, $countTableName, $data,$needCount=true)
    {
        $number = isset($data['number'])?$data['number']:12;
        $orderby = isset($data['orderby'])&&$data['orderby']?$data['orderby']:'';
        $order = isset($data['order'])&&$data['order']?$data['order']:'';
        $start = $data['page'] * $number;
        $filter = $orderby&&$order?"order by $orderby $order":'';
        $limit = " limit $start,$number";
        $where = isset($data['where'])&&$data['where'] ? $data['where'] : null;
        $count=0;
        try{
            if($needCount&&$countTableName){
                $count = pdoQueryNew($countTableName, array('count(*) as count'), $where, $filter)->fetch()['count'];
            }
            $query = pdoQueryNew($tableName, $fields, $where, $filter . $limit);
        }catch(PDOException $e){
            mylog($e->getMessage());
            return null;
        }
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query = $query->fetchAll();
        $back['list'] = $query;
        $back['count'] = $count;
        $back['page'] = ceil($count / $number);
        return ($back);
    }
    private function addUserFilter($data){
        if(isset($data['where'])){
            if(is_array($data['where'])){
                $data['where']['user']=$this->userId;
            }else{
                $data['where']=['user'=>$this->userId];
            }
        }else{
            $data['where']=['user'=>$this->userId];
        }
        return $data;
    }




}