<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

    <title>个人中心</title>

    <link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
    <link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
    <link href="/home/css/personal.css" rel="stylesheet" type="text/css">
    <link href="/home/css/systyle.css" rel="stylesheet" type="text/css">

    @yield('js')
</head>

<body>
<!--头 -->
<header>
    <article>
        <div class="mt-logo">
            <!--顶部导航条 -->
            <div class="am-container header">
                @include('layouts.header')
            </div>

            <!--悬浮搜索框-->

            <div class="nav white">
                <div class="logoBig">
                    <li><img src="/home/images/logobig.png" /></li>
                </div>

                <div class="search-bar pr">
                    <a name="index_none_header_sysc" href="#"></a>
                    <form>
                        <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
                        <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
                    </form>
                </div>
            </div>

            <div class="clear"></div>
        </div>
        </div>
    </article>
</header>
<div class="nav-table">
    <div class="long-title"><span class="all-goods">全部分类</span></div>
    <div class="nav-cont">
        <ul>
            <li class="index"><a href="/home/index">首页</a></li>
           {{-- <li class="qc"><a href="#">闪购</a></li>
            <li class="qc"><a href="#">限时抢</a></li>
            <li class="qc"><a href="#">团购</a></li>
            <li class="qc last"><a href="#">大包装</a></li>--}}
        </ul>
        <div class="nav-extra">
            <i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
            <i class="am-icon-angle-right" style="padding-left: 10px;"></i>
        </div>
    </div>
</div>
<b class="line"></b>
<div style="text-align: center;color:red;">

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@yield('content')
        <!--底部-->
<div class="footer">
    <div class="footer-hd">
        <p>
            <a href="#">恒望科技</a>
            <b>|</b>
            <a href="#">商城首页</a>
            <b>|</b>
            <a href="#">支付宝</a>
            <b>|</b>
            <a href="#">物流</a>
        </p>
    </div>
    <div class="footer-bd">
        <p>
            <a href="#">关于恒望</a>
            <a href="#">合作伙伴</a>
            <a href="#">联系我们</a>
            <a href="#">网站地图</a>
            <em>© 2015-2025 Hengwang.com 版权所有</em>
        </p>
    </div>
</div>

</div>

<aside class="menu">
    <ul>
        <li class="person active">
            <a href="/home/user">个人中心</a>
        </li>
        <li class="person">
            <a href="">个人资料</a>
            <ul>
                <li> <a href="/home/userInfo">个人信息</a></li>
                <li> <a href="/home/safe">安全设置</a></li>
                <li> <a href="/home/address">收货地址</a></li>
            </ul>
        </li>
        <li class="person">
            <a href="#">我的交易</a>
            <ul>
                <li><a href="/home/userinfo">订单管理</a></li>
                {{--<li> <a href="/home/orderrefund">退款售后</a></li>--}}
            </ul>
        </li>
        {{--<li class="person">
            <a href="#">我的资产</a>
            <ul>
                <li> <a href="coupon.html">优惠券 </a></li>
                <li> <a href="bonus.html">红包</a></li>
                <li> <a href="bill.html">账单明细</a></li>
            </ul>
        </li>--}}

        <li class="person">
            <a href="#">我的小窝</a>
            <ul>
                {{--<li> <a href="collection.html">收藏</a></li>
                <li> <a href="foot.html">足迹</a></li>--}}
                <li> <a href="/home/evalList">评价</a></li>
                {{--<li> <a href="news.html">消息</a></li>--}}
            </ul>
        </li>

    </ul>

</aside>
</div>
<!--引导 -->
<div class="navCir">
    <li><a href="../home/home.html"><i class="am-icon-home "></i>首页</a></li>
    <li><a href="../home/sort.html"><i class="am-icon-list"></i>分类</a></li>
    <li><a href="../home/shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>
    <li class="active"><a href="index.html"><i class="am-icon-user"></i>我的</a></li>
</div>
</body>
</html>