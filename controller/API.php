<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/9
 * Time: 14:00
 */

class API {
    public static $userSession=false;
    public function __construct(){
//       $this->getSessionFromClint();
//        API::
    }
    public function display(){
        mylog('display');
        echo "hahahahahah";
        echo $this->innerValue;
    }
    public function User($methodType){
        include_once $GLOBALS['mypath'] . '/includes/db.inc.php';
        include_once $GLOBALS['mypath'] . '/methods/User.php';
        global $postData;
        $user=new User();
        $user->$methodType($postData);

    }
    public function Product($methodType){
        include_once $GLOBALS['mypath'] . '/includes/db.inc.php';
        include_once $GLOBALS['mypath'] . '/methods/Product.php';
        global $postData;
        $product=new Product();
        $product->$methodType($postData);
    }
    public function Company($methodType){
        include_once $GLOBALS['mypath'] . '/includes/db.inc.php';
        include_once $GLOBALS['mypath'] . '/methods/Company.php';
        global $postData;
        $company=new Company();
//        $user=new User();
        $company->$methodType($postData);
    }
    public function Mall($methodType){
        include_once $GLOBALS['mypath'] . '/includes/db.inc.php';
        include_once $GLOBALS['mypath'] . '/methods/Mall.php';
        global $postData;
        $mall=new Mall();
//        $user=new User();
        $mall->$methodType($postData);
    }
    public function TableProvider($methodType){
        include_once $GLOBALS['mypath'] . '/includes/db.inc.php';
        include_once $GLOBALS['mypath'] . '/methods/TableProvider.php';
        global $postData;
        $tableProvider=new TableProvider();
//        $user=new User();
        $tableProvider->$methodType($postData);
    }
    public function Upload($methodType){
        include_once $GLOBALS['mypath'] . '/includes/db.inc.php';
        include_once $GLOBALS['mypath'] . '/methods/Upload.php';
        $upload=new Upload($methodType);
    }

    public static function userVerify(){
        if(isset($_SESSION['user'])){
            return $_SESSION['user']['user_level'];
        }else{
            echoBack(null,101,'用户未登录');
            exit;
        }

    }
    private function getSessionFromClint(){
        global $postData;
        if(isset($_GET['user_session'])&&$_GET['user_session']){
            API::$userSession=$_GET['user_session'];
        }else if(isset($postData['user_session'])&&$postData['user_session']){
            API::$userSession=$postData['user_session'];
        }
    }
    
    
    
    
    
    public function tempSend(){
        $str='C133';
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://api.heclouds.com/cmds?device_id=19939302&qos=1&timeout=100&type=0');
//        curl_setopt($ch, CURLOPT_URL, 'http://localhost/temp/?device_id=17501226&qos=0&timeout=300&type=1');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $str);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('api-key: dYK9iASm6g5U6gnqtFrtoU=0mwU=','Content-Type: application/json'));
        $data = curl_exec($ch);
        curl_close($ch);
//        mylog($data);
        echo $data;
        $dataArray=json_decode($data,true);
        if('succ'==$dataArray['error']){
            $this->test($dataArray['data']['cmd_uuid']);
        }
    }
    public function test($uuid){
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://api.heclouds.com/cmds/'.$uuid);
//        mylog('http://api.heclouds.com/cmds/'.$uuid);
//        curl_setopt($ch, CURLOPT_URL, 'http://localhost/temp/?device_id=17501226&qos=0&timeout=300&type=1');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 500);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('api-key: '.P_API_KEY,'Content-Type: application/x-www-form-urlencoded'));
        $data = curl_exec($ch);
        curl_close($ch);
//        mylog($data);
        echo $data;
    }
    public function pushTest($deviceId){
        include_once $GLOBALS['mypath'] . '/includes/db.inc.php';
            include_once $GLOBALS['mypath'] . '/methods/push/PushSender.php';
            $userInf = pdoQuery('user_tbl', null, null, ' where user_id=(select user from device_tbl where d_id="' . $deviceId . '") limit 1')->fetch();
            echo($userInf['device_token']);
            $pushSender = new PushSender($userInf['device_token']);
            $back = $pushSender->sendUniCast('宝工电器', '状态警报', "设备故障");
            echo($back);
//            return $back;
    }

    public function streamTest($id){
        include_once $GLOBALS['mypath'] . '/methods/one_net/Onenet.php';
        $one=new Onenet();
        echo $one->getDataStream($id);
    }
    public function smsTest($phone){
        include_once $GLOBALS['mypath'] . '/methods/VerifySms.php';
        $sms=new VerifySms();
        try{
            $back=$sms->sendCode($phone,'123456');
//            print($back->getHttpStatus());
            print(json_encode($back));
        }catch(Exception $e){
            print($e->getMessage());
            print($e->getTraceAsString());
        }
    }
    public function smsRequest(){
        mylog();
    }



} 