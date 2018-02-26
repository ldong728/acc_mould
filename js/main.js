var browser=navigator.appName;
var b_version=navigator.appVersion;
console.log(navigator);
console.log('browser name: '+browser);
console.log('browser version: '+parseInt(b_version.slice(0,1)));

if('Microsoft Internet Explorer'==browser){
    if(parseInt(b_version.slice(0,1))<5){
        if(confirm('您当前的浏览器版本过低，运行时可能导致不可预知的错误，请使用IE9.0以上浏览器、火狐浏览器（firefox）或谷歌浏览器（chrome），点击确定将下载最新版火狐')){
            location.href="http://download.firefox.com.cn/releases-sha2/stub/official/zh-CN/Firefox-latest.exe";
        }else{
        }
    }
}

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
function backHandle(data,onSeccess,onError){
    var re=eval('('+data+')');
    if(0==re.error_code){
        var state= null==re.data?0:re.data;
        //console.mylog(state);
        if(onSeccess)onSeccess(state);
        return state;
    }else{
        console.log(re);
        if(onError)onError(re.error_code,re.message);
        console.log('error: '+re.message);
        return false;
    }
}
function ajaxPost(className,methodName,ajaxData,callback){
    var postData;
    if('object'===typeof ajaxData){
        postData=ajaxData
    }else{
        postData={data:ajaxData};
    }
    $.post('api.php/API/'+className+'/'+methodName,postData,callback);
}
function mylog(data){
    console.log(data);
}
function signOut(category){
    ajaxPost('signOut',{},function(data){
        var value=backHandle(data);
        if('ok'==value)location.href='index.php?c='+category;
        else console.log(value);
    });
}
function prepareElement(){
    var returnData={};
    var classList=[];
    var outArg=arguments;
    $.each(arguments,function(k,v){
        if($(v.toString()).length>0){
            returnData[v]=$(v).clone();
        }
        classList.push(v);
    });
    $.each(classList,function(k,v){
        $(v).remove();
        for(var i in returnData){
            returnData[i].find(v).remove();
        }
    });
    return function(jqueryElement){
        var element=jqueryElement;
        if(1==outArg.length){
            element=outArg[0];
        }
        return returnData[element].clone();
    }
}
function setUploadEvent(jqueryElementSelect,success,error){
    if($(jqueryElementSelect).attr('id')&&$(jqueryElementSelect).attr('id')==$(jqueryElementSelect).attr('name')){
        $(document).on('change',jqueryElementSelect,function(){
            var elementId=this.id;
            $.ajaxFileUpload({
                url:'api.php/API/Upload/'+elementId,
                secureuri: false,
                fileElementId: elementId, //文件上传域的ID
                dataType: 'json', //返回值类型 一般设置为json
                success:success,
                error:error
            });
        });
    }else{
        console.error('input file 元素需设置相同的name和id属性');
    }

}
function getUrlParam(name) {
    //构造一个含有目标参数的正则表达式对象
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    //匹配目标参数
    var r = window.location.search.substr(1).match(reg);
    //返回参数值
    if(r != null) {
        return decodeURI(r[2]);
    }
    return null;
}