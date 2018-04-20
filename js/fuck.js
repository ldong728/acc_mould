/**
 * Created by Administrator on 2018/4/18.
 */
var browser=navigator.appName;
var b_version=navigator.appVersion;
//console.log(navigator);
//console.log('browser name: '+browser);
//console.log('browser version: '+parseInt(b_version.slice(0,1)));

if('Microsoft Internet Explorer'==browser){
    if(parseInt(b_version.slice(0,1))<5){
        if(confirm('您当前的浏览器版本过低，运行时可能导致不可预知的错误，请使用IE9.0以上浏览器、火狐浏览器（firefox）或谷歌浏览器（chrome），如果使用360浏览器，请选择极速模式')){
            //location.href="http://download.firefox.com.cn/releases-sha2/stub/official/zh-CN/Firefox-latest.exe";
        }else{
        }
    }
}