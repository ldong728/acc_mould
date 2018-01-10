<?php
include_once 'includePackage.php';
session_start();
$url=isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:$_SERVER['QUERY_STRING'];
$query_string = explode('/',$url);
//mylog($query_string);
//mylog($_FILES);
if(count($query_string)>2){
    $postData = json_decode(file_get_contents('php://input'), true);
    $postData=!$postData?$_POST:$postData;
    $param=isset($query_string['3'])?$query_string['3']:$postData;
    $param=$param?$param:false;
    $controllerName=$query_string[1];
    include_once 'controller/'.$controllerName.'.php';
    if(class_exists($controllerName)){
        $controller=new $controllerName();
        $methodName=$query_string[2];
        if(method_exists($controller,$methodName)){
            $controller->$methodName($param);
        }else{
            echoBack(null,403,'禁止访问，未定义的控制器');
        }

    }else{
        echoBack(null,403,'禁止访问，未定义的方法');
    }
}else{
    echoBack(null,403,'禁止访问，格式不正确');
}
