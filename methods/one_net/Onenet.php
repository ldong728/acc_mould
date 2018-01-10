<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/11
 * Time: 11:26
 */
class Onenet
{
    private $curl;

    public function __construct()
    {
        $this->initCurl();
    }

    public function setApiKey($apiKey, $method = false)
    {
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('api-key: '.$apiKey,'Content-Type: application/json'));
    }

    public function sendCommand($command, $deviceId, $apiKey)
    {
        $url='http://api.heclouds.com/cmds?device_id='.$deviceId.'&qos=1&timeout=100&type=0';
        $this->setApiKey($apiKey);
        $back=$this->post($url,$command);
//        $back=$this->temp($command,$deviceId,$apiKey);
//        mylog($back);
        return $back;
    }

    public function registerDevice($sn)
    {
        $url="http://api.heclouds.com/register_de?register_code=".P_CODE;
        $back= $this->post($url,"{\"sn\":\"$sn\",\"title\":\"$sn\"}");
        mylog($back);
        return $back;
    }
    public function getDeviceId($sn){
        return $this->registerDevice($sn);
    }
    public function getDeviceDetail($deviceID){
        $url="http://api.heclouds.com/devices/$deviceID";
        $this->setApiKey(P_API_KEY,'get');
        $back=$this->get($url);
        return $back;

    }
    public function check_command($uuid,$apiKey){
        $this->setApiKey($apiKey,'get');
        $url="http://api.heclouds.com/cmds/$uuid";
        $back=$this->get($url);
        return $back;
    }
    public function getDataStream($deviceID){
        $url="http://api.heclouds.com/devices/$deviceID/datastreams";
        $this->setApiKey(P_API_KEY);
        $back=$this->get($url);
        return $back;
    }
    private function initCurl()
    {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);
    }
    private function post($url,$data){
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl,CURLOPT_URL,$url);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        $back=curl_exec($this->curl);
//        mylog(curl_errno($this->curl));
        curl_close($this->curl);
        return $back;
    }
    private function get($url){
        curl_setopt($this->curl,CURLOPT_URL,$url);
//        mylog($this->curl);
        $back=curl_exec($this->curl);
//        mylog($back);
        curl_close($this->curl);
        return $back;
    }
//    private function temp($data,$deviceId,$apiKey){
//        $str=$data;
//        $ch=curl_init();
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array('api-key: '.$apiKey,'Content-Type: application/json'));
//        curl_setopt($ch, CURLOPT_POST, true);
//        curl_setopt($ch, CURLOPT_URL, 'http://api.heclouds.com/cmds?device_id='.$deviceId.'&qos=1&timeout=100&type=0');
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $str);
//        $data = curl_exec($ch);
//        curl_close($ch);
//        return $data;
//    }


} 