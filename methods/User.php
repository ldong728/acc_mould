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
//        $type=$data['type'];
//        $deviceToken = $data['device_token'];
        $userType=isset($data['type'])?$data['type']:"无";
        $query = pdoQuery('user_tbl', ['user_id'], ['user_tel' => $tel], 'limit 1')->fetch();
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
        $verify=strtolower($data['verify']);
        if($verify!=$_SESSION['rand']){
            echoBack(null, 403, '验证码错误');
            return;
        }
        $filter = ['user_tel' => $data['user_tel'], 'user_password' => sha1($data['user_password'])];
        $query = pdoQuery('user_tbl',['user_id','user_tel','user_type','user_level'], $filter, 'limit 1');
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query=$query->fetch();
        if ($query) {
            $_SESSION['user']=$query;
            $companyQuery=pdoQuery('company_tbl',['company_id','company_name'],['user'=>$query['user_id']],'limit 1');
            $companyQuery->setFetchMode(PDO::FETCH_ASSOC);
            $companyQuery=$companyQuery->fetch();
            if($companyQuery)$_SESSION['user']['company']=$companyQuery;
            echoBack('ok');
        } else {
            echoBack(null, 403, '登录失败');
        }
    }

    public function get_company_inf(){
        $inf=API::companyVerify();
        echoBack($inf);
    }
    public function get_company_detail(){
        $companyId=API::companyVerify();
        $inf=pdoQuery('company_tbl',null,['company_id'=>$companyId],'limit 1')->fetch(PDO::FETCH_ASSOC);
        echoBack($inf);
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
        $userInf=pdoQuery('user_tbl',['user_id'],['user_tel'=>$phoneNumber],'limit 1')->fetch();
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
            include_once $GLOBALS['mypath'].'/methods/VerifySms.php';
            $code=(string)rand(100000,999999);
            pdoInsert('user_code_tbl',['tel'=>$phoneNumber,'code'=>$code,'create_time'=>time()],'update');
//            echoBack('hahahaha');
            $smsSender=new VerifySms();
            $back=$smsSender->sendCode($phoneNumber,$code);

//            mylog($back);
            echoBack(null,0,'验证码发送成功');
            return;
            if($back->isSucceed()){
                mylog('messageId: '.$back->getMessageId());
                echoBack(null,0,'验证码发送成功');
            }else{
                echoBack(null,100,'验证码发送失败，请稍后重试');
            }
        }
    }
    public function get_regist_request_inf(){
        $userID=API::userVerify();
        $companyId=API::companyVerify();
        $registInf=pdoQuery('regist_request_tbl',['regist_request_id'],['company'=>$companyId],'limit 1')->fetch();
        if($registInf){
            echoBack(null,120,'申请内容正在审核中');
        }else{
            echoBack(['user_tel'=>$_SESSION['user']['user_tel'],'company_name'=>$_SESSION['user']['company']['company_name']]);
        }

    }
    public function add_regist_request($data){
        $companyId=API::companyVerify();
        $data['company']=$companyId;
        $id=pdoInsert('regist_request_tbl',$data,'update');
        if($id){
            echoBack("OK");
        }else{
            echoBack(null,109,"数据库错误");
        }
    }
    public function level_verify($data){
        API::userVerify();
        API::companyVerify();
        $level=$data['level'];
        $currentLevel=$_SESSION['user']['user_level'];
        if($currentLevel>=$level){
            echoBack('ok');
        }else{
            echoBack(null,130,'权限不足');
        }

    }
    public function sign_out(){
        session_unset();
        echoBack('ok');
    }


} 