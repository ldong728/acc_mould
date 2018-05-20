<script>
    sessionStorage.currentCompanyId=<?=$_SESSION['user']['company']['company_id']?>;
</script>
<div class="pc-aside">
    <style>
        .left-a{
            cursor: pointer;;
        }
    </style>
    <ul>
        <li>
            <h3 class="aside-title">我的发布<i class="icon icon-angle-right"></i></h3>
            <ol>
                <li class="li-process-need"><a class="left-a my-button" id="process-need" data-href="personal_center">加工需求</a></li>
                <li class="li-purchase-need"><a class="left-a my-button" id="purchase-need" data-href="personal_center">采购需求</a></li>
                <li class="li-bidding-need"><a class="left-a my-button" id="bidding-need" data-href="personal_center">招标需求</a></li>
                <li class="li-product-need"><a class="left-a my-button" id="product-need" data-href="personal_center">询价需求</a></li>
            </ol>
        </li>
        <li>
            <h3 class="aside-title">报价管理<i class="icon icon-angle-right"></i></h3>
            <ol>
                <li><a href="#">加工报价</a></li>
                <li><a href="#">采购报价</a></li>
                <li><a href="#">我的投标</a></li>
                <li><a href="#">询价报价</a></li>
            </ol>
        </li>
        <li>
            <h3 class="aside-title">交易管理<i class="icon icon-angle-right"></i></h3>
            <ol>
                <li><a href="?href=pre_order">我的订单</a></li>
                <li><a href="#">收货地址</a></li>
                <li><a href="?href=pc_seller_order_list">店铺订单</a></li>
                <li><a href="?href=pc_commodity_manage">商品管理</a></li>
                <li><a href="#">收到的询价</a></li>
            </ol>
        </li>
        <li>
            <h3 class="aside-title">店铺管理<i class="icon icon-angle-right"></i></h3>
            <ol>
                <li><a href="?href=shop_home&static=1">我的店铺</a></li>
                <li><a href="?href=pc_company_profile">企业简介</a></li>
                <li><a href="?href=pc_contact_us">联系方式</a></li>
            </ol>
        </li>
        <li>
            <h3 class="aside-title">账号管理<i class="icon icon-angle-right"></i></h3>
            <ol>
                <li><a href="#">基本信息</a></li>
                <li><a href="?href=pc_company_profile">企业信息</a></li>
                <li><a href="#">修改密码</a></li>
                <li><a href="#">系统消息</a></li>
            </ol>
        </li>
    </ul>
    <script>
        $(document).ready(function(){
            initLeftNaveButton();
            init();
//            $(document).on('click','.my-company',function(){
//
//            });
        });
        function init(){
            ajaxPost('User','get_company_inf',{},function(back){
                console.log(back);
                var backValue=backHandle(back,function(value){
                    var press=getUrlParam('press');
//                    console.log(press);
                    if(press)$('#'+press).click();
                },function(errCode,errMsg){
                    switch(errCode){
                        case 101:
                            location.href='?href=login';
                            break;
                        case 102:
                            location.href='?href=pc_company_profile'
                    }
//               console.log(errMsg);
                });

            });
        }

        function initLeftNaveButton(){
            $(document).on('click','.left-a',function(){
                var currentHref=getUrlParam('href');
                var destinyHref=$(this).data('href');
                var aId=$(this).attr('id');
                if(destinyHref&&destinyHref!=currentHref){
                    location.href="?href="+destinyHref+'&press='+aId;
                }else{
                    setLeftAEvent(aId);
                }
            })
        }
        function setLeftAEvent(id){
//            console.log(id);
            $('.li-cur').removeClass('li-cur');
            $('.li-'+id).addClass('li-cur');
        }


    </script>
</div>