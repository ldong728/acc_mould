<?php
define('DEBUG',true);
//$province=null;
//$city=null;
//$area=null;

function html($text)
{
	return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function htmlout($text)
{
	echo html($text);
}

function output($string){
    header("Content-Type:text/html; charset=utf-8");
    echo '<p class = "warning">'. $string.'</p>';

}
function formatOutput($string){
//    $str=html($string);
    $str=preg_replace('/___/','<input type="text"/>',$string);
    return $str;

}

function printInf($p){
    echo '<br/>'.'{';
    foreach ($p as $k=>$v) {
       echo $k.':  ';
        if(is_array($v)){
            printInf($v);
        }else{
            echo $v.',';
        }

    }
    echo '}';
}

//debug

function getArrayInf($array){
    $s='{';
    foreach ($array as $k=>$v) {
        $s.=$k.': ';
        if(is_array($v)){
            $s=$s.getArrayInf($v);
        }else{
            $s.=$v.',';
        }
    }
    $s=trim($s,',');
    return $s.'}';

}


function mylog($str='mark'){
    if(DEBUG) {
        if(is_array($str)){
            $strFormated="is array: ".getArrayInf($str);
        }else{
            $strFormated=$str;
        }
        $debugInfo=debug_backtrace();
        $message = $debugInfo[0]['file'].$debugInfo[0]['line'];
        $log = date('Y.m.d.H:i:s', time()) . ':'.$message.':' . $strFormated . "\n";
        file_put_contents('log.txt', $log, FILE_APPEND);
    }
}
function ajaxBack($data=null,$errcode=0,$errmsg='ok'){
    $back=array('errcode'=>$errcode,'errmsg'=>$errmsg);
    if($data)$back['data']=$data;
//    mylog(json_encode($back,JSON_UNESCAPED_UNICODE));
    return json_encode($back,JSON_UNESCAPED_UNICODE);
}

function echoBack($data=null,$errcode=0,$errmsg='ok',$userSession=false){

    $back=array('success'=>!((bool)$errcode),'error_code'=>$errcode,'message'=>$errmsg);
    if($userSession)$back['user_session']=$userSession;
    if(isset($_GET['callback']))$back['callback']=$_GET['callback'];
    if($data)$back['data']=$data;
    echo json_encode($back,JSON_UNESCAPED_UNICODE);
    return;
}

//mysql格式转换
function timeUnixToMysql($time){
    if($time){
        return date('Y-m-d H:i:s', $time);
    }else{
        return '';
    }


}

function timeMysqlToUnix($time){
    return strtotime($time);
}



/**随机字符串生成器
 * @param int $length
 * @return string
 */
function getRandStr($length = 16)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
        $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
}

