<?php global $companyInf ?>
<script>
    var companyInf = <?php echo $companyInf? json_encode($companyInf):'{}'?>;
</script>
<script type="application/javascript" src="js/ajaxfileupload.js"></script>
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
</style>
<div id="core" style="height: 618px;">
    <div class="block">
        <div class="head" style="width: 98%;"><span>供应商信息</span></div>
        <div class="main">
            <table class="table baseInfo">
                <tr >
                    <td>公司名称：</td>
                    <td><input class="company-normal-info" data-field="company_name" type="text" placeholder="公司名称"></td>
                    <td>联系电话：</td>
                    <td><input class="company-normal-info" data-field="company_tel" placeholder="联系电话"></td>
                </tr>
                <tr>
                    <td>供应商地址：</td>
                    <td colspan="3"><input class="company-normal-info" data-field="company_address" placeholder="供应商地址" style="width: 600px"></td>
                </tr>
                <tr>
                    <td>主营模式：</td>
                    <td colspan="3"><input class="company-normal-info" data-field="major_business" placeholder="主营模式" style="width: 600px"></td>
                </tr>
                <tr>
                    <td>法人代表：</td>
                    <td><input class="company-normal-info" data-field="company_legal_rep" placeholder="法人代表"> </td>
                    <td>员工人数：</td>
                    <td><input class="company-normal-info" data-field="company_employee_count" placeholder="员工人数"></td>
                </tr>
                <tr>
                    <td>注册资金：</td>
                    <td><input type="tel" class="company-normal-info" data-field="registered_capital" placeholder="注册资金"> </td>
                    <td>经营模式：</td>
                    <td><input type="tel" class="company-normal-info" data-field="business_model" placeholder="经营模式"> </td>
                </tr>
                <tr>
                    <td>厂房面积：</td>
                    <td><input class="company-normal-info" data-field="area_size" placeholder="厂房面积"></td>
                    <td>公司logo：</td>
                    <td><img class="img img-upload" data-key="logo" data-multiple="0" alt="公司logo（点击上传）"></td>
                </tr>
                <tr>
                    <td>公司图片：</td>
                    <td colspan="3">
                        <img class="img img-upload biger-img" data-key="company-img" data-multiple="1" alt="公司图片（点击上传）">
                    </td>
                </tr>
                <tr>
                    <td>荣誉图片：</td>
                    <td colspan="3">
                        <img class="img img-upload biger-img" data-key="honor-img" data-multiple="1" alt="公司图片（点击上传）">
                    </td>
                </tr>
                <tr>
                    <td>公司简介：</td>
                    <td colspan="3">
                        <textarea class="company-normal-info" data-field="introduction" cols="100" rows="5" style="resize: none">公司简介</textarea>
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
        var currentImg=null;
        var imgs={};
        $(document).ready(function () {
            initCompanyInf();
            registEvent();
            initImgValues();


        });
        function initImgValues(){
            var imgInf={};
            if(companyInf.company_id){
                imgInf=JSON.parse(companyInf.img)||{};
                console.log(imgInf);
                imgs=imgInf;
            }
            $('img').each(function(k,v){
                var key=$(v).data('key');
                var multiple=parseInt($(v).data('multiple'));
                if(imgInf[key]){//有图片的情况
                    if(multiple){
                        $.each(imgInf[key],function(id,imgUrl){
                            var singleImg=$(v).clone();
                            singleImg.attr('src',imgUrl);
                            $(v).before(singleImg);
                        });
                    }else{
                        $(v).attr('src',imgInf[key]);
                    }
                }else{
                    console.log(key);
                    imgs[key]=multiple?[]:null;
                }

            });
        }
        function registEvent(){
            $(document).on('click','#submit',function(){
                var isNull=false;
                $('.company-normal-info').each(function(k,v){
                    var field=$(v).data('field');
                    if('company_name'==field&&!v.value){
                        isNull=true;
                    }
                    companyInf[field]= v.value;
                });
                companyInf['img']=imgs;
                if(!isNull){
                    updateCompanyInf();
                }
            });
            $(document).on('click','.img-upload',function(){
                currentImg=$(this);
                var multiple=parseInt($(this).data('multiple'));
                var key=$(this).data('key');
                if(multiple){
                    if($(this).attr('src')){
                        imgs[key].splice(imgs[key].indexOf($(this).attr('src')),1);
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
                            var key=currentImg.data('key');
                            if(multiple){
                                imgs[key].push(v.url);
                                var newImg=currentImg.clone();
                                currentImg.after(newImg);
                            }else{
                                imgs[key]= v.url;
                            }
                            currentImg.attr('src', v.url);
                        } else {
                            showToast(v.state);
                        }
                    },//服务器成功响应处理函数
                    error: function (d) {
                        alert('error');
                    }
                });
            })
        }

        function initCompanyInf() {
            if (companyInf.company_id) {
                $('.company-normal-info').each(function(k,v){
                    var field=$(v).data('field');
                    v.value=companyInf[field];
                });
                var imgInf=JSON.parse(companyInf.img);

            }
        }

        function updateCompanyInf(){

            ajaxPost('add_company',companyInf,function(back){
                var backValue=backHandle(back);
                if(backValue){
                    if(companyInf.company_id){
                        var href=getHref('company_list');
                        location.href=href;
                    }else{
                        location.reload(true);
//                        showToast('更改成功');
                    }
                }
            });
        }

    </script>

</div>