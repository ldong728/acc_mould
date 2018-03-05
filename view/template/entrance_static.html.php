<div class="entrance">
    <div class="container">
        <ul class="entrance-l clearfix">
            <li>欢迎访问全球一站式模具采购服务平台！</li>
            <li>
                <?php if(isset($_SESSION['user'])):?>
                    <p class="li-login light">
                        欢迎您，用户<?=$_SESSION['user']['user_tel']?>
                        <a href="#" class="sign-out">退出</a>
                    </p>
                <?php else:?>
                    <p class="li-login light">
                        <a href="?href=login">[请登录]</a>
                        <a href="?href=regist">[免费注册]</a>
                    </p>
                <?php endif?>
            </li>
        </ul>
        <ul class="entrance-r clearfix">
            <li>
                <div class="entrance-li-show li-account clearfix">
                    <a href="#">我的账户</a>
                    <i class="icon icon-angle-down"></i>
                </div>
                <dl>
                    <dt></dt>
                    <dd><a href="?href=personal_center">个人中心</a></dd>
                </dl>
            </li>
            <li>
                <div class="entrance-li-show li-shop-cart clearfix">
                    <a href="#">购物车<span class="number">0</span></a>
                    <i class="icon icon-angle-down"></i>
                </div>
                <div class="entrance-li-none shop-cart-lists"></div>
            </li>
            <li>
                <div class="entrance-li-show li-vip">
                    <a href="#">VIP专属入口</a>
                </div>
            </li>
            <li>
                <div class="entrance-li-show li-supplier">
                    <a href="#">供应商入口</a>
                </div>
            </li>
            <li>
                <div class="entrance-li-show li-customer-server">
                    <a href="#">客服中心</a>
                </div>
            </li>
            <li>
                <p class="li-tel light">
                    <i class="icon icon-phone"></i> <span>客服：400-181-6600</span>
                </p>
            </li>
        </ul>

    </div>
</div>

<div class="header sh-header">
    <div class="sh-header-top">
        <div class="container">
            <div class="header-l">
                <a href="?href=index">
                <img src="images/logo.png" alt="logo">
                    </a>
            </div>
            <div class="header-m">
                <ul class="header-search-title clearfix">
                    <li class="li-cur">加工</li>
                    <li>采购</li>
                </ul>
                <div class="search-form">
                    <form method="post" action="#">
                        <i class="icon icon-search"></i>
                        <input type="text" placeholder="请输入关键字" name="skw">
                        <button type="button">搜 索</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="sh-header-introduction clearfix">
        <div class="container">
            <div class="sh-hi-left">
                <div class="title">
                    <h2 class="company-content name" data-field="company_name"></h2>
                    <span><img src="./images/qi2.png"></span>
                    <span><img src="./images/vip.png"></span>
                </div>
                <p class="text">
                    <img src="./images/addr.png">
                    <span></span>
                </p>
            </div>
            <div class="sh-hi-right">
                <span><img src="./images/phone2.png"></span>
                <span class="company-content content tel" data-field="company_tel"></span>
            </div>
        </div>
    </div>
</div>

<div class="sh-nav">
    <div class="container">
        <ul class="clearfix">
            <li class="company-nav" id="shop_home"><a href="?href=shop_home&static=1">店铺主页</a></li>
            <li class="company-nav" id="shop_company_profile"><a href="?href=shop_company_profile&static=1">公司简介</a></li>
            <li class="company-nav" id="shop_supply_goods"><a href="?href=shop_supply_goods&static=1">供应商品</a></li>
            <li class="company-nav" id="shop_certifications"><a href="?href=shop_certifications&static=1">资质证书</a></li>
            <li class="company-nav" id="shop_contact_us"><a href="?href=shop_contact_us&static=1">联系方式</a></li>
        </ul>
    </div>
</div>

<script>
    var currentStaticPage="<?=$_GET['href']?>";
    var companyInf=null;
    $(document).ready(function(){
        if(sessionStorage.companyInf){
            companyInf=JSON.parse(sessionStorage.companyInf);
            $('.name').text(companyInf.name||'');
            $('.tel').text(companyInf.tel||'');
        }
        $('#'+currentStaticPage).addClass('li-cur');
    });



</script>

