<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/14
 * Time: 13:53
 */

class Product {
//    private $userId;
    public function __construct(){
//        $this->userId=API::userVerify();
    }

    public function category_list(){
        $query=pdoQuery('category_tbl',null,null,null);
        $query->setFetchMode(PDO::FETCH_ASSOC);
        echoBack($query->fetchAll());
//        echoBack(pdoQuery(''))
    }
    public function own_category_list(){
        $companyId=API::companyVerify();
        $categoryList=pdoQueryNew('company_category_tbl',['category'],['company'=>$companyId],null);
//        $cateogoryList->setFetchMode(PDO::FETCH_ASSOC);
        $where=[];
        foreach ($categoryList as $row) {
            $where['category_id'][]=$row['category'];
        }
//        $where=$categoryList?['category_id'=>$categoryList]:null;
        $categoryQuery=pdoQueryNew('category_tbl',null,$where,null)->fetchAll();
        echoBack($categoryQuery);
    }

    public function detail($data){
        $productId=$data['product_id'];
        $product=pdoQuery('product_detail_view',null,['product_id'=>$productId],'limit 1');
        $product->setFetchMode(PDO::FETCH_ASSOC);
        $product=$product->fetch();
        $categoryQuery=pdoQuery('category_attr_tbl',null,['category'=>$product['category']],null);
        $categoryQuery->setFetchMode(PDO::FETCH_ASSOC);
        $categoryAttr=[];
        foreach ($categoryQuery as $row) {
            $categoryAttr[$row['category_attr_id']]=$row;
        }

        echoBack(['detail'=>$product,'attrs'=>$categoryAttr]);

    }
    function category_attr_list($data)
    {
        $category = $data['category_id'];
        $back = pdoQuery('category_attr_tbl', null, ['category' => $category], null);
        $back->setFetchMode(PDO::FETCH_ASSOC);
        echoBack($back->fetchAll());

    }
    function get_product($data){
        $companyId=API::companyVerify();
        $id=(int)$data['id'];
        $query=pdoQuery('product_tbl',null,['product_id'=>$id,'company'=>$companyId],'limit 1')->fetch(PDO::FETCH_ASSOC);
        echoBack($query);
    }
    function add_product($data){
        $userId=API::userVerify();
        $companyId=API::companyVerify();
        $data['img'] = isset($data['img'])? json_encode($data['img']):null;
        $data['product_attr'] =isset($data['product_attr'])? json_encode($data['product_attr']):null;
        $data['company']=$companyId;
        $data['user']=$userId;
        try {
            pdoInsert('product_tbl', $data, 'update');
        } catch (PDOException $e) {
            mylog($e->getMessage());

        }
        echoBack('ok');
//        mylog($data);
    }
    function delete_product($data){
        $company=API::companyVerify();
        $id=$data['id'];
        pdoDelete('product_tbl',['product_id'=>$id,'company'=>$company],'limit 1');
        echoBack('ok');
    }

} 