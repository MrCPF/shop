<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>首页</title>

    <link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
    <link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />

    <link href="/home/basic/css/demo.css" rel="stylesheet" type="text/css" />

    <link href="/home/css/hmstyle.css" rel="stylesheet" type="text/css"/>
    <link href="/home/css/skin.css" rel="stylesheet" type="text/css" />
    <script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
    <script src="/home/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>
    @yield('js')
</head>

<body>
<?php //echo'<pre>';print_r($good); ?>
<div class="hmtop">
    <!--顶部导航条 -->
    <div class="am-container header">
        @include('layouts.header')
<?php //echo '<pre>';print_r($goods_num);die;?>
    </div>
    <!--悬浮搜索框-->
    <div class="nav white">
        <div class="logo"><img src="/home/images/logo.png" /></div>
        <div class="logoBig">
            <li><img src="/home/images/logobig.png" /></li>
        </div>

        <div class="search-bar pr">
            <a name="index_none_header_sysc" href="#"></a>
            <form action="/home/storesearch" method="get">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$busines->busines_id}}">
                <input id="searchInput" name="search" value="{{$search}}" type="text" placeholder="商品名称" autocomplete="off">
                <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
            </form>
        </div>
    </div>
</div>

{{--轮播图--}}
@yield('slide')
<div class="shopNav">
    <div class="slideall">
        @if($good->goods_bid !== 0)
        <div class="long-title"><a href="/home/store/{{$good->goods_bid}}"><span class="all-goods" style="color:yellow">店铺首页</span></a></div>
        <div class="nav-cont">
          <!-- {{-- <ul>
                <li class="index"><a href="">店铺活动</a></li>
                <li class="qc"><a href="#">闪购</a></li>
                <li class="qc"><a href="#">限时抢</a></li>
                <li class="qc"><a href="#">团购</a></li>
                <li class="qc last"><a href="#">大包装</a></li>
            </ul>--}} -->

            <div class="nav-extra">
                <a href="/home/store/{{$good->goods_bid}}" style="color:yellow" >
                    <i class="am-icon-user-secret am-icon-md nav-user"></i>
                    {{$busines->busines_name}}

                    <i class="am-icon-angle-right" style="padding-left: 10px;"></i></a>
            </div>

        </div>

        @else

            <div class="long-title"><span class="all-goods">全部分类</span></div>
            <div class="nav-cont">
                <ul>
                    <li class="index"><a href="/home/index">首页</a></li>
                    <li class="qc"><a href="#">闪购</a></li>
                    <li class="qc"><a href="#">限时抢</a></li>
                    <li class="qc"><a href="#">团购</a></li>
                    <li class="qc last"><a href="#">大包装</a></li>
                </ul>
                <div class="nav-extra">
                    <i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
                    <i class="am-icon-angle-right" style="padding-left: 10px;"></i>
                </div>
            </div>
        @endif


        @yield('content')

        <div class="footer ">
            <div class="footer-hd ">
                <p>
                    <a href="# ">恒望科技</a>
                    <b>|</b>
                    <a href="# ">商城首页</a>
                    <b>|</b>
                    <a href="# ">支付宝</a>
                    <b>|</b>
                    <a href="# ">物流</a>
                </p>
            </div>
            <div class="footer-bd ">
                <p>
                    <a href="# ">关于恒望</a>
                    <a href="# ">合作伙伴</a>
                    <a href="# ">联系我们</a>
                    <a href="# ">网站地图</a>
                    <em>© 2015-2025 Hengwang.com 版权所有</em>
                </p>
            </div>
        </div>

    </div>
</div>
@yield('aside')
        <!--引导 -->



<!--菜单 -->
@include('layouts.right')
<script>
    window.jQuery || document.write('<script src="basic/js/jquery.min.js "><\/script>');
</script>
<script type="text/javascript " src="/home/basic/js/quick_links.js "></script>
@yield('js')
</body>



</html>




</html>



