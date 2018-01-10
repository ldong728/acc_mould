<?php
include_once '../includePackage.php';
include_once 'libs/PHPExcel.php';
include_once 'upload.class.php';
session_start();
if(isset($_SESSION[DOMAIN]['login'])&&DOMAIN==$_SESSION[DOMAIN]['login']) {
    if(isset($_FILES['img-file'])){
        mylog($_FILES);
        $fileName=md5_file($_FILES['img-file']['tmp_name']);
        $uploader=new uploader('img-file');
        $uploader->upFile($fileName);
        $inf=$uploader->getFileInfo();
        if($inf['size']>400000){
            compactImg($inf['url']);
        }
        $inf['url']=substr($inf['url'],3);
        if('SUCCESS'==$inf['state']){
            pdoInsert('file_tbl',['file_md5'=>$inf['md5'],'file_type'=>addslashes($inf['type']),'file_size'=>$inf['size'],'file_original_name'=>addslashes($inf['originalName']),'file_url'=>$inf['url']],'ignore');
        }
        $inf['url']='?img='.$inf['url'];

        echo json_encode($inf);
        exit;
    }

}
function compactImg($path){
    mylog('too big');
}
?>