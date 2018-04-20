
<script type="application/javascript" src="js/ajaxfileupload.js"></script>
<script type="application/javascript" src="js/tableController.js"></script>

<style>
    .img{
        width: 40px;
        height: auto;
    }
    .biger-img{
        width: 150px;
        margin-left: 10px;
        height: auto;
    }
    .category-template{
        margin-left: 20px;
    }
</style>
<div id="core" style="height: 618px;">
<div class="block">
    <div class="head" style="width: 98%;"><span>首页图</span></div>
    <div class="main">
        <table class="table baseInfo">
            <tr>
                <td>首页图片：</td>
                <td colspan="3">
                    <img class="img img-upload biger-img" data-key="company-img" data-multiple="1" alt="首页图片（点击上传）">
                </td>
            </tr>
        </table>
    </div>
    <div>
        <button class="button" id="submit">提交</button>
    </div>
</div>
<div class="space"></div>
<input type="file" id="img-file" name="img-file" style="display: none">

<script>
    var currentImg=$('.img-upload');
    var indexImg=[];
    $(document).ready(function () {
        registEvent();
        initImgValues();
    });
    function initImgValues(){
        ajaxPost('get_index_img',{},function(back){
            var backValue=backHandle(back);
            if(backValue){

                $.each(backValue,function(k,v){
                        indexImg.push(v.url);

                });
                disPlayImg();
                console.log(indexImg);
            }
        });
    }
    function registEvent(){
        $(document).on('click','#submit',function(){
            ajaxPost("add_index_img",{img:indexImg},function(back){
                location.reload(true);
            });
        });
        $(document).on('click','.img-upload',function(){
            currentImg=$(this);
            var multiple=parseInt($(this).data('multiple'));
            var key=$(this).data('key');
            if(multiple){
                if($(this).attr('src')){
                    indexImg.splice(indexImg.indexOf($(this).attr('src')),1);
                    $(this).remove();
                }else{
                    $('#img-file').click();
                }
            }else{
                $('#img-file').click();
            }
        });
        $(document).on('change','#img-file',function(){
            $.ajaxFileUpload({
                url: 'upload.php',
                secureuri: false,
                fileElementId: $(this).attr('id'), //文件上传域的ID
                dataType: 'json', //返回值类型 一般设置为json
                success: function (v, status) {
                    console.log(v);
                    if ('SUCCESS' == v.state) {
                        var multiple=parseInt(currentImg.data('multiple'));
                        if(multiple){
                            indexImg.push(v.url);
                        }else{
                            indexImg= v.url;
                        }
                        disPlayImg();
                    } else {
                        showToast(v.state);
                    }
                },//服务器成功响应处理函数
                error: function (d) {
                    alert('error');
                }
            });
        });

    }
    function disPlayImg(){
        $('.img-upload').each(function(k,v){
           if($(v).attr('src')){
               $(v).remove();
           }
        });
        $.each(indexImg,function(k,v){
            var newImg=currentImg.clone();
            currentImg.attr('src', v);
            currentImg.after(newImg);
        });
        console.log(indexImg);
    }



</script>

</div>