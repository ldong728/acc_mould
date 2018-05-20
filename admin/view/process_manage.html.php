<div class="block">
    <div class="head">
        加工需求
    </div>
    <table class="table sheet">
        <thead>
        <tr>
            <th>名称</th>
            <th>工序</th>
            <th>图纸</th>
            <th>详细说明</th>
            <th>公司名称</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody class="company-table">
        <tr class="tr-template">
            <td class="content" data-field="process_need_title"></td>
            <td class="content" data-field="process_steps"></td>
            <td><a class="content source">点击下载</a></td>
            <td class="content" data-field="detail"></td>
            <td class="content" data-field="company_name"></td>
            <td><select class="status-select"><option value="1">审核中</option><option value="2">通过审核</option><option value="3">自营</option></select></td>
            <td>
                <button class="button quote" data-type="quote">报价列表</button>
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
        TableController.init('process_list', backDataHandle);
        TableController.setPageEvent();
        TableController.setOrder('start_time',false);
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
                    var href = getHref('process_quote_manage');
                    location.href = href + '&process_need_id=' + id;

                    break;
                case 'delete':
                    if(confirm('确认要删除？')){
                        deleteRecord('process_need',{process_need_id:id},function(back){
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
            altTable('process_need','status',value,'process_need_id',id,function(){
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
                $(value).text(v[$(value).data('field')]);
                $(value).removeAttr('data-field');
            });
            element.find('.quote').attr('id', 'quo' + v.process_need_id);
            element.find('.delete').attr('id','del'+ v.process_need_id);
            element.find('.detail').attr('id', 'det' + v.process_need_id);
            element.find('.status-select').attr('id','stu'+ v.process_need_id);
            element.find('.status-select').val(v.status);
            $('.company-table').append(element);
        });
    }


</script>