//$('input').attr('onkeypress',"if(event.keyCode == 13) return false;");//屏蔽回车键
function showToast(str){
    $('.toast').empty();
    $('.toast').append(str)
    $('.toast').fadeIn('fast')
    var t = setTimeout('$(".toast").fadeOut("slow")', 800);
}
function loading(){
    $('.loading').show();
}
function stopLoading(){
    $('.loading').hide();
}
function mylog(data){
    console.log(data);
}
function getHref(subMenu){
    var href=null;
    $('a').each(function(k,v){
        if(v.href.indexOf(subMenu)>0){
            href= v.href;
            return false;
        }
    });
    return href;
}

function getRandStr(length){
    var defLengh=length||16;
    var randomStr='';
    var Str="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    for(i=0;i<defLengh;i++){
        randomStr+=Str.charAt(Math.round(Math.random()*(Str.length-1)))
    }
    return randomStr;
}
function backHandle(data){
    var re=eval('('+data+')');
    if(0==re.errcode){
        var state= null==re.data?0:re.data;
        //console.mylog(state);
        return state;
    }else{
        console.log('error: '+re.errmsg);
        return false;
    }
}
function altTable(tablename,colname,colvalue,indexname,indexvalue,success){
    var colValuePare={};
    colValuePare[colname]=colvalue;
    altTableBatch(tablename,colValuePare,indexname,indexvalue,success);
}
function altTableBatch(tablename,colValuePare,indexname,indexvalue,success){
    var altValue={
        alteTblVal: 1,
        tbl: tablename,
        col_value:colValuePare,
        index: indexname,
        id: indexvalue,
        pms:pms
    };
    $.post('ajax_request.php',altValue , function (data) {
        if(data)data=eval('('+data+')');
        if (data.errcode == 0) {
            success(data);
        }else{
            return false;
        }
    })
}
function deleteRecord(tablename,value,success){
    var deleteValue={
        deleteTblVal: 1,
        tbl: tablename,
        value:value,
        pms:pms
    };
    $.post('ajax_request.php',deleteValue , function (data) {
        if(data)data=eval('('+data+')');
        if (data.errcode == 0) {
            success(data);
        }else{
            return false;
        }
    })
}
function addRecord(tablename,value,onDuplicate,success){
    var insertValue={
        addTblVal:1,
        tbl:tablename,
        pms:pms,
        value:value,
        onDuplicte:onDuplicate
    }
    $.post('ajax_request.php',insertValue , function (data) {
        if(data)data=eval('('+data+')');
        if (data.errcode == 0) {
            success(data);
        }else{
            return false;
        }
    })
}
function addRecordWithSign(tablename,value,onDuplicate,success){
    var insertValue={
        addTblVal:1,
        tbl:tablename,
        pms:pms,
        value:value,
        onDuplicte:onDuplicate
    }
    $.post('ajax_request.php',insertValue , function (data) {
        if(data)data=eval('('+data+')');
        if (data.errcode == 0) {
            success(data);
        }else{
            return false;
        }
    })
}
function altConfig(name,key,value,success){
    var conValue={
        altConfig:1,
        name:name,
        key:key,
        value:value,
        pms:pms
    }
    $.post('ajax_request.php',conValue , function (data) {
        if(data)data=eval('('+data+')');
        if (data.errcode == 0) {
            success(data);
        }else{
            return false;
        }
    })
}
function ajaxPost(method,ajaxData,callback){
    $.post('ajax_request.php',{method:method,ajax_data:ajaxData,pms:pms},callback);
}

//例：<div class="ipt-toggle" id="row id" data-tbl="table name"data-col="col name" data-index="index col">
$(document).on('dblclick','.ipt-toggle',function(){
//$('.ipt-toggle').dblclick(function () {

    var id = $(this).attr('id');
    var value = $.trim($(this).text());
    var content = '<input type="text" class="ipt"id="ipt' + id + '"/>';
    $(this).html(content);
    $('#ipt'+id).val(value);
    //alert(content);
    //$(this).html(content)
});
//例：<div class="ipt-area-toggle" id="row id" data-tbl="table name"data-col="col name" data-index="index col">
$(document).on('dblclick','.ipt-area-toggle',function(){
//$('.ipt-area-toggle').dblclick(function () {
    var id = $(this).attr('id');
    var value = $.trim($(this).text());
    var content = '<textarea class="ipt"id="ipt' + id + '">'+value+'</textarea>';

    $(this).html(content)
});
//例：外部元素：<div id="row id" data-tbl="table name"data-col="col name" data-index="index col">
$(document).on('change','.select',function(){
    var parent=$(this).parent();
    var value=$(this).val();
    var index = parent.data('index')||false;
    var id=parent.attr('id')||false;
    var tbl=parent.data('tbl')||false;
    var col=parent.data('col')||false;
    var replace = parent.data('replace');
    if(replace){
        index=col;
        id=replace;
    }
    if(index&&id&&tbl&&col){
        altTable(tbl,col,value,index,id,function(){
            showToast('修改完成')
        })
    }else{
        showToast('修改失败');
        console.log('fail')
    }

})

$(document).on('change', '.ipt', function () {
    console.log('change');
    var input = $(this);
    var value = $(this).val();
    var id = $(this).attr('id').slice('3');
    var index = $(this).parent().data('index');
    var tbl = $(this).parent().data('tbl');
    var col = $(this).parent().data('col');
    var replace = $(this).parent().data('replace');
    if (replace) {
        index = col;
        id = replace;
    }
    altTable(tbl,col,value,index,id,function(){
        input.parent().text(value);
        input.remove();
        showToast('修改完成')
    });
});


/**
 * 遍历当前节点所有子节点，返回对象
 * @param list 待转化的数组
 * @param idField 数据中每一条数据的id名；
 * @param parentIdField每一条数据的父id名
 * @param currentId 当前节点ID
 * @returns 包含所有子节点的对象
 */
function encodeListToTree(list,idField,parentIdField,currentId){
    var sub={};
    for(var i in list){
        if(list[i][parentIdField]==currentId){
            var newId=list[i][idField];
            sub[newId]=list[i];
            sub[newId].sub=encodeListToTree(list,idField,parentIdField,newId);
        }
    }
    return sub;
}


