<?php

?>
<style>
    .img {
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
            <th>分类</th>
            <th>级别</th>
            <th>操作</th>

        </tr>
        <tr class="tr-template">
            <td class="content" data-field="user_tel"></td>
            <td class="content" data-field="company_name"></td>
            <td class="content" data-field="user_create_time"></td>
            <!--            <td class="content priority ipt-toggle" data-field="priority" data-tbl="product" data-col="priority" data-index="product_id"></td>-->
            <td class="select-content">
                <select class="type-select">
                    <option value="1" disabled selected>无类别</option>
                    <option value="模具厂">模具厂</option>
                    <option value="零件加工厂">零件加工厂</option>
                    <option value="钢材厂">钢材厂</option>
                    <option value="供应商">供应商</option>
                    <option value="主机厂">主机厂/一级零部件供应商</option>
                </select>
            </td>
            <td class="select-content">
                <select class="level-select">
                    <option value="1">免费会员</option>
                    <option value="2">采购会员</option>
                    <option value="3">模具会员</option>
                    <option value="4">VIP会员</option>
                </select>

            </td>
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
        <td>级别筛选：</td>
        <td><select class="level-filter">
                <option value="0">全部</option>
                <option value="1">免费会员</option>
                <option value="2">采购会员</option>
                <option value="3">模具会员</option>
                <option value="4">VIP会员</option>
            </select>
        </td>
        <td>类型筛选</td>
        <td>
            <select class="type-filter">
                <option value="0">全部</option>
                <option value="模具厂">模具厂</option>
                <option value="零件加工厂">零件加工厂</option>
                <option value="钢材厂">钢材厂</option>
                <option value="供应商">供应商</option>
                <option value="主机厂">主机厂/一级零部件供应商</option>
            </select>
        </td>

        <!--            <td>商品名搜索:</td><td><input class="name-search-text" type="text" placeholder="请输入关键字" maxlength="10"><button class="button" data-type="search-name" id="sch1">搜索</button></td>-->
        <!--        </tr>-->
    </table>
    <div>

    </div>

</div>
<div class="big-img-container"><img class="big-img"></div>
<script type="application/javascript" src="js/tableController.js"></script>

<script>
    var categoryList, categoryDisplayElementsTemplate;
    var trElements;
    $(document).ready(function () {
//        TableController.methodName='product_list';
        trElements = TableController.prepareElement('.tr-template');
        TableController.init('user_company_list', handleTableContent);
        TableController.setOrder('user_create_time', false);
        TableController.getList();
        TableController.setPageEvent();
        registEvent();
    });
    function registEvent() {
        $(document).on('click', '.button', function () {
            var type = $(this).data('type');
            var id = this.id.slice(3);
//            console.log(id);
            switch (type) {
                case 'edit':
                    var href = getHref('product_edit');
                    location.href = href + '&product_id=' + id;
                    break;
                case 'search-name':
                    var text = $('.name-search-text').val();
                    TableController.filter.where[0] = 'product_name like "%' + text + '%"';
                    TableController.getList(handleTableContent);
                    break;
                case 'delete':
                    if (confirm('确定删除此商品？')) {
                        deleteRecord('product', {product_id: id}, function () {
                            TableController.getList();
                        })
                    }
                    break;
                default :
                    break;
            }
        });
        $(document).on('change', '.level-filter', function () {
            var value = $(this).val();
            TableController.setfilter({user_level: value});
            TableController.getList(handleTableContent);
        });
        $(document).on('change', '.type-filter', function () {
            var value = $(this).val();
            TableController.setfilter({user_type: value});
            TableController.getList(handleTableContent);
        });
        $(document).on('change', '.level-select', function () {
            var id = $(this).attr('id').slice(3);
            var value = $(this).val();
            altTable('user', 'user_level', value, 'user_id', id, function (back) {
                showToast('修改完成')
            });
        });
        $(document).on('change', '.type-select', function () {
            var id = $(this).attr('id').slice(3);
            var value = $(this).val();
            altTable('user', 'user_type', value, 'user_id', id, function (back) {
                showToast('修改完成')
            });
        });

        $(document).on('click', '.img', function () {
            var src = $(this).attr('src');
            $('.big-img').attr('src', src);
            $('.big-img-container').show();
        })
        $(document).on('click', '.big-img', function () {
            $('.big-img-container').hide();
        });
    }

    function handleTableContent(back) {
//        console.log('handleTable');
        $('.tr-template').remove();
        $.each(back.list, function (k, v) {
            var imgs = JSON.parse(v.img);
//            var attr=JSON.parse(v.product_attr);
//            if
//            console.log(imgs);
            var element = trElements('.tr-template');
            $.each(element.find('.content'), function (index, value) {
                $(value).text(v[$(value).data('field')]);
                $(value).removeAttr('data-field');
            });
            var levelSelect = element.find('.level-select');
            var typeSelect = element.find('.type-select');
            levelSelect.attr('id', 'lvl' + v.user_id);
            levelSelect.val(v.user_level);
            typeSelect.attr('id', 'typ' + v.user_id);
            typeSelect.val(v.user_type);

//            element.find('.img').attr('src', imgs['product-img'][0]);
//            element.find('.edit').attr('id', 'edt'+v.product_id);
//            element.find('.delete').attr('id', 'del'+v.product_id);
//            element.find('.stock').attr('id','stk'+ v.product_id);
//            element.find('.priority').attr('id', v.product_id);
            $('.product-table').append(element);
        });
    }


</script>