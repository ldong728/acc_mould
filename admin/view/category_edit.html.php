<style>
    td {min-width: 150px}
    table {
        margin-bottom: 30px;
    }
    .table-title td {
        background-color: #aaaaaa;
    }
    .img{
        width: 30px;
        height: auto;
    }
    .pop-up input{
        max-width: 60px;
    }
</style>
<script type="application/javascript" src="js/ajaxfileupload.js"></script>
<div class="block">
    <div class="head">
        分类编辑
    </div>
    <div class="category-container">
        <table class="table sheet category-table">
            <tr class="table-title">
                <td class="category-name"></td><td>图片</td><td><button class="button add-current">添加分类项</button></td>
            </tr>
            <tr class="sub-category">
                <td class="sub-category-name"></td><td><img class="img" alt="分类图片"></td><td><button class="button open-attr-edit-view">编辑属性</button><button class="button show-sub">查看子分类</button><button class="button delete-category">删除分类</button></td>
            </tr>
        </table>
    </div>
</div>
<div class="pop-up category-attr-block" style="display: none">
    <div class="table-container">
        <div class="pop-up-head">
            属性列表
        </div>
        <table class="table sheet prepare-table">
            <thead>
            <tr>
                <td>属性名</td>
                <td>输入权限</td>
                <td>类型</td>
                <td>默认值</td>
                <td>操作</td>

            </tr>
            </thead>
            <tbody class="attr-container">
            <tr class="prepare-tr-template">
                <input type="hidden" class="attr-content" data-field="category_attr_id">
                <td><input class="attr-content" data-field="category_attr_name"</td>
                <td><input type="number" class="attr-content" data-field="alt_pms" maxlength="1" value="7"></td>
                <td><select class="attr-content" data-field="attr_type"><option value="text">文字</option><option value="number">数字</option><option value="file">文件</option></select></td>
                <td><input class="attr-content" data-field="default_value"></td>
                <td><button class="button delete-attr">删除</button></td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="5">
                    <button class="button add-attr">添加属性</button>
                    <button class="button submit-attr">提交修改</button>
                </td>
            </tr>
            </tfoot>

        </table>
    </div>
    <div class="button-container">
        <button class="button close-popup" data-type="close-popup">关闭</button>
    </div>

</div>

<input type="file" id="img-file" name="img-file" style="display: none">






<script type="application/javascript" src="js/tableController.js"></script>
<script>
    var categoryList=null;
    var elements,attrElement;
    var currentCategoryId=null;
    $(document).ready(function(){
        elements=TableController.prepareElement('.sub-category','.category-table');
        attrElement=TableController.prepareElement('.prepare-tr-template');
        getCategoryList();
        registEvent();
    });

    function getCategoryList(){
        $('category-container').empty();


        ajaxPost('category_list',{},function(back){
            var backValue=backHandle(back);
            if(backValue){
                categoryList=backValue;
            }
            var main=initCategoryList(0,'主分类',1);
            $('.category-container').append(main);
        });
    }
    function initCategoryList(parentId,parentName,level){
//        var pId=parentId||0;
        var mainCategory=elements('.category-table');
        mainCategory.find('.category-name').text(parentName+'('+level+'级分类'+')');
        mainCategory.attr('id',parentId);
        mainCategory.addClass('level'+level);
        mainCategory.attr('data-level',level);
        $.each(categoryList,function(k,v){
            if(parseInt(parentId)===parseInt(v.p_category)){
                initCategoryElement(mainCategory,level,v);
            }
        });
        return mainCategory;

    }
    function registEvent(){
        $(document).on('click','.add-current',function(){
            var parent=$(this).parents('.category-table');
            var parentId=parent.attr('id');
            var parentLevel=parseInt(parent.data('level'));
            ajaxPost('add_category',{parent_id:parentId},function(back){
                var backValue=backHandle(back);
                if(backValue){
                    initCategoryElement(parent,parentLevel,backValue);
                }else{
                    alert('数据库错误');
                }
                console.log(back);
            });
        });
        $(document).on('click','.open-attr-edit-view',function(){
            currentCategoryId=$(this).attr('id').slice(3);
            getCategoryAttr(currentCategoryId);
            $('.category-attr-block').show();

        });
        $(document).on('click','.add-attr',function(){
            var elements=attrElement();
            $('.attr-container').append(elements);
        });
        $(document).on('click','.submit-attr',function(){
            var prepareValue={category_id:currentCategoryId,values:[]};
            $('.prepare-tr-template').each(function(k,tr){
                var oneValue={category:currentCategoryId};
               $(tr).find('.attr-content').each(function(id,value){
                    var field=$(value).data('field');
                   var inputContent=$(value).val()||null;
                   oneValue[field]=inputContent;
               });
                prepareValue.values.push(oneValue);
            });
            console.log(prepareValue);
            ajaxPost('category_attr_edit',prepareValue,function(back){
               var backValue=backHandle(back);
                if(backValue){
                    $('.pop-up').hide();
                }else{
                    showToast('失败')
                }

            });
        });
        $(document).on('click','.close-popup',function(){
            $('.pop-up').hide();
        });
        $(document).on('click','.show-sub',function(){
            var button=$(this);
                    var parent=button.parents('.category-table');
                    var parentId=parseInt(button.data('parent'));
                    var name=button.parent('td').prev().text();
                    var level=parseInt(button.data('level'));
                    var sub=initCategoryList(parentId,name,level);
                    parent.nextAll().remove();
                    parent.after(sub);

        });
        $(document).on('click','.delete-category',function(){
            var button=$(this);
           var id=$(this).attr('id').slice(3);
            console.log(id);
            ajaxPost('delete_category',{id:id},function(data){
               var back=backHandle(data);
                if(back){
                    button.parents('tr').remove();
                }else{
                    alert('不能删除')
                }
            });
        });
        $(document).on('click','.img',function(){
            $('#product-img').click();
            currentCategoryId=$(this).attr('id').slice(3);
        });
        $(document).on('change','#product-img',function(){
            $.ajaxFileUpload({
                url: 'upload.php',
                secureuri: false,
                fileElementId: $(this).attr('id'), //文件上传域的ID
                dataType: 'json', //返回值类型 一般设置为json
                success: function (v, status) {

                    if ('SUCCESS' == v.state) {
                        console.log(v);
                        $('#img'+currentCategoryId).attr('src', v.url);
                        altTable('category','img', v.url,'category_id',currentCategoryId,function(back){
                            showToast('上传成功');
                        });
                        console.log(v);
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
    function getCategoryAttr(categoryId){
        $('.attr-container').empty();
        ajaxPost('category_attr_list',{category_id:categoryId},function(back){
            var backValue=backHandle(back);
            if(backValue){
                $.each(backValue,function(k,v){
                   var element=attrElement();
                    element.find('.attr-content').each(function(index,value){
                        var field=$(value).data('field');
                        $(value).val(v[field]);
                    });
                    $('.attr-container').append(element);
                });
            }
        });
    }

    function initCategoryElement(parent,level,v){
        var trElement=elements('.sub-category');
        var nameElement=trElement.find('.sub-category-name');
        var button=trElement.find('.show-sub');
        var imgElement=trElement.find('.img');
        var attrButton=trElement.find('.open-attr-edit-view');
        var delButton=trElement.find('.delete-category');
        nameElement.addClass('ipt-toggle');
        nameElement.attr('id',v.category_id);
        nameElement.attr('data-tbl','category');
        nameElement.attr('data-col','category_name');
        nameElement.attr('data-index','category_id');
        nameElement.text(v.category_name);
        imgElement.attr('src', v.img);
        imgElement.attr('id','img'+ v.category_id);
        button.attr('data-parent', v.category_id);
        button.attr('data-level', level+1);
        attrButton.attr('id','att'+ v.category_id);
        delButton.attr('id','del'+ v.category_id);
        parent.append(trElement);
    }
</script>