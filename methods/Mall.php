<?php

class Mall
{
    private $userId;

    public function __construct()
    {
        $this->userId = API::userVerify();
    }


    public function areaList($data=null){
        $areaData=json_decode(file_get_contents($GLOBALS['mypath'].'/includes/area.json'),true);
        echoBack($areaData);
    }

    public function goodsList($data){
        $domain=PRO.$_SERVER['SERVER_NAME'].DOMAIN.'/files/';
        $list=[];
        $query=pdoQuery('goods_tbl',['goods_id','goods_sn','goods_name','goods_image','goods_status','goods_price',],['goods_status'=>1],null);
        $query->setFetchMode(PDO::FETCH_ASSOC);
        foreach ($query as $row) {
            $row['goods_image']=$domain.$row['goods_image'];
            $list[]=$row;
        }
        echoBack(['hasMore'=>false,'list'=>$list]);

    }
    public function address(){
        $query=pdoQuery('address_tbl',null,['user'=>$this->userId],'limit 1')->fetch();
        if($query){
            $addressInf=['name'=>$query['name'],'phone'=>$query['phone'],'province'=>$query['province'],'city'=>$query['city'],'area'=>$query['area'],'address'=>$query['address'],'full_address'=>$query['province'].$query['city'].$query['area'].$query['address']];
            echoBack($addressInf);
        }else{
            echoBack(null,1,'请先填写收货地址');
        }
    }
    public function updateAddress($data){
        $value=[];
        unset($data['user_session']);
        foreach ($data as $k => $v) {
            $value[$k]=addslashes($v);
        }
        $value['user']=$this->userId;
        mylog($value);
        pdoInsert('address_tbl',$value,'update');
        echoBack("更新成功");
    }
    public function createOrder($data){
        $goodsInf=$data['pre_order'];
        $address=$data['address'];
        $payMode=$data['pay_mode'];
        $totalPrice=0;
        $detail=[];
        foreach ($goodsInf as $row) {
            $detail[]=['id'=>$row['goods_id'],'sn'=>$row['goods_sn'],'name'=>$row['goods_name'],'number'=>$row['number'],'img'=>$row['goods_image'],'price'=>$row['goods_price']];
            $totalPrice+=$row['goods_price']*$row['number'];
        }
        $detail=addslashes(json_encode($detail));
        $orderNumber=$this->orderNumberCreator();
        try{
            pdoDelete('order_tbl',['user'=>$this->userId,'status'=>1],' and create_time_unix<'.(time()-1800));
            $id=pdoInsert('order_tbl',['order_num'=>$orderNumber,'user'=>$this->userId,'detail'=>$detail,'address'=>$address,'total_fee'=>$totalPrice,'create_time_unix'=>time(),'pay_platform'=>$payMode],'ignore');
            echoBack(['pay_mode'=>$payMode,'order_id'=>$id]);
        }catch(PDOException $e){
            mylog($e->getMessage());
            echoBack(null,8,'数据库错误');
        }
    }
    public function goodsDetail($data){
        $goodsId=$data['goods_id'];
        $inf=pdoQuery('goods_tbl',['goods_detail'],['goods_id'=>$goodsId],'limit 1')->fetch();
        if($inf){
            echoBack($inf['goods_detail']);
        }else{
            echoBack(null,12,'id无效');
        }
    }
    public function orderList($data){
        $where=['user'=>$this->userId];
        $where['status']=isset($data['status'])?$data['status']:[1,2,3];
        $query=pdoQuery('order_tbl',null,$where,' limit 20');
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $list=[];
        foreach ($query as $row) {
            $temp['goods_detail']=json_decode($row['goods_detail'],true);
            $list[]=['order_id'=>$row['order_id'],'order_num'=>$row['order_num'],'user'=>$row['user'],'detail'=>json_decode($row['detail'],true),'address'=>$row['address'],'total_fee'=>$row['total_fee'],
            'status'=>$row['status']];
        }
        echoBack(['hasMore'=>false,'list'=>$list]);
    }


    public function alipayCreate($data){
        $orderId=$data['order_id'];
        $orderInf=pdoQuery('order_tbl',null,['user'=>$this->userId,'order_id'=>$orderId],'limit 1')->fetch();
        if($orderInf){
            $privateKey=file_get_contents($GLOBALS['mypath'].'/libs/ali_pay/privateKey.cfg');
            $publicKey=file_get_contents($GLOBALS['mypath'].'/libs/ali_pay/publicKey.cfg');
            $orderNumber=$orderInf['order_num'];
            $totalPrice=$orderInf['total_fee'];
            include_once $GLOBALS['mypath'].'/libs/ali_pay/AopSdk.php';
            $aop=new AopClient;
            $aop->gatewayUrl=ALI_PAY_GATEWAY;
            $aop->appId=ALI_PAY_APP_ID;
            $aop->rsaPrivateKey=$privateKey;
            $aop->format="json";
            $aop->charset = "UTF-8";
            $aop->signType = "RSA2";
            $aop->alipayrsaPublicKey = $publicKey;
            $request = new AlipayTradeAppPayRequest();//SDK已经封装掉了公共参数，这里只需要传入业务参数
            $bizcontent = "{\"body\":\"宝工商城购物订单\","
                . "\"subject\": \"宝工商城订单\","
                . "\"out_trade_no\": \"$orderNumber\","
                . "\"timeout_express\": \"30m\","
                . "\"total_amount\": \"$totalPrice\","
                . "\"product_code\":\"QUICK_MSECURITY_PAY\""
                . "}";
            $request->setNotifyUrl(PRO.$_SERVER['SERVER_NAME'].DOMAIN.'/AliNotify.php');
            $request->setBizContent($bizcontent);//这里和普通的接口调用不同，使用的是sdkExecute
            $response = $aop->sdkExecute($request);//htmlspecialchars是为了输出到页面时防止被浏览器将关键参数html转义，实际打印到日志以及http传输不会有这个问题
            echoBack($response);//就是orderString 可以直接给客户端请求，无需再做处理。
        }



//        $aop->gatewayUrl=

    }

    private function orderNumberCreator(){
        $timeStamp=time();
        return 'bg'.$timeStamp.rand(1000,9999);
    }


}