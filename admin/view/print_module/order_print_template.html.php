<?php $count=1?>
<link rel="stylesheet" type="text/css" media="print" href="stylesheet/print.css?v=<?=rand(1000, 9999) ?>">
<div class="main-title">销售清单</div>
<div class="info-container">
    <table class="info" width="100%">
        <tr>
            <td width="50%">单号：<?=$orderInf['order_id']?></td>
            <td width="50%">日期：<?=$orderInf['create_time']?></td>
        </tr>
        <tr>
            <td>收货人：<?=$orderInf['customer_name']?></td>
            <td>电话：<?=$orderInf['customer_tel']?></td>
        </tr>
        <tr>
            <td>收货地址：<?=$orderInf['customer_address']?></td>
            <td>交货日期：<?=$orderInf['delivery_time']?></td>
        </tr>
    </table>
</div>

<div class="detail-container">
    <table class="detail">
        <tr><td>序号</td>
            <td>名称</td>
            <td>型号</td>
            <td>价格</td>
            <td>单位</td>
            <td>数量</td>
            <td>小计</td>
        </tr>
        <?php foreach($orderDetail as $row):?>
        <tr>
            <td><?=$count++?></td>
            <td><?=$row['product_name']?></td>
            <td><?=$row['product_sn']?></td>
            <td>￥<?=$row['price']?></td>
            <td><?=$row['unit']?></td>
            <td><?=$row['amount']?></td>
            <td>￥<?=number_format(($row['amount']*$row['price']),2)?></td>
        </tr>
        <?php endforeach?>
        <tr>
            <td>合计</td>
            <td colspan="6">￥<?=$orderInf['total_fee']?><?php if((float)($orderInf['discount'])):?>(含折扣<?=$orderInf['discount']?>)<?php endif?></td>
        </tr>
        <tr>
            <td colspan="7">备注：<?=$orderInf['remark']?></td>
        </tr>
    </table>
    <br/>
    <table class="info" width="100%">
        <tr>
            <td width="70%"></td>
            <td width="30%">收货人签名：</td>
        </tr>
    </table>
</div>
