<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/14
 * Time: 13:53
 */

class Device {
    private $userId;
    private $deviceStatus=[0=>'','E1'=>"点火不成功",'E2'=>'传感器故障','E3'=>'高温保护'];
    public function __construct(){
        $this->userId=API::userVerify();
    }

//    public

    public function regist($data){
        $sn=$data['sn'];
        $query=pdoQuery('device_tbl',null,['sn'=>$sn],'limit 1')->fetch();
        if($query){//设备已注册
            if($query['user']==$this->userId){//设备在自己账户下
                echoBack(null,106,'设备注册成功');
            }else{//设备不在自己账户下
                if($query['user']){//设备有主
                    echoBack(null,107,'设备已被其他用户注册，请先解除绑定');
                }else{
                    pdoUpdate('device_tbl',['user'=>$this->userId],['sn'=>$sn],' limit 1');
                    echoBack(['api_key'=>$query['api_key'],'device_id'=>$query['d_id']],0,'设备注册成功');
                }
            }
        }else{//设备未注册
            include_once $GLOBALS['mypach'].'/tools/one_net/Onenet.php';
            $oneNet=new Onenet();
            $registBack=$oneNet->registerDevice($sn);
            $registBack=json_decode($registBack,true);
            if(0==$registBack['errno']){
                $key=$registBack['data']['key'];
                $dId=$registBack['data']['device_id'];
                $id=pdoInsert('device_tbl',['sn'=>$sn,'api_key'=>$key,'d_id'=>$dId,'user'=>$this->userId,'create_time'=>time()]);
                if($id){
                    echoBack(['api_key'=>$key,'device_id'=>$dId],0,'设备注册成功');
                }else{
                    echoBack(null,10,'数据库错误');
                }
            }else{
                echoBack(null,15,'onenet 接口调用失败');
            }

        }
    }

    public function get_list(){
        $list=array();
        $listQuery=pdoQuery('device_tbl',null,['user'=>$this->userId],null);
        foreach ($listQuery as $row) {
            $deviceError='';
            if(isset($this->deviceStatus[$row['T4']])){
                $deviceError=$this->deviceStatus[$row['T4']];
            }
            $list[]=['device_id'=>$row['device_id'],'device_name'=>'工业取暖器','sn_number'=>$row['sn'],'online'=>(int)$row['status'],'error_tag'=>$deviceError];
        }
        echoBack($list);
    }

    public function detail($data){
        $id=$data['device_id'];
        $inf=pdoQuery('device_tbl',null,['device_id'=>$id],'limit 1')->fetch();
        if($inf){
            $temp=$inf['T1'];
            $targetTemp=$inf['T2'];
            $powerOn=(int)$inf['T3'];
            $status='';
            if(isset($this->deviceStatus[$inf['T4']])){
                $status=$this->deviceStatus[$inf['T4']];
            }
            $backInf=[
                'device_id'=>$inf['device_id'],
                'on_device_id'=>$inf['d_id'],
                'api_key'=>$inf['api_key'],
                'current_temp'=>$temp,
                'target_temp'=>$targetTemp,
                'power_on'=>$powerOn,
                'status'=>$status,
                'network_status'=>$inf['status'],
                'lowTemp_autoRun'=>$inf['auto_run'],
                'error_alert'=>$inf['error_alert'],
            ];
            echoBack($backInf);

        }else{
            echoBack(null,109,'设备不存在');
        }
    }
    public function command($data){
        $commandData=$data['command'];
        $api_key=$data['api_key'];
        $device_id=$data['on_device_id'];
        include_once $GLOBALS['mypach'].'/tools/one_net/Onenet.php';
        $oneNet=new Onenet();
        $back=$oneNet->sendCommand($commandData,$device_id,$api_key);
        $back=json_decode($back,true);
        if(0==$back['errno']){
            if(isset($back['data']['cmd_uuid'])){
                echoBack(['uuid'=>$back['data']['cmd_uuid']]);

            }else{
                echoBack(null,21,'无uuid返回');
            }

        }else{
            mylog('command error:'.$back['error']);
            echoBack(null,20,'指令下发失败');
        }

    }
    public function check_command($data){
        $uuid=$data['uuid'];
        $api_key=$data['api_key'];
//        mylog(json_encode($data));
        include_once $GLOBALS['mypach'].'/tools/one_net/Onenet.php';
        $oneNet=new Onenet();
        $back=$oneNet->check_command($uuid,$api_key);
        $back=json_decode($back,true);
        $backData = $back['data'];
        $backData['uuid'] = $uuid;


        if('succ'==$back['error']){
            echoBack($backData);
        }else{
            mylog('server_error:'.$back['errno']);
            echoBack(null,34,'onenet服务器响应异常');
        }
//        echoBack($back);
    }
    public function lowTempAutoRun($data){
        $mode=$data['mode'];
//        $userSession=$data['user_session']
        pdoUpdate('device_tbl',['auto_run'=>$mode],['user'=>$this->userId],' limit 1');
        echoBack();
    }
    public function errorAlert($data){
        $mode=$data['mode'];
        $deviceId=$data['device_id'];
        $value=['error_alert'=>$mode];
        pdoUpdate('device_tbl',$value,['user'=>$this->userId,'device_id'=>$deviceId],' limit 1');
        echoBack();
    }

} 