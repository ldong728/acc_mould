<?php

?>
<style>
    .search-input {
        width: 100px;
        min-width: 30px;
    }
    .search-button {
        width: 60px;
        min-width: 30px;
    }
    .img {
        width: 60px;
        height: auto;
    }
</style>
<div class="block">
    <div class="head">
        进货列表
    </div>
    <table class="table sheet pre-purchase-table" style="display: none">
        <thead>
        <tr>
            <td>品名</td>
            <td>序列号</td>
            <td>数量</td>
            <td>操作</td>
        </tr>
        </thead>
        <tbody class="pre-purchase">
        <tr class="pre-purchase-tr">
            <td class="name"></td>
            <td class="sn"></td>
            <td><button class="button minus" data-type="number-button" style="width: 30px;min-width: 30px;display: none">-</button><input class="purchase-number" type="number" style="width: 50px"><button class="button plus" data-type="number-button" style="width: 30px;min-width: 20px;display: none">+</button></td>
            <td><button class="button remove"  data-type="remove">移除</button></td>
        </tr>
        </tbody>
        <tfoot>
            <tr><td colspan="2">选择供应商：<span class="provider-container"></span></td><td colspan="2"><button class="button" data-type="submit">提交此笔记录</button></td></tr>
        </tfoot>
    </table>

    <div class="space"></div>
    <div class="head">
        待选列表
    </div>
    <table class="table">
        <tr>
            <td>选择类别：</td><td class="category-filter"><select class="category-template category-select"><option class="option-template"></option></select></td>
            <td>按名称搜索:</td><td><input class="name-search-text search-input" type="text" placeholder="输入名称" maxlengtd="10"><button class="button search-button button-after-input" data-type="search-name" id="sch1">搜索</button></td>
            <td>按序列号搜索:</td><td><input class="sn-search-text search-input" type="text" placeholder="输入序列号" maxlengtd="10"><button class="button search-button button-after-input" data-type="search-sn" id="sch1">搜索</button></td>
        </tr>
    </table>
    <table class="table sheet prepare-table" style="display: none">
        <tr>
            <td>主图</td>
            <td>名称</td>
            <td>序列号</td>
            <td>库存</td>
            <td>操作</td>

        </tr>
        <tr class="prepare-tr-template">
            <td><img class="img" alt="主图"></td>
            <td class="content" data-field="name"></td>
            <td class="content" data-field="sn"></td>
            <td class="content" data-field="stock"></td>
            <td>
                <button class="button add" data-type="add">添加</button>
            </td>
        </tr>
    </table>

</div>



</script>