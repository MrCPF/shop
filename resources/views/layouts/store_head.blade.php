<!DOCTYPE HTML>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
    <link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />

    <link href="/home/basic/css/demo.css" rel="stylesheet" type="text/css" />
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="/home/css/hmstyle.css" rel="stylesheet" type="text/css"/>
    <link href="/home/css/skin.css" rel="stylesheet" type="text/css" />
    <script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
    <script src="/home/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>

    <link rel="stylesheet" href="/css/global.css"/>
    <link rel="stylesheet" href="/css/bts.css"/>
    <style>
        a{
            color:black;
            text-decoration:none;
        }
    </style>
    @yield('js')
</head>
<script>
    window.g_config=window.g_config||{};
    window.g_config.SearchbarFeature={
    };
</script>
<body class="pg">
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

<input type="hidden" value="ffd153b76863e" id="J_TbToken"/>

    <div id="content">
        <div class="minisite clearfix mv5" id="J_Minisite" data-flag="false" data-id="110416" data-brand11="false">
            <div>
                <a class="mb-logo" href="/home/store/{{$busines->busines_id}}" target="_self">
                    <img width="600" height="160" src="/home/images/store-inline.png" "/>
                </a>
            </div>
            <div class="m-brand">
                <a  href="/home/store/{{$busines->busines_id}}" target="_self">
                    <img width="90" height="120" src="{{$busines->busines_pic}}" style="border-radius: 10px;"/>
                </a>
            </div>
            <div class="m-portal">
                <div class="mp-shops j_MinisiteShops">
                    <a href="javascript:;" class="mps-prev mps-btn-disable j_MinisitePrev">&#139</a>
                    <div class="ks-switchable-content mps-inner">
                        <a class="mpsi-shop" href="/home/store/{{$busines->busines_id}}" target="_self" atpanel="1,389048191,,,spu-minisite,2,minisite,">
                            <i class="i-shop"></i>
                            <br>
                            <span>{{$busines->busines_name}}</span>
                        </a>
                    </div>
                    <a href="javascript:;" class="mps-next j_MinisiteNext">&#155</a>
                </div>
            </div>
            <div class="m-rich"><!--豪华版-->
                <a class="m-rich-box m-intro" href="/home/store/{{$busines->busines_id}}">
                    <h4>品牌介绍</h4>
                    <p>{{$busines->busines_desc}}</p>
                </a>
            </div>
        </div>


        @yield('store_head')

    </div>


</div>
@yield('aside')
<!--引导 -->
<!--菜单 -->
@include('layouts.right')
@yield('js')
</body>
</html>
</html>
