<?php

class ReceiverHandler {
    public $productId = '';
    public $PApiKey = '';
    public $token = '';
    public $encodekey = '';
    public function __construct($ProductID,$PApiKey){
        $this->productId=$ProductID;
        $this->PApiKey=$PApiKey;
        $this->token=TOKEN;
        $this->encodekey=ENCODE_KEY;
    }
    public function check(){
        echo "Product Id is: ".$this->productId;
        echo "Api Key is: ".$this->PApiKey;
        echo "Token is: ".$this->token;
        echo "Encode Key is: ".$this->encodekey;
    }


    /**********************************************
     * 检查签名
     * 检查消息摘要
     * Check the message digest
     **********************************************/
    protected function checkSignature($body, $token)
    {
        $new_sig = md5($token . $body['nonce'] . $body['msg']);
        $new_sig = rtrim(str_replace('+', ' ', base64_encode(pack('H*', strtoupper($new_sig)))),'=');
        if ($new_sig == rtrim($body['signature'],'=')) {
            return $body['msg'];
        } else {
            return FALSE;
        }
    }
    /**********************************************
     * 检查签名
     * 检查消息摘要，获取推送数据
     * Check the message digest and get the push data
     **********************************************/
    protected function handleRuleMsg($body, $token)
    {
        $new_sig = md5($token . $body['nonce'] . json_encode($body['msg']));
        $new_sig = rtrim(base64_encode(pack('H*', strtoupper($new_sig))),'=');
        // echo 'new_sig is: '.$new_sig.'<br>';
        if ($new_sig == rtrim($body['msg_signature'],'=')) {
            return $body['msg'];
        } else {
            return FALSE;
        }
    }
    /**********************************************
     * 解密消息
     * Decrypt the message
     * encodeKey为平台为用户生成的AES的BASE64编码格式秘钥
     * EncodeKey is the user-generated AES's BASE64 encoding format secret key
     **********************************************/
    protected function decryptMsg($body, $encodeKey)
    {
        $enc_msg = base64_decode($body);
        $aes_key = base64_decode($encodeKey . '=');
        $secure_key = substr($aes_key, 0, 32);
        $iv = substr($aes_key, 0, 16);
        $msg = openssl_decrypt($enc_msg, 'AES-256-CBC', $secure_key, OPENSSL_RAW_DATA, $iv);
        $pattern = '/.*(\{.*\})/';
        $msg = preg_replace($pattern, '${1}', $msg);
        return $msg;
    }
    /**********************************************
     * body为http请求的body部分
     * Body is the body part of the http request
     * 代码自动判断是否是加密消息以及是否是第一次验证签名
     * The code automatically determines whether the message is encrypted and whether it is the first time to verify the signature
     **********************************************/
    public function resolveBody($body)
    {
        // echo 'body is: '.$body.'<br>';
        $body = json_decode($body, TRUE);
        // echo 'body is: '.getArrayInf($body).'<br>';

        if (isset($body['enc_msg'])) {
            return $this->decryptMsg($body['enc_msg'], $this->$encodekey);
        } elseif (! isset($body['msg'])) {
            if (isset($_GET['msg']) && isset($_GET['signature']) && isset($_GET['nonce'])) {
                return $this->checkSignature($_GET, $this->token);
            } else {
                return NULL;
            }
        } else {
            return $this->handleRuleMsg($body, $this->token);
        }
    }
}