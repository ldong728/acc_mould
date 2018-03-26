<?php

?>
<style>
    .img{
        width: 60px;
        height: auto;;
    }
</style>
<div class="block">
    <div class="head">
        用户列表
    </div>
    <table class="table sheet product-table">
        <tr>
            <th>手机号码</th>
            <th>公司名称</th>
            <th>注册时间</th>
            <th>操作</th>

        </tr>
        <tr class="tr-template">
            <td class="content" data-field="user_tel"></td>
            <td class="content" data-field="company_name"></td>
            <td class="content" data-field="user_create_time"></td>
<!--            <td class="content priority ipt-toggle" data-field="priority" data-tbl="product" data-col="priority" data-index="product_id"></td>-->

            <td>
<!--                <button class="button edit" data-type="edit">编辑</button>-->
<!--                <button class="button delete" data-type="delete">删除</button>-->
            </td>
        </tr>
    </table>
    <table class="table sheet">
        <tr class="unit-table-foot">
            <td colspan="12">
                <div class="page_link">
                    <div class="in">
                        <a href="#" class="page-change" id="prev">上一页</a>
                        <span>共<span class="page-total"></span>页</span>
                        <span>当前第<span class="page-now"></span>页</span>
                        <a href="#" class="page-change" id="next">下一页</a>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <table class="table">
<!--        <tr>-->
<!--            <td>类别筛选：</td><td class="category-filter"><select class="category-template category-select"><option class="option-template"></option></select></td>-->
<!--            <td>商品名搜索:</td><td><input class="name-search-text" type="text" placeholder="请输入关键字" maxlength="10"><button class="button" data-type="search-name" id="sch1">搜索</button></td>-->
<!--        </tr>-->
    </table>
    <div>

    </div>

</div>
<div class="big-img-container"><img class="big-img"></div>
<script type="application/javascript" src="js/tableController.js"></script>

<script>
    var categoryList,categoryDisplayElementsTemplate;
    var trElements;
    $(document).ready(function(){
//        TableController.methodName='product_list';
        trElements=TableController.prepareElement('.tr-template');
        TableController.init('user_company_list',handleTableContent);
        TableController.setOrder('user_create_time',false);
        TableController.getList();
        TableController.setPageEvent();
        registEvent();
        initCategory();
    });
    function registEvent(){
        $(document).on('click','.button',function(){
            var type=$(this).data('type');
            var id=this.id.slice(3);
//            console.log(id);
            switch(type){
                case 'edit':
                    var href=getHref('product_edit');
                    location.href=href+'&product_id='+id;
                    break;
                case 'search-name':
                    var text=$('.name-search-text').val();
                    TableController.filter.where[0]='product_name like "%'+text+'%"';
                    TableController.getList(handleTableContent);
                    break;
                case 'delete':
                    if(confirm('确定删除此商品？')){
                        deleteRecord('product',{product_id:id},function(){
                            TableController.getList();
                        })
                    }
                    break;
                default :
                    break;
            }
        });
        $(document).on('change','.category-select',function(){
            var id=this.value;
            var categoryFilter=null;
            $(this).nextAll('select').remove();
            if(id>0){
                var element=getSubCategoryElment(id);

                if(element){

                    $(this).after(element);
                    categoryFilter=getAllSubCategory(id);
                    categoryFilter.push(id);
                }else{
                    categoryFilter=id;
                }
            }
            if(categoryFilter){
                TableController.filter.where.category=categoryFilter;
            }else{
                delete TableController.filter.where.category;
            }
            TableController.getList(handleTableContent);
        });
        $(document).on('click','.img',function(){
            var src=$(this).attr('src');
            $('.big-img').attr('src',src);
            $('.big-img-container').show();
        })
        $(document).on('click','.big-img',function(){
            $('.big-img-container').hide();
        })
    }

    function handleTableContent(back){
//        console.log('handleTable');
        $('.tr-template').remove();
        $.each(back.list,function(k,v){
            var imgs= JSON.parse(v.img);
//            var attr=JSON.parse(v.product_attr);
//            if
//            console.log(imgs);
            var element = trElements('.tr-template');
            $.each(element.find('.content'), function (index, value) {
                $(value).text(v[$(value).data('field')]);
                $(value).removeAttr('data-field');
            });
//            element.find('.img').attr('src', imgs['product-img'][0]);
//            element.find('.edit').attr('id', 'edt'+v.product_id);
//            element.find('.delete').attr('id', 'del'+v.product_id);
//            element.find('.stock').attr('id','stk'+ v.product_id);
//            element.find('.priority').attr('id', v.product_id);
            $('.product-table').append(element);
        });
    }






</script>