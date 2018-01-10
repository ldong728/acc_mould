<?php
$opList = $GLOBALS['opList'];
if(!isset($opList))$opList=array();
$pmsList = $GLOBALS['pmsList'];
$pmsCount = count($pmsList);
?>

<div class="main">
    <table class="table sheet">
        <tr>
            <td>登录名</td>
            <td>密码</td>
            <?php foreach ($pmsList as $row): ?>
                <td>
                    <?php echo $row['name'] ?>
                </td>
            <?php endforeach ?>
        </tr>
        <?php foreach ($opList as $row): ?>
            <tr>
                <td><input type="text" class="alt-name textbox" id="name<?php echo $row['id'] ?>" value="<?php echo $row['name'] ?>" style="width: 70px"></td>
                <td><input type="text" class="alt-pwd textbox" id="pwd<?php echo $row['id'] ?>" value="<?php echo $row['pwd'] ?>" style="width: 70px"></td>
                <?php foreach ($row['pms'] as $k=>$v): ?>
                    <td>
                        <input type="checkbox" class="pms-alt" id="<?php echo $row['id'] ?>"
                               value="<?php echo $k ?>"<?php echo isset($v['checked']) ? 'checked="checked"' : '' ?>>
                    </td>
                <?php endforeach ?>
            </tr>
        <?php endforeach ?>
        <tr>
            <td>
                <input type="input" class="new-name"/>
            </td>
            <td>
                <input type="input" class="new-pwd"/>
            </td>
            <td>
                <a class="inner-button op-add-btn">
                    添加操作员
                </a>
            </td>
        </tr>


    </table>
</div>

<script src="js/md5.js"></script>
<script>
    $('.pms-alt').change(function () {
        var stu = $(this).prop('checked');
        var id = $(this).attr('id');
        var pms = $(this).val();
//        alert(pms);
        if(stu){
            addRecord('op_pms',{o_id:id,pms_id:pms},'update',function(){
                showToast('更改完成');
            });
        }else{
            deleteRecord('op_pms',{o_id:id,pms_id:pms})
        }

    });
    $('.alt-name').change(function () {
        var id = $(this).attr('id').slice(4);
        var name = $(this).val();
        altTable('operator','name',name,'id',id,function(){
            showToast('更改完成');
        })
    });
    $('.alt-pwd').change(function () {
        var id = $(this).attr('id').slice(3);
        var pwd = $(this).val();
        altTableBatch('operator',{pwd:pwd,md5:hex_md5(pwd)},'id',id,function(){
            showToast('更改完成');
        })
    });
    $('.op-add-btn').click(function () {
        var name = $('.new-name').val();
        var pwd = $('.new-pwd').val();
        if(name&&pwd){
            var creatorId=<?php echo $_SESSION[DOMAIN]['operator_id']?>;
            addRecord('operator',{name:name,pwd:pwd,creator:creatorId,md5:hex_md5(pwd)},'update',function(){
                location.reload(true);
            })
        }

    })

</script>