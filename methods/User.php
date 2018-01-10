<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/13
 * Time: 14:44
 */
class User
{
    public function __construct()
    {

    }

    public function regist($data)
    {
        $tel = $data['user_tel'];
        $password = $data['user_password'];
        $code = $data['code'];
//        $deviceToken = $data['device_token'];
        $userType=$data['user_type'];
        $query = pdoQuery('user_tbl', ['user_id'], ['tel' => $tel], 'limit 1')->fetch();
        if (!$query) {
            $codeQuery=pdoQuery('user_code_tbl',null,['tel'=>$tel,'code'=>$code],'limit 1')->fetch();
            if($codeQuery){
                if(time()>$codeQuery['create_time']+(1800)){
                    echoBack(null,103,'验证码已过期');
                }else{
                    $userSession = getRandStr(20);
                    $id = pdoInsert('user_tbl', ['user_tel' => addslashes($tel), 'user_password' => sha1($password),'user_type'=>$userType,'user_level'=>1],'ignore');
                    if ($id) {
                        $_SESSION['user']=['user_id'=>$id,'user_tel' =>$tel,'user_type'=>$userType,'user_level'=>1];

                        echoBack('ok');
                    } else {
                        echoBack(null, 106, '数据库错误');
                    }
                }
            }else{
                echoBack(null,123,'验证码错误');
            }

        } else {
            echoBack(null, 104, '用户已注册');
        }

    }

    public function login($data)
    {
        $filter = ['tel' => $data['user_tel'], 'password' => $data['user_password']];
        $query = pdoQuery('user_tbl',['user_id','user_tel','user_type','user_level'], $filter, 'limit 1');
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query=$query->fetch();
        if ($query) {
            $_SESSION['user']=$query;

//            $userSession = getRandStr(20);
//            pdoUpdate('user_tbl', ['user_session' => $userSession, 'session_creating_time' => time(), 'device_token' => $deviceToken], ['user_id' => $query['user_id']], ' limit 1');
//            echoBack(null, 0, '登陆成功', $userSession);
        } else {
            echoBack(null, 403, '登录失败');
        }

    }

    public function info_modify($data)
    {
        $userId = API::userVerify();
        if (isset($data['password_old'])) {
            $query = pdoQuery('user_tbl', null, ['user_id' => $userId], 'limit 1')->fetch();
            if ($data['password_old'] == $query['password']) {
                pdoUpdate('user_tbl', ['password' => $data['password_new']], ['tbl_id' => $userId], 'limit 1');
                echoBack();
            }
        } else {
            echoBack();
        }

    }
    public function code($data){
//        mylog(json_encode($data));
        $phoneNumber=$data['account'];
        $userInf=pdoQuery('user_tbl',['user_id'],['tel'=>$phoneNumber],'limit 1')->fetch();
        $needNewCode=false;
        if(!$userInf){
            $code=pdoQuery('user_code_tbl',null,['tel'=>$phoneNumber],'limit 1')->fetch();
            if($code){
                    if(($code['create_time']+60)>time())echoBack(null,107,'请勿重复获取');
                    else $needNewCode=true;
            }else{
                $needNewCode=true;
            }
        }else{
            echoBack(null,106,'用户已注册');
        }
        if($needNewCode){
            include_once $GLOBALS['mypach'].'/tools/VerifySms.php';
            $code=(string)rand(100000,999999);
            pdoInsert('user_code_tbl',['tel'=>$phoneNumber,'code'=>$code,'create_time'=>time()],'update');
//            echoBack('hahahaha');
            $smsSender=new VerifySms();
            $back=$smsSender->sendCode($phoneNumber,$code);
            if($back->isSucceed()){
                mylog('messageId: '.$back->getMessageId());
                echoBack(null,0,'验证码发送成功');
            }else{
                echoBack(null,100,'验证码发送失败，请稍后重试');
            }
        }
    }


} 