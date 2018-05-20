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
        交易订单列表
    </div>
    <table class="table sheet detail-table" style="display: none">
        <tr>
            <td>订单编号：</td>
            <td class="detail-content" data-field="order_id"></td>
            <td>商品名称：</td>
            <td class="detail-content" data-field="product_name"></td>
            <td>价格：</td>
            <td><input class="text detail-content" data-field="total_price"></td>
        </tr>
        <tr>
            <td>卖方：</td>
            <td><span class="detail-content" data-field="seller_company_name"></span>:<span class="detail-content"
                                                                                            data-field="seller_company_tel"></span>
            </td>
            <td>买方：</td>
            <td><span class="detail-content" data-field="buyer_company_name"></span>:<span class="detail-content"
                                                                                           data-field="buyer_company_tel"></span>
            </td>
            <td>付款方式：</td>
            <td><input class="text detail-content" data-field="pay_type"></td>
        </tr>
        <tr>
            <td>运送方式：</td>
            <td><input class="text detail-content" data-field="shipping_type"></td>
            <td>运费：</td>
            <td><input class="text detail-content" data-field="shipping_fee"></td>
            <td>运单号：</td>
            <td><input class="text detail-content" data-field="shipping_order"></td>
        </tr>
        <tr>
            <td>商品参数：</td>
            <td class="attr-container" colspan="5"></span></p>
            </td>
        </tr>
        <tr>
            <td>操作：</td>
            <td colspan="5">
                <button class="button detail-pass">通过审核</button>
                <button class="button detail-save">保存修改</button>
                <button class="button detail-close">关闭</button>
            </td>
        </tr>


    </table>
    <table class="table sheet product-table">
        <tr>
            <th>订单号</th>
            <th>商品名</th>
            <th>卖家</th>
            <th>买家</th>
            <th>订单时间</th>
            <th>总价</th>
            <th>订单状态</th>
            <th>操作</th>

        </tr>
        <tr class="tr-template">
            <td class="content" data-field="order_id"></td>
            <td class="content" data-field="product_name"></td>
            <td class="content" data-field="seller_company_name"></td>
            <td class="content" data-field="buyer_company_name"></td>
            <td class="content" data-field="cart_time"></td>
            <td class="content" data-field="total_price"></td>
            <td class="status"></td>
            <td>
                <button class="button pass" data-type="pass">通过审核</button>
                <button class="button detail" data-type="detail">详细</button>
                <button class="button delete" data-type="delete">删除</button>
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
        <tr>
            <td>状态筛选：</td>
            <td class="status-select-container"><select class="status-template status-filter">
                    <option class="option-template"></option>
                </select></td>
            <!--            <td>商品名搜索:</td><td><input class="name-search-text" type="text" placeholder="请输入关键字" maxlength="10"><button class="button" data-type="search-name" id="sch1">搜索</button></td>-->
        </tr>
    </table>


</div>
<div class="big-img-container"><img class="big-img"></div>
<script type="application/javascript" src="js/tableController.js"></script>

<script>
    var statusList = {1: '购物车', 2: '询价中', 3: '已报价', 4: '待审核', 5: '待发货', 6: '已发货', 7: "已完成", 8: "审核未通过", 9: "已取消"};
    var statusDisplayElementsTemplate;
    var trElements;
    var currentId,currentStatus;
    $(document).ready(function () {
        trElements = TableController.prepareElement('.tr-template');
        TableController.init('cart_list', handleTableContent);
        TableController.setfilter({cart_status: [1, 2, 3, 4, 5, 6]});
        TableController.getList();
        TableController.setPageEvent();
        initStatus();
        registEvent();
    });
    function registEvent() {
        $(document).on('click', '.button', function () {
            var type = $(this).data('type');
            var id = this.id.slice(3);
//            console.log(id);
            switch (type) {
                case 'pass':
                    altTable('cart_detail', 'status', 5, 'cart_detail_id', id, function () {
                        showToast('审核完成');
                        TableController.getList();
                    });

                    break;
                case 'delete':
                    if (confirm('确定删除此记录？')) {
                        deleteRecord('cart_detail', {cart_detail_id: id}, function () {
                            TableController.getList();
                        })
                    }
                    break;
                case 'detail':
                    currentId=id;
                    getCartDetail(id);
                    $('.detail-table').show();
                    break;
                default :
                    break;
            }
        });
        $(document).on('click','.detail-pass',function(){
            altTable('cart_detail', 'status', 5, 'cart_detail_id', currentId, function () {
                $('.detail-table').hide();
                showToast('审核完成');
                TableController.getList();
            });
        });
        $(document).on('click','.detail-close',function(){
           $('.detail-table').hide();
        });
        $(document).on('click','.detail-save',function(){
            var keyValuePair={};
           $('input.detail-content').each(function(k,v){
               var key= $(v).data('field');
               var v= v.value;
               keyValuePair[key]=v;
           });
            altTableBatch('cart_detail',keyValuePair,'cart_detail_id',currentId,function(){
                $('.detail-table').hide();
                TableController.getList();
            });
        });
        $(document).on('change', '.status-filter', function () {
            var status = $(this).val();
            TableController.setfilter({cart_status: status});
            TableController.getList();
        });
    }

    function getCartDetail(id) {
        var buyerAttr, sellerAttr, img;
        ajaxPost('get_cart_detail', {id: id}, function (back) {
            backHandle(back, function (data) {
                $('.detail-content').each(function (k, v) {
                    var field = $(v).data('field');
                    var tagName = v.tagName.toLowerCase();
                    switch (tagName) {
                        case 'input':
                            $(v).val(data[field]);
                            if (parseInt(data.cart_status) > 4) {
                                console.log('readOnly');
                                $(v).attr('disabled', true);
                            }else{
                                $(v).removeAttr('disabled');
                            }
                            break;
                        default:
                            $(v).text(data[field]);
                            break;
                    }
                });
                try {
                    buyerAttr = JSON.parse(data.buyer_attr);
                    sellerAttr = JSON.parse(data.seller_attr);
                    img = JSON.parse(data.img);
                } catch (e) {
                    console.error(e);
                }
                var attrContainer=$('.attr-container');
                attrContainer.empty();
                $.each(sellerAttr,function(attrId,sellerAttr){
                    if(4==sellerAttr.attr_pms||5==sellerAttr.attr_pms||7==sellerAttr.attr_pms){
                        if('file'==sellerAttr.attr_type){
                            attrContainer.append('<p>'+sellerAttr.category_attr_name+ ': <a href="../'+sellerAttr.value+'">点击下载</a></p>')
                        }else{
                            attrContainer.append('<p>'+sellerAttr.category_attr_name+ ':&nbsp;'+sellerAttr.value+'&nbsp;'+sellerAttr.attr_unit+'</p>')
                        }
                    }
                });
                $.each(buyerAttr,function(attrId,buyerAttr){
                    if(4==buyerAttr.attr_pms||5==buyerAttr.attr_pms||7==buyerAttr.attr_pms){
                        if('file'==buyerAttr.attr_type){
                            attrContainer.append('<p>'+buyerAttr.category_attr_name+ ': <a href="../'+buyerAttr.value+'">点击下载</a></p>')
                        }else{
                            attrContainer.append('<p>'+buyerAttr.category_attr_name+ ':&nbsp;'+buyerAttr.value+'&nbsp;'+buyerAttr.attr_unit+'</p>')
                        }
                    }
                });
                if(4==data.cart_status){
                    $('.detail-pass').show()
                }else{
                    $('.detail-pass').hide();
                }
                if(4>=data.cart_status){
                    $('.detail-save').show();
                }else{
                    $('.detail-save').hide();
                }
            });
        });

    }
    function initStatus() {
        statusDisplayElementsTemplate = prepareElement('.status-template', '.option-template');
        var selector = statusDisplayElementsTemplate('.status-template');
        $.each(statusList, function (k, v) {
            var optionElement = statusDisplayElementsTemplate('.option-template');
            optionElement.attr('value', k)
            optionElement.text(v);
            selector.append(optionElement);
        });
        $('.status-select-container').append(selector);

    }

    function handleTableContent(back) {
        $('.tr-template').remove();
        $.each(back.list, function (k, v) {
            var imgs = JSON.parse(v.img);
            var element = trElements('.tr-template');
            $.each(element.find('.content'), function (index, value) {
                $(value).text(v[$(value).data('field')]);
                $(value).removeAttr('data-field');
                $(value).removeClass('content');
            });
            element.find('.img').attr('src', imgs['product-img'][0]);
            element.find('.pass').attr('id', 'edt' + v.cart_detail_id);
            element.find('.delete').attr('id', 'del' + v.cart_detail_id);
            element.find('.detail').attr('id', 'det' + v.cart_detail_id);
            element.find('.stock').attr('id', 'stk' + v.cart_detail_id);
            element.find('.priority').attr('id', v.cart_detail_id);
            element.find('.status').text(statusList[v.cart_status]);
            if (4 != v.cart_status)element.find('.pass').hide();
            $('.product-table').append(element);
        });
    }


</script>