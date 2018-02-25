<div class="pc-aside">
    <ul>
        <li>
            <h3 class="aside-title">我的发布<i class="icon icon-angle-right"></i></h3>
            <ol>
                <li class="li-cur"><a href="#">加工需求</a></li>
                <li><a href="#">采购需求</a></li>
                <li><a href="#">招标需求</a></li>
                <li><a href="#">询价需求</a></li>
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
                <li><a href="#">我的订单</a></li>
                <li><a href="#">收货地址</a></li>
                <li><a href="#">店铺订单</a></li>
                <li><a href="?href=pc_commodity_manage">商品管理</a></li>
                <li><a href="#">收到的询价</a></li>
            </ol>
        </li>
        <li>
            <h3 class="aside-title">店铺管理<i class="icon icon-angle-right"></i></h3>
            <ol>
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
            init();
        });
        function init(){
            ajaxPost('User','get_company_inf',{},function(back){
                console.log(back);
                var backValue=backHandle(back,function(value){

                },function(errCode,errMsg){
                    switch(errCode){
                        case 101:
                            location.href='?href=login';
                            break;
                        case 102:
                            location.href='?href=pc_company_profile'
                    }
//               console.log(errMsg);
                })
            });
        }
    </script>
</div>