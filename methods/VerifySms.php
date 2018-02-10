<?php
//ini_set("display_errors", "on");

//require_once dirname(__DIR__) . '//vendor/autoload.php';
require_once $GLOBALS['mypath'] . '/libs/ali_msg_api/vendor/autoload.php';


use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\SendBatchSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\QuerySendDetailsRequest;

// 加载区域结点配置
Config::load();
class VerifySms{

    public static $accessKey='LTAIR93Mh9svraqQ';
    public static $keySecret='6rGGuTezxkbeTMXbt8nXU8VMX85NTO';

    public static $signName='注册验证';
    public static $templateCode='SMS_66825161';
    static $acsClient;

    public static function getAcsClient() {
        //产品名称:云通信流量服务API产品,开发者无需替换
        $product = "Dysmsapi";

        //产品域名,开发者无需替换
        $domain = "dysmsapi.aliyuncs.com";

        // TODO 此处需要替换成开发者自己的AK (https://ak-console.aliyun.com/)
        $accessKeyId = static::$accessKey; // AccessKeyId

        $accessKeySecret = static::$keySecret; // AccessKeySecret

        // 暂时不支持多Region
        $region = "cn-hangzhou";

        // 服务结点
        $endPointName = "cn-hangzhou";


        if(static::$acsClient == null) {
            // 增加服务结点
            DefaultProfile::addEndpoint($endPointName, $region, $product, $domain);
            //初始化acsClient,暂不支持region化
            $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
            mylog('profile ok');
            // 初始化AcsClient用于发起请求
            static::$acsClient = new DefaultAcsClient($profile);
        }
        return static::$acsClient;
    }



    public function sendSms($phoneNumber,$code)
    {
        /**
         * Step 1. 初始化Client
         */
//        $this->endPoint = "http://10961015.mns.cn-hangzhou.aliyuncs.com/"; // eg. http://1234567890123456.mns.cn-shenzhen.aliyuncs.com
//        $this->accessId = VerifySms::$accessKey;
//        $this->accessKey = VerifySms::$keySecret;
//        static::$acsClient = new Client('http://10961015.mns.cn-hangzhou.aliyuncs.com',VerifySms::$accessKey, VerifySms::$keySecret);
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
        $batchSmsAttributes->addReceiver($phoneNumber, array("code" => (string)$code));
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
//            mylog($res->getMessageId());
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


    public function sendSmsNew($phoneNumber,$code){
        $request = new SendSmsRequest();

        // 必填，设置短信接收号码
        $request->setPhoneNumbers($phoneNumber);

        // 必填，设置签名名称，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $request->setSignName(static::$signName);

        // 必填，设置模板CODE，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $request->setTemplateCode(static::$templateCode);

        // 可选，设置模板参数, 假如模板中存在变量需要替换则为必填项
        $request->setTemplateParam(json_encode(array(  // 短信模板中字段的值
            "code"=>''.$code,
            "product"=>"牛魔王模具集成服务平台"
        ), JSON_UNESCAPED_UNICODE));

        // 可选，设置流水号
        $request->setOutId("yourOutId");

        // 选填，上行短信扩展码（扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段）
        $request->setSmsUpExtendCode("1234567");
        mylog($request->getRegionId());

        // 发起访问请求
        $acsResponse = static::getAcsClient()->getAcsResponse($request);

        return $acsResponse;
    }

    public function sendCode($phoneNumber,$code){
            return $this->sendSmsNew($phoneNumber,$code);
    }

//    public function sendValue(){
//        echo $this->myValue;
//    }


}
