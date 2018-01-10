<?php

$pmsList=$GLOBALS['pmsList'];
$subMenuList=$GLOBALS['subMenuList'];
//global $pmsList,$subMenuList;
?>
<div id="core" style="height: 658px;">
    <div class="block">
        <div class="head" style="width: 98%;"><span>控制选项</span></div>
        <div class="main">
            <table class="table sheet">
                <tr class="h">
                    <td width="100px">所属组</td>
                    <td width="80px">选项名</td>
                    <td width="80px">关键字</td>
                </tr>
                <?php foreach($subMenuList as $row):?>
                    <tr>
                        <td id="<?php echo $row['s_id']?>" data-tbl="sub_menu" data-col="parent_id" data-index="id">
                            <select class="select">
                                <option value="-1">无分组</option>
                                <?php foreach($pmsList as $pRow):?>
                                    <option value="<?php echo $pRow['id']?>"  <?php echo $pRow['id']==$row['f_id']? 'selected="selected"':''?>><?php echo $pRow['name'] ?></option>
                                <?php endforeach?>
                            </select>
                        </td>
                        <td><?php echo $row['s_name']?></td>
                        <td><?php echo $row['s_key']?></td>
                    </tr>
                <?php endforeach ?>

            </table>
        </div>
    </div>
    <div class="block">
        <div class="head" style="width:98%"><span>分组选项</span></div>
        <div class="main">
            <table class="table sheet">
                <?php foreach ($pmsList as $row):?>
                <tr class="h">
                    <td width="130px" class="ipt-toggle" id="<?php echo $row['id']?>" data-tbl="pms" data-col="name" data-index="id"><?php echo $row['name']?></td>
                    <td width="130px"><button class="button del-pms" id="<?php echo 'del'.$row['id']?>">删除</button></td>
                </tr>
                <?php endforeach ?>
                <tr>
                    <td colspan="3"><button class="button add-pms">添加权限</button></td>
                </tr>
            </table>
        </div>

    </div>
    <div class="space"></div>
    <script>
        $('.del-pms').click(function(){
            var id=$(this).attr('id').slice(3);
            deleteRecord('pms',{id:id},function(){
               window.location.reload(true);
            });
        })
        $('.add-pms').click(function(){
            addRecord('pms',{key_word:getRandStr(10),name:'新增权限'},'ignore',function(){
                window.location.reload(true);
            })
        });


    </script>

<!--    <script>-->
<!--        $(document).on('change','.select',function(){-->
<!--            console.log('select changed')-->
<!--            var value=$(this).val()-->
<!--            console.log(value);-->
<!--            //var id=$(this).parent().data('')-->
<!--        })-->
<!--    </script>-->

</div>