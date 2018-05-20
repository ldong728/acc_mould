<div class="block">
    <div class="head">
        招标
    </div>
    <table class="table sheet">
        <thead>
        <tr>
            <th>名称</th>
            <th>企业名称</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody class="company-table">
        <tr class="tr-template">
            <td class="content" data-field="bidding_title"></td>
            <td class="content" data-field="company_name"></td>
            <td><select class="status-select"><option value="1">审核中</option><option value="2">通过审核</option><option value="3">自营</option></select></td>
            <td>
                <button class="button quote" data-type="quote">投标列表</button>
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
    <table class="table">
        <tr>
            <td>状态筛选：</td>
            <td class="status-select-container"><select class="status-template status-filter">
                    <option value="0">全部</option>
                    <option value="1">审核中</option>
                    <option value="2">通过审核</option>
                    <option value="3">自营</option>
                </select></td>
            <!--            <td>商品名搜索:</td><td><input class="name-search-text" type="text" placeholder="请输入关键字" maxlength="10"><button class="button" data-type="search-name" id="sch1">搜索</button></td>-->
        </tr>
    </table>

</div>
<script type="application/javascript" src="js/tableController.js"></script>
<script>
    var elements;
    $(document).ready(function () {
        elements = TableController.prepareElement('.tr-template');
        TableController.init('bidding_list', backDataHandle);
        TableController.setPageEvent();
        TableController.setOrder('start_time',false);
        console.log(TableController);
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
                    var href = getHref('tender_manage');
                    if(href){
                        location.href = href + '&biding_inquiry_id=' + id;
                        break;
                    }
                    break;
                case 'delete':
                    if(confirm('确认要删除？')){
                        deleteRecord('bidding',{bidding_id:id},function(back){
                            showToast('删除成功');
                            TableController.getList();
                        });
                    }
                    break;
                default :
                    break;
            }
        });
        $(document).on('change','.status-select',function(){
            var id=this.id.slice(3);
            var value=this.value;
            altTable('bidding','status',value,'bidding_id',id,function(){
                showToast('修改成功')
            })
        });
        $(document).on('change', '.status-filter', function () {
            var status = $(this).val();
            if('0'==status)status=[1,2,3];
            TableController.setfilter({status: status});
            TableController.getList();
        });
    }
    function backDataHandle(back) {
        console.log(back);
        $('.tr-template').remove();
        $.each(back.list, function (k, v) {
            var element = elements('.tr-template');
            $.each(element.find('.content'), function (index, value) {
                if($(value).hasClass('source'))$(value).attr('href','../'+ v.attachment);
                if($(value).hasClass('list-source'))$(value).attr('href','../'+ v.list_attachment);
                $(value).text(v[$(value).data('field')]);
                $(value).removeAttr('data-field');
            });
            element.find('.quote').attr('id', 'quo' + v.bidding_id);
            element.find('.delete').attr('id','del'+ v.bidding_id);
            element.find('.detail').attr('id', 'det' + v.bidding_id);
            element.find('.status-select').attr('id','stu'+ v.bidding_id);
            element.find('.status-select').val(v.status);
            $('.company-table').append(element);
        });
    }


</script>