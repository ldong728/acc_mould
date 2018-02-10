<div class="entrance">
    <div class="container">
        <ul class="entrance-l clearfix">
            <li>欢迎访问模具集成服务平台！</li>
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
                    <i class="icon icon-phone"></i> <span>客服：400-888-888</span>
                </p>
            </li>
        </ul>
    </div>
</div>

<div class="header">
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
        <div class="header-r">
            <p class="wx-code">
                <img src="images/wx-code.jpg" alt="微信二维码">
            </p>
            <p class="wx-text">关注官方微信</p>
        </div>
    </div>
</div>

<div class="nav">
    <div class="container">
        <div class="nav-lists">
            <h3 class="purchase primary-background">一站式采购解决方案</h3>
            <ul class="service-lists hover">
                <li>
                    <a class="main-category" href="#" id="mct1">
                        <span class="img"><img src="images/icon1.png"></span>
                        <span class="text">模具钢</span>
                    </a>
                </li>
                <li>
                    <a class="main-category" href="#" id="mct2">
                        <span class="img"><img src="images/icon2.png"></span>
                        <span class="text">模架</span>
                    </a>
                </li>
                <li>
                    <a class='main-category' href="#" id="mct3">
                        <span class="img"><img src="images/icon3.png"></span>
                        <span class="text">热流道</span>
                    </a>
                </li>
                <li>
                    <a class='main-category' href="#" id="mct4">
                        <span class="img"><img src="images/icon4.png"></span>
                        <span class="text">标准件</span>
                    </a>
                </li>
                <li>
                    <a class='main-category' href="#" id="mct5">
                        <span class="img"><img src="images/icon5.png"></span>
                        <span class="text">电极（石墨）</span>
                    </a>
                </li>
                <li>
                    <a class='main-category' href="#" id="mct6">
                        <span class="img"><img src="images/icon6.png"></span>
                        <span class="text">模具油缸</span>
                    </a>
                </li>
                <li>
                    <a class='main-category' href="#" id="mct7">
                        <span class="img"><img src="images/icon7.png"></span>
                        <span class="text">刀具</span>
                    </a>
                </li>
                <li>
                    <a class='main-category' href="#" id="mct8">
                        <span class="img"><img src="images/icon9.png"></span>
                        <span class="text">模具加工设备</span>
                    </a>
                </li>
                <li>
                    <a class='main-category' href="#" id="mct19">
                        <span class="img"><img src="images/icon8.png"></span>
                        <span class="text">耗材</span>
                    </a>
                </li>
                <li>
                    <a href="?href=mold_bidding">
                        <span class="img"><img src="images/icon10.png"></span>
                        <span class="text">模具招投标</span>
                    </a>
                </li>
            </ul>
        </div>

        <ul class="nav-bar">
            <li><a href="?href=index">首页</a></li>
            <li class="li-cur"><a href="?href=process">我要加工</a></li>
            <li><a href="?href=purchase">我要采购</a></li>
            <li><a href="?href=purchase_info">采购信息</a></li>
            <li><a href="?href=mold_bidding">模具招投标</a></li>
            <li><a href="?href=forum">技术论坛</a></li>
            <li><a href="?href=training">招聘培训</a></li>
            <li><a href="?href=finance_serve">金融服务</a></li>
        </ul>
    </div>
</div>
<script>
    $('.main-category').click(function(){
       var categoryId=$(this).attr('id').slice(3);
        sessionStorage.currentCategoryId=categoryId;
        location.href='?href=purchase';
    });
    $('.sign-out').click(function(){
        ajaxPost('User','sign_out',{},function(back){
            location.href='?href=index';
        })
    })
</script>