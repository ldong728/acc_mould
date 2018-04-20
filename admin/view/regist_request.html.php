<?php

?>
<div class="block">
    <div class="head">
        供应商列表
    </div>
    <table class="table sheet">
        <thead>
        <tr>
            <th>名称</th>
            <th>地址</th>
            <th>联系电话</th>
            <th>申请级别</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody class="company-table">
        <tr class="tr-template">
            <td class="content" data-field="company_name"></td>
            <td class="content" data-field="address"></td>
            <td class="content" data-field="mobile_phone"></td>
            <td class="content" data-field="user_level_name"></td>
            <td>
                <button class="button pass" data-type="pass">通过</button>
                <button class="button reject" data-type="reject">驳回</button>
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
//        TableController.methodName = 'company_list';
        TableController.init('regist_request_list', backDataHandle);
        TableController.setPageEvent();
        TableController.setOrder('submit_time',false);
        TableController.getList();


        registEvent();


    });
    function registEvent() {
        $(document).on('click', '.button', function () {
            var type = $(this).data('type');
            var id = this.id.slice(3);
            console.log(id);
            switch (type) {
                case 'pass':
                    var level=$(this).data('level');
                    ajaxPost('pass_level',{id:id,level:level},function(back){
                        location.reload(true);
                    });
//                    alert(id);


                default :
                    break;
            }
        });

    }
    function backDataHandle(back) {
        console.log(back);
        $('.tr-template').remove();
        $.each(back.list, function (k, v) {
            var element = elements('.tr-template');
            $.each(element.find('.content'), function (index, value) {
                console.log($(value).data('field'));
                console.log(v);
                $(value).text(v[$(value).data('field')]);
                $(value).removeAttr('data-field');
//                    console.log(value);
//                    delete value.data-field;
            });
            element.find('.proirity').attr('id', v.company);
            element.find('.pass').attr('id', 'pss' + v.company);
            element.find('.pass').attr('data-level', v.level);
            element.find('.delete').attr('id', 'del' + v.company);
            $('.company-table').append(element);
        });
    }


    //    function
</script>
