<?php
//ini_set("display_errors", "on");

//require_once dirname(__DIR__) . '//vendor/autoload.php';
require_once $GLOBALS['mypath'] . '/libs/ali_mns_sdk/mns-autoloader.php';

use AliyunMNS\Client;
use AliyunMNS\Topic;
use AliyunMNS\Constants;
use AliyunMNS\Model\MailAttributes;
use AliyunMNS\Model\SmsAttributes;
use AliyunMNS\Model\BatchSmsAttributes;
use AliyunMNS\Model\MessageAttributes;
use AliyunMNS\Exception\MnsException;
use AliyunMNS\Requests\PublishMessageRequest;
// 加载区域结点配置
//Config::load();
class VerifySms{

    public static $accessKey='待填入';
    public static $keySecret='待填入';

    public static $signName='待填入';
    public static $templateCode='待填入';
    private $client;
    public function sendSms($phoneNumber,$code)
    {
        /**
         * Step 1. 初始化Client
         */
//        $this->endPoint = "http://10961015.mns.cn-hangzhou.aliyuncs.com/"; // eg. http://1234567890123456.mns.cn-shenzhen.aliyuncs.com
//        $this->accessId = VerifySms::$accessKey;
//        $this->accessKey = VerifySms::$keySecret;
        $this->client = new Client('http://10961015.mns.cn-hangzhou.aliyuncs.com',VerifySms::$accessKey, VerifySms::$keySecret);
        /**
         * Step 2. 获取主题引用
         */
        $topicName = "sms.topic-cn-hangzhou";
        $topic = $this->client->getTopicRef($topicName);
        /**
         * Step 3. 生成SMS消息属性
         */
        // 3.1 设置发送短信的签名（SMSSignName）和模板（SMSTemplateCode）
        $batchSmsAttributes = new BatchSmsAttributes(VerifySms::$signName, VerifySms::$templateCode);
        // 3.2 （如果在短信模板中定义了参数）指定短信模板中对应参数的值
        $batchSmsAttributes->addReceiver($phoneNumber, array("code" => $code));
//        $batchSmsAttributes->addReceiver("YourReceiverPhoneNumber2", array("YourSMSTemplateParamKey1" => "value1"));
        $messageAttributes = new MessageAttributes(array($batchSmsAttributes));
        /**
         * Step 4. 设置SMS消息体（必须）
         *
         * 注：目前暂时不支持消息内容为空，需要指定消息内容，不为空即可。
         */
        $messageBody = "smsmessage";
        /**
         * Step 5. 发布SMS消息
         */
        $request = new PublishMessageRequest($messageBody, $messageAttributes);
        try
        {
//            echo 'send ok';

            $res = $topic->publishMessage($request);
            mylog('send phone: '.$phoneNumber.' content:'.$code.' ok!'.$res->isSucceed());
//            echo $res->isSucceed();
//            echo "\n";
//            echo $res->getMessageId();
//            echo "\n";
            return $res;
        }
        catch (MnsException $e)
        {
//            echo 'error';
//            echo $e;
//            echo "\n";
            return $e->getMessage();
        }
    }



    public function sendCode($phoneNumber,$code){
            return $this->sendSms($phoneNumber,$code);
    }

//    public function sendValue(){
//        echo $this->myValue;
//    }


}
