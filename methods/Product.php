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

} 