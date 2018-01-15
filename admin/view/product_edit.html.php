<?php global $productInf ?>
<script>
    var productInf = <?php echo $productInf? json_encode($productInf):'{}'?>;
</script>
<script type="application/javascript" src="js/ajaxfileupload.js"></script>
<script type="application/javascript" src="js/tableController.js"></script>
<script src="//unpkg.com/wangeditor/release/wangEditor.min.js"></script>
<style>
    .img{
        width: 40px;
        height: auto;
    }
    .biger-img{
        width: 150px;v
        margin-left: 10px;
        height: auto;
    }
</style>
<div id="core" style="height: 618px;">
    <div class="block">
        <div class="head" style="width: 98%;"><span>供应商信息</span></div>
        <div class="main">
            <table class="table baseInfo">
                <tbody>
                <tr class="hidde-when-edit">
                    <td>类型：</td>
                    <td class="category-container"><select class="select-template"><option class="option-template"></option></select></td>
                    <td>供应商：</td>
                    <td class="company-container"></td>
                </tr>
                <tr>
                    <td>商品名称：</td>
                    <td colspan="3"><input class="product-normal-info" data-field="product_name" style="width: 500px"></td>
                </tr>
                <tr>
                    <td>商品图片：</td>
                    <td colspan="3"> <img class="img img-upload biger-img" data-key="product-img" data-multiple="1" alt="商品图片（点击上传）"></td>
                </tr>
                <tr>
                    <td>梯度定价：</td>
                    <td>功能未开启</td>
                    <td>运费说明：</td>
                    <td><input class="product-normal-info" data-field="shipping_instr"></td>
                </tr>
                <tr>
                    <td>发货期：</td>
                    <td><input class="product-normal-info" data-field="delivery_time"></td>
                    <td>发货地：</td>
                    <td><input class="product-normal-info" data-field="shipping_place"></td>
                </tr>
                <tr>
                    <td>商品描述：</td>
                    <td colspan="3" id="editor"></td>
                </tr>
                <tr>
                    <td>规格描述：</td>
                    <td colspan="3" id="size-editor"></td>

                </tr>
                </tbody>
                <tfoot class="attr-container">
                <tr class="attr-template">
                    <td><span class="name"></span>：</td>
                    <td colspan="3"><span class="value-input"><input class="attr-value"></span><span class="unit"></span></td>
                </tr>
                </tfoot>

            </table>
        </div>
        <div>
            <button class="button" id="submit">提交</button>
        </div>
    </div>
    <div class="space"></div>
    <input type="file" id="img-file" name="img-file" style="display: none">

    <script>
        var attrList={};
        var currentImg=null;
        var imgs={};
        var selectCreator;
        var attrTrCreator;
        var detailEditor,sizeEditor;
        $(document).ready(function () {
            if(productInf.product_id){
               $('.hidde-when-edit').remove();
                init();
                initProductInf();
                registEvent();
                initImgValues();
//                $('.hidde-when-edit').find('.product-normal-info').removeClass('product-normal-info');
            }else{
                init();
                initProductInf();
                initCategory();
                registEvent();
                initImgValues();
            }


        });

        function init(){
            detailEditor=initEditor('#editor');
            sizeEditor=initEditor('#size-editor');
            selectCreator=TableController.prepareElement('.select-template','.option-template');
            attrTrCreator=TableController.prepareElement('.attr-template');
        }
        function initCategory(){
            ajaxPost('category_list',{},function(back){
                var backValue=backHandle(back);
                if(backValue){
                    var categorySelector=selectCreator('.select-template');
                    var emptyOption=selectCreator('.option-template');
                    categorySelector.removeClass('select-template');
                    categorySelector.addClass('category-select');
                    categorySelector.addClass('product-normal-info');
                    categorySelector.attr('data-field','category');
                    emptyOption.val(0);
                    emptyOption.text('请选择类别');
                    emptyOption.attr('disabled','1');
                    emptyOption.attr('selected','1');
                    categorySelector.append(emptyOption);
                    var pList=[];
                    $.each(backValue,function(k,v){
                        if(v.p_category){
                            pList.push(v.cateogry_id);
                            categorySelector.find('#cat'+ v.p_category).remove();
                        }
                        if(pList.indexOf(v.category_id)<0){
                            var cateOption=selectCreator('.option-template');
                            cateOption.attr('id','cat'+ v.category_id);
                            cateOption.val(v.category_id);
                            cateOption.text(v.category_name);
                            categorySelector.append(cateOption);
                        }
                    });
                    $('.category-container').append(categorySelector);
                }
            });
//            initProductInf();
        }
        function initCompany(id){
            $('.company-container').empty();
            ajaxPost('company_category_list',{category:id},function(back){
                var backValue=backHandle(back);
                if(backValue){
                    var categorySelector=selectCreator('.select-template');
                    var emptyOption=selectCreator('.option-template');
                    categorySelector.removeClass('select-template');
                    categorySelector.addClass('company-select');
                    categorySelector.addClass('product-normal-info');
                    categorySelector.attr('data-field','company');
                    emptyOption.val(0);
                    emptyOption.text('请选择供应商');
                    emptyOption.attr('disabled','1');
                    emptyOption.attr('selected','1');
                    categorySelector.append(emptyOption);
                    var pList=[];
                    $.each(backValue,function(k,v){
                            var cateOption=selectCreator('.option-template');
//                            cateOption.attr('id','com'+ v.category_id);
                            cateOption.val(v.company);
                            cateOption.text(v.company_name);
                            categorySelector.append(cateOption);
                    });
                    $('.company-container').html(categorySelector);
                }
            });
        }
        function initImgValues(){
            var imgInf={};
            if(productInf.product_id){
                imgInf=JSON.parse(productInf.img)||{};
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
            $(document).on('change','.category-select',function(){
               var id=$(this).val();
                ajaxPost('category_attr_list',{category_id:id},function(back){
                    var backValue=backHandle(back);
                    if(backValue){
                        attrList={};
                        $.each(backValue,function(k,v){
                            console.log(v.attr_pms);
                            if([1,3,5,7].indexOf(parseInt(v.attr_pms))>-1){
                                attrList[v.category_attr_id]=v;
                            }
                        });
                        initAttrInputArea(attrList);
                    }
                });
                initCompany(id);
            });
            $(document).on('click','#submit',function(){
                var isNull=false;
                $('.product-normal-info').each(function(k,v){
                    var field=$(v).data('field');
                    if('product_name'==field&&!v.value){
                        isNull=true;
                    }
                    productInf[field]= v.value;
                });
                $('.attr-value').each(function(k,v){
                    var id= $(v).attr('id').slice(3);
                    var sValue= v.value;
                    attrList[id].value=sValue;
                });
                productInf['img']=imgs;
                productInf['product_attr']=attrList;
                productInf['product_detail']=detailEditor.txt.html();
                productInf['size_detail']=sizeEditor.txt.html();
                if(!isNull){
                    updateProductInf();
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
        function initAttrInputArea(attrs){
            $('.attr-container').empty();
            $.each(attrs,function(k,v){
                var sTr=attrTrCreator();
                sTr.find('.name').text(v.category_attr_name);
                sTr.find('.unit').text(v.attr_unit||'');
                sTr.find('.attr-value').attr('id','att'+k);
                sTr.find('.attr-value').val(v.value||'');

                $('.attr-container').append(sTr);

            });


        }
        function initProductInf() {
            if (productInf.product_id) {
                if(productInf.product_attr){
//                    console.log(productInf.product_attr);
                    attrList=JSON.parse(productInf.product_attr);
//                    console.log(attrList);
                }
                $('.product-normal-info').each(function(k,v){
                    var field=$(v).data('field');
                    v.value=productInf[field];
                });
                initAttrInputArea(attrList);
                detailEditor.txt.html(productInf.product_detail);
                sizeEditor.txt.html(productInf.size_detail);
//                var imgInf=JSON.parse(productInf.img);
            }
//            $('.category-select').remove();
        }

        function updateProductInf(){
            ajaxPost('add_product',productInf,function(back){
                var backValue=backHandle(back);
                if(backValue){
                    if(productInf.product_id){
                        var href=getHref('product_list');
                        location.href=href;
                    }else{
                        location.reload(true);
//                        showToast('更改成功');
                    }
                }
            });
        }
        function initEditor(select) {
            var E = window.wangEditor;
            var editor = new E(select);
            // 或者 var editor = new E( document.getElementById('#editor') )
            editor.customConfig.uploadImgServer='upload.php';
            editor.customConfig.uploadImgParams={
                fromContent:1
            };
            editor.customConfig.uploadImgShowBase64 = false;
            editor.create();
            return editor;
        }

    </script>

</div>