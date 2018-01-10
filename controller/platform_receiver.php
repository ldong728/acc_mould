<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/10
 * Time: 10:40
 */
class platform_receiver
{


    public function receive()
    {
        echo 'ok';
//        exit;

        include_once $GLOBALS['mypath'] . '/tools/one_net/ReceiverHandler.php';

        $receiver = new ReceiverHandler(PRODUCT_ID, P_API_KEY);
        $row_data = file_get_contents('php://input');
        $resolved_data = $receiver->resolveBody($row_data);
        if (2 == $resolved_data['type']) {
            include_once $GLOBALS['mypath'] . '/includes/db.inc.php';
            $deviceId=$resolved_data['dev_id'];
            $status=$resolved_data['status'];
            $updateValue=['status'=>$status];
            if(1==$status){
                include_once $GLOBALS['mypath'] . '/tools/one_net/Onenet.php';
                $oneNet=new Onenet();
                $streamInf=$oneNet->getDataStream($deviceId);
                mylog($streamInf);
                $streamInf=json_decode($streamInf,true);
                if(0==$streamInf['errno']){
                    foreach ($streamInf['data'] as $stream) {
                        $updateValue[$stream['id']]=$stream['current_value'];
                    }
                }
            }
            pdoUpdate('device_tbl', $updateValue, ['d_id' => $resolved_data['dev_id']], ' limit 1');
        }
    }

    public function trigger()
    {
        include_once $GLOBALS['mypath'] . '/includes/db.inc.php';
        $row_data = file_get_contents('php://input');
//        mylog($row_data);
        $data = json_decode($row_data, true);
        foreach ($data['current_data'] as $row) {
            $field = $row['ds_id'];
            $deviceId = $row['dev_id'];
            $value = $row['value'];
            $device = pdoQuery('device_tbl', null, ['d_id' => $deviceId], ' limit 1')->fetch();
            if ($device) {
                pdoUpdate('device_tbl', [$field => $value], ['d_id' => $deviceId], ' limit 1');
                switch ($field) {
                    case "T1":

                        if (1 == $device['auto_run'] && $value < $device['auto_run_temp'] && 1 == $device['T3']) {
                            include_once $GLOBALS['mypath'] . '/tools/one_net/Onenet.php';
                            $oneNet = new Onenet();
                            $back = $oneNet->sendCommand('C01', $deviceId, $device['api_key']);
                        }
                        if ($value < $device['auto_run_temp']) {


                        }
                        break;
                    case "T4":
                        $device = pdoQuery('device_tbl', null, ['d_id' => $deviceId], ' limit 1')->fetch();
                        if ('00' != $value && $device['error_alert']) {
                            $deviceStatus=['00'=>'','E1'=>"点火不成功",'E2'=>'传感器故障','E3'=>'高温保护'];
                            mylog('device_error');
                            $this->sendAlert($deviceId, $deviceStatus[$value]);
                        }
                        break;
                }
            } else {//此设备未在本地数据库中
//                include_once $GLOBALS['mypach'].'/tools/one_net/Onenet.php';
//                $oneNet=new Onenet();
//                $back=$oneNet->getDeviceDetail($deviceId);
//                mylog(json_encode($back));
            }

        }

//        mylog($row_data);
        echo 'ok';
    }

    private function sendAlert($deviceId, $text)
    {
        include_once $GLOBALS['mypath'] . '/tools/push/PushSender.php';
        $userInf = pdoQuery('user_tbl', null, null, ' where user_id=(select user from device_tbl where d_id="' . $deviceId . '") limit 1')->fetch();
        mylog($userInf['device_token']);
        $pushSender = new PushSender($userInf['device_token']);
        $back = $pushSender->sendUniCast('宝工电器', '状态警报', $text);
        mylog($back);

        return $back;

    }

}

//2017.10.11.11:03:42:D:\WebTest\PhpTest\baogong\controller\platform_receiver.php19:{at: 1507691021603,type: 1,ds_id: T3,value: 00,dev_id: 17501226}
//2017.10.11.11:03:43:D:\WebTest\PhpTest\baogong\controller\platform_receiver.php24:{ "trigger" : { "id" : 59443, "type" : "change" }, "current_data" : [{ "user_id" : 93897, "dev_id" : "17501226", "ds_id" : "T3", "at" : "2017-10-11 11:03:41.603", "value" : "00" }] }
