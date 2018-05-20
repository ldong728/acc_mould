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

    public function product_index_list(){
        $categoryList=[];
        $backData=[];
        $categoryQuery=pdoQueryNew('category_tbl',null,null,' order by category_id asc');
        $categoryQuery->setFetchMode(PDO::FETCH_ASSOC);
        foreach ($categoryQuery as $row) {
            if(0==$row['p_category']){
                $categoryList[$row['category_id']]=['category_id'=>$row['category_id'],'category_name'=>$row['category_name'],'unit_name'=>$row['unit_name'],'img'=>$row['img'],'sub_category'=>[$row['category_id']]];
            }else{
                $categoryList[$row['p_category']]['sub_category'][]=$row['category_id'];
            }
        }
        foreach ($categoryList as $id=>$row) {
            $productQuery=pdoQueryNew('product_tbl',['product_id','product_name','img','product_attr'],['category'=>$row['sub_category']],'order by priority desc limit 5');
            $productQuery->setFetchMode(PDO::FETCH_ASSOC);
            $backData[$id]=$row;
            $backData[$id]['products']=$productQuery->fetchAll();
        }
        $this->echoBackNormalData($backData);


    }

    public function company_list($data){
//        mylog($data);
        echoBack($this->getList('company_tbl',['company_id','company_name','major_business','img'],null,$data,false));
    }

    public function product_list($data){
        $back=$this->getList('product_detail_view',null,'product_tbl',$data,true);
        echoBack($back);
    }
    public function own_product_list($data){
//        $userId=API::userVerify();
        $companyId=API::companyVerify();
        $data['where']['company']=$companyId;
        $back=$this->getList('product_detail_view',null,'product_tbl',$data,false);
        echoBack($back);
    }
    public function own_process_need($data){
        $companyId=API::companyVerify();
        $data['where']['company']=$companyId;
        $back=$this->getList('process_need_list_view',null,'process_need_tbl',$data,false);
        echoBack($back);
    }
    public function process_need_list_index($data){
        $data['where']['status']=[2,3];
//        if($data['where']['end_time']
        $back=$this->getList('process_need_index_view',null,'process_need_tbl',$data,false);
        echoBack($back);
    }
    public function process_need_list($data){
        $data['where']['status']=[2,3];
        $back=$this->getList('process_need_list_view',null,'process_need_tbl',$data);
        echoBack($back);
    }
    public function purchase_list($data){
        $back=$this->getList('purchase_tbl',null,'purchase_tbl',$data);
        echoBack($back);
    }

    public function bidding_list_index($data){
        $back=$this->getList('bidding_index_view',null,null,$data,false);
        echoBack($back);
    }
    public function bidding_list($data){
        $back=$this->getList('bidding_list_view',null,null,$data,false);
        echoBack($back);
    }
    public function bidding_inquiry_list($data){
        $back=$this->getList('bidding_inquiry_list_view',null,null,$data,false);
        echoBack($back);
    }
    public function cart_detail_list_buyer($data){
        $back=$this->getList('cart_detail_buy_view',null,null,$data,false);
        echoBack($back);
    }
    public function cart_detail_list_admin($data){
        $companyId=API::companyVerify();
        $data['where']['company_id']=$companyId;
        $back=$this->getList('cart_detail_admin_view',null,null,$data,false);
        echoBack($back);
    }
    public function cart_detail_list_seller($data){
        $companyId=API::companyVerify();
        $data['where']['seller_company']=$companyId;
        $back=$this->getList('cart_detail_admin_view',null,null,$data,false);
        echoBack($back);
    }

//    private function

    private function echoBackNormalData($data){
        echoBack(['count'=>0,'page'=>0,'list'=>$data]);
    }

     /**
     * 通用获取列表内容的方法，和前端TableController联合使用
     * @param $tableName
     * @param $countTableName
     * @param $data
     * @param bool $needCount
     * @return mixed
     */
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