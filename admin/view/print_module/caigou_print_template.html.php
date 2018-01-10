<?php $count=1 ?>
<link rel="stylesheet" type="text/css" media="print" href="stylesheet/print.css?v=<?=rand(1000, 9999) ?>">
<div class="main-title">采购清单</div>
<div class="info-container">
    <table class="info" width="100%">
        <tr>
            <td width="50%">地址：浙江慈溪市长河镇沧田工业区</td>
            <td width="50%">座机电话：0574-63409158</td>
        </tr>
        <tr>
            <td>供应商地址：<?=$caigouInf['address']?></td>
            <td>CONA采购：</td>
        </tr>
        <tr>
            <td>供应商联系人：<?=$caigouInf['contact']?></td>
            <td>联系电话：</td>
        </tr>
        <tr>
            <td>供应商联系电话：<?=$caigouInf['tel']?></td>
            <td>订单号：<?=$caigouInf['caigou_id']?></td>
        </tr>
        <tr>
            <td>订货日期：<?=$caigouInf['create_time']?></td>
            <td>交货日期：<?=$caigouInf['delivery_time']?></td>
        </tr>
    </table>
</div>

<div class="detail-container">
    <table class="detail">
        <tr>
            <td>序号</td>
            <td>产品图片</td>
            <td>产品名称</td>
            <td>产品型号</td>
            <td>规格</td>
            <td>数量</td>
            <td>单位</td>
            <td>价格</td>
            <td>金额</td>
            <td>备注</td>
        </tr>
        <?php foreach($caigouDetail as $row):?>
            <tr>
                <td><?=$count++?></td>
                <td><img src="<?=$row['img']?>"</td>
                <td><?=$row['name']?></td>
                <td><?=$row['sn']?></td>
                <td><?=$row['type']?></td>
                <td><?=$row['amount']?></td>
                <td><?=$row['unit']?></td>
                <td>￥<?=$row['price']?></td>
                <td>￥<?=number_format(($row['amount']*$row['price']),2)?></td>
                <td class="temp"></td>
            </tr>
        <?php endforeach?>
        <tr>
            <td>合计</td>
            <td colspan="9">￥<?=$caigouInf['total_fee']?></td>
        </tr>
        <tr>
            <td>备注：</td>
            <td colspan="9"><?=$caigouInf['remark']?></td>
        </tr>
    </table>
    <br/>
    <table class="info" width="100%">
        <tr>
            <td width="65%">采购方（签字）：</td>
            <td width="35%">供应方（签字）：</td>
        </tr>
        <tr>
            <td>盖章</td>
            <td>盖章</td>
        </tr>
        <tr><td colspan="2" ></td></tr>
    </table>
</div>
