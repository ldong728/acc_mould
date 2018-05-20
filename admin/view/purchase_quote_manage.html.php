<?php global $purchaseId?>
<script>
    var purchaseId = <?=$purchaseId?>;
</script>
<div class="block">
    <div class="head">
        加工需求报价
    </div>
    <table class="table sheet">
        <thead>
        <tr>
            <th>名称</th>
            <th>报价</th>
            <th>图纸</th>
            <th>报价时间</th>
            <th>公司名称</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody class="company-table">
        <tr class="tr-template">
            <td class="content" data-field="purchase_title"></td>
            <td class="content" data-field="price"></td>
            <td><a class="content source" data-field="attachment">点击下载</a></td>
            <td class="content" data-field="quote_time"></td>
            <td class="content" data-field="quote_company_name"></td>
            <td><select class="status-select"><option value="1">审核中</option><option value="2">通过审核</option><option value="2">审核不通过</option></select></td>
            <td>
                <button class="button delete" data-type="delete">删除</button>
            </td>
        </tr>
        </tbody>
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

</div>
<script type="application/javascript" src="js/tableController.js"></script>
<script>
    var elements;
    $(document).ready(function () {
        elements = TableController.prepareElement('.tr-template');
        TableController.init('purchase_quote_list', backDataHandle);
        if(purchaseId)TableController.setfilter({purchase:purchaseId});
        TableController.setPageEvent();
//        TableController.setOrder('start_time',false);
        TableController.getList();
        registEvent();


    });
    function registEvent() {
        $(document).on('click', '.button', function () {
            var type = $(this).data('type');
            var id = this.id.slice(3);
            console.log(id);
            switch (type) {
                case 'quote':
                    var href = getHref('purchase_quote_manage');
                    location.href = href + '&purchase_id=' + id;
                    break;
                case 'delete':
                    if(confirm('确认要删除？')){
                        deleteRecord('purchase_quote',{purchase_quote_id:id},function(back){
                            showToast('删除成功');
                            TableController.getList();
                        });
                    }

                default :
                    break;
            }
        });
        $(document).on('change','.status-select',function(){
            var id=this.id.slice(3);
            var value=this.value;
            altTable('purchase_quote','status',value,'purchase_quote_id',id,function(){
                showToast('修改成功')
            })
        })

    }
    function backDataHandle(back) {
        console.log(back);
        $('.tr-template').remove();
        $.each(back.list, function (k, v) {
            var element = elements('.tr-template');
            $.each(element.find('.content'), function (index, value) {
                if($(value).hasClass('source')){
                    $(value).attr('href','../'+ v[$(value).data('field')]);
                }else{
                    $(value).text(v[$(value).data('field')]);
                }
                $(value).removeAttr('data-field');
            });
//            element.find('.proirity').attr('id', v.company_id);
            element.find('.quote').attr('id', 'quo' + v.purchase_quote_id);
            element.find('.delete').attr('id','del'+v.purchase_quote_id);
            element.find('.detail').attr('id', 'det' + v.purchase_quote_id);
            element.find('.status-select').attr('id','stu'+ v.purchase_quote_id);
            element.find('.status-select').val(v.status);
//            element.find('.delete').attr('id', 'del' + v.company_id);
            $('.company-table').append(element);
        });
    }


    //    function
</script>