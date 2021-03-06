<?php

include_once $GLOBALS['mypath'] . '/includes/upload.class.php';
class Upload{
    private $fileField;
    public function __construct($fileField){
        $this->fileField=$fileField;
        $this->saveFile();
    }

    private function saveFile(){
        if(isset($_FILES[$this->fileField])){
            $file=$_FILES[$this->fileField];
            $fileName=md5_file($file['tmp_name']);
            $uploader=new uploader($this->fileField);
            $uploader->upFile($fileName);
            $inf=$uploader->getFileInfo();
            if('SUCCESS'==$inf['state']){
                pdoInsert('file_tbl',['file_md5'=>$inf['md5'],'file_type'=>addslashes($inf['type']),'file_size'=>$inf['size'],'file_original_name'=>addslashes($inf['originalName']),'file_url'=>$inf['url']],'ignore');
            }
            echo json_encode($inf);
//            echoBack($inf);
        }
        if(isset($_POST['fromContent'])&&$_POST['fromContent']){
            $backData=['errno'=>0,'data'=>[]];
            $insertValue=[];
            $domain=$_SERVER['HTTP_ORIGIN'].DOMAIN.'/files/';
            foreach($_FILES as $k=>$v){
                $fileName=md5_file($v['tmp_name']);
                $uploader=new uploader($k);
                $uploader->upFile($fileName);
                $inf=$uploader->getFileInfo();
                if('SUCCESS'==$inf['state']){
                    $insertValue[]=['file_md5'=>$inf['md5'],'file_type'=>addslashes($inf['type']),'file_size'=>$inf['size'],'file_original_name'=>addslashes($inf['originalName']),'file_url'=>$inf['url']];
                    $inf['url']='?img='.$inf['url'];
                    $backData['data'][]=$inf['url'];
                }
            }
            if(count($insertValue)){
                pdoBatchInsert('file_tbl',$insertValue,'ignore');
            }
        mylog(json_encode($backData));
            echo json_encode($backData);
            exit;
        }
    }

}