@extends('layouts.home')
@section('content')
        @section('slide')
            @include('layouts.slide')
        @endsection
        <!--侧边导航 -->
    @section('slide')
        @include('layouts.slide')
    @endsection
        <div id="nav" class="navfull">
            <div class="area clearfix">
                <div class="category-content" id="guide_2">

                    <div class="category">
                        <ul class="category-list" id="js_climit_li">

                            @foreach($tops as $top)
                                <li class="appliance js_toggle relative first">
                                <div class="category-info">
                                    <h3 class="category-name b-category-name"><i><img src="/home/images/cake.png"></i><a class="ml-22" title="{{$top->cats_name}}">{{$top->cats_name}}</a></h3>
                                    <em>&gt;</em></div>
                                <div class="menu-item menu-in top">
                                    <div class="area-in">
                                        <div class="area-bg">
                                            <div class="menu-srot">

                                                <div class="sort-side">

                                                    @foreach($sons as $son)
                                                        @if($son->cats_pid === $top->cats_id)
                                                        <dl class="dl-sort">

                                                            <dt><span title="{{$son->cats_name}}">{{$son->cats_name}}</span></dt>




                                                            @foreach($sons as $sun)
                                                                @if($sun->cats_pid == $son->cats_id)


                                                            <dd><a title="{{$sun->cats_name}}" target="_self" href="cat/{{$sun->cats_id}}"><span>{{$sun->cats_name}}</span></a></dd>

                                                                @endif
                                                            @endforeach

                                                        </dl>
                                                        @endif
                                                    @endforeach

                                                </div>
                                                <div class="brand-side">
                                                    <dl class="dl-sort"><dt><span>实力商家</span></dt>
                                                        @foreach($busines as $v)
                                                        <dd><a rel="nofollow"  target="_self" href="/home/store/{{$v->busines_id}}" rel="nofollow"><span class="red" >{{$v->busines_name}}</span></a></dd>
                                                        @endforeach
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <b class="arrow"></b>
                            </li>
                           @endforeach

                        </ul>
                    </div>
                </div>

            </div>
        </div>


        <!--轮播-->

        <script type="text/javascript">
            (function() {
                $('.am-slider').flexslider();
            });
            $(document).ready(function() {
                $("li").hover(function() {
                    $(".category-content .category-list li.first .menu-in").css("display", "none");
                    $(".category-content .category-list li.first").removeClass("hover");
                    $(this).addClass("hover");
                    $(this).children("div.menu-in").css("display", "block")
                }, function() {
                    $(this).removeClass("hover")
                    $(this).children("div.menu-in").css("display", "none")
                });
            })
        </script>



        <!--小导航 -->
        <div class="am-g am-g-fixed smallnav">
            <div class="am-u-sm-3">
                <a href="sort.html"><img src="/home/images/navsmall.jpg" />
                    <div class="title">商品分类</div>
                </a>
            </div>
            <div class="am-u-sm-3">
                <a href="#"><img src="/home/images/huismall.jpg" />
                    <div class="title">大聚惠</div>
                </a>
            </div>
            <div class="am-u-sm-3">
                <a href="#"><img src="/home/images/mansmall.jpg" />
                    <div class="title">个人中心</div>
                </a>
            </div>
            <div class="am-u-sm-3">
                <a href="#"><img src="/home/images/moneysmall.jpg" />
                    <div class="title">投资理财</div>
                </a>
            </div>
        </div>

        <!--走马灯 -->

        @include('layouts.marqueen')
        <div class="clear"></div>
    </div>
    <script type="text/javascript">
        if ($(window).width() < 640) {
            function autoScroll(obj) {
                $(obj).find("ul").animate({
                    marginTop: "-39px"
                }, 500, function() {
                    $(this).css({
                        marginTop: "0px"
                    }).find("li:first").appendTo(this);
                })
            }
            $(function() {
                setInterval('autoScroll(".demo")', 3000);
            })
        }
    </script>
</div>
<div class="shopMainbg">
    <div class="shopMain" id="shopmain">

        @foreach($sons as $son)
            @if($son->lev == 2 && $son->cats_pid == 11)
            <div id="f1">
        <!--甜点-->
        <div class="am-container ">
            <div class="shopTitle ">
                <h4>{{$son->cats_name}}</h4>
                <h3>{{$son->cats_desc}}</h3>
                <div class="today-brands ">
                  {{--  <a href="# ">桂花糕</a>
                    <a href="# ">奶皮酥</a>
                    <a href="# ">栗子糕 </a>
                    <a href="# ">马卡龙</a>
                    <a href="# ">铜锣烧</a>
                    <a href="# ">豌豆黄</a>--}}
                </div>
							<span class="more ">
                    <a href="#">更多功能,敬请期待~~<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                        </span>
            </div>
        </div>

        <div class="am-g am-g-fixed floodFour">
            <div class="am-u-sm-5 am-u-md-4 text-one list ">
                <div class="word">


                </div>
                <a href="cat/{{$son->cats_id}}">
                    <div class="outer-con ">
                        <div class="title ">
                            广告栏位招商中...
                        </div>
                        <div class="sub-title ">
                            栏位限时优惠
                        </div>
                    </div>
                    <img src="/home/images/act1.png " />
                </a>
                <div class="triangle-topright"></div>
            </div>
<style>
    #dodiv{width:240px;height:240px;float:left;margin-top: 30px;}
    .ups-con{width:240px;height:160px;}
    .downs-con{width:240px;height:80px;}
    .left-con{width:240px;height:80px;}
    .con_top{
       width:90%;height:40px;font-size: 12px;line-height: 40px;overflow:hidden;text-indent: 4px;text-align: center;}
    .con_down{width:100%;height:40px;float:left;line-height: 40px;text-align: center;}
    .right-con{width:40px;height:40px;float:right;margin-right: 20px;margin-top:5px;}

</style>
            @foreach($son->goods_info as $info)
            <div id="dodiv">
                <div class="ups-con"><a href="/home/goods/{{$info->goods_id}}"><img src="{{$info->goods_url}}" width="125px" height="125px"></a></div>
                <div class="downs-con">
                    <div class="left-con">
                        <div class="con_top">
                            <a href="/home/goods/{{$info->goods_id}}">{{$info->goods_name}}</a>
                        </div>
                        <div class="con_down">
                            <div>
                                <a href="/home/goods/{{$info->goods_id}}">￥{{$info->goods_sprice}}</a>
                                <div class="right-con">
                                    <a href="/home/addCart/{{$info->goods_id}}"><img src="/home/images/cartc.jpg" with="30px" height="30px"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            @endforeach

            {{--@foreach($son->goods_info as $info)
            <div class="am-u-sm-3 am-u-md-2 text-three am-u-xx-push-*">
                <div class="outer-con ">
                    <div class="title ">
                        {{$info->goods_name}}
                    </div>
                    <div class="sub-title ">
                        ¥{{$info->goods_sprice}}
                    </div>
                    <i class="am-icon-shopping-basket am-icon-md  seprate"></i>
                </div>
                <a href="/home/goods/{{$info->goods_id}}"><img src="{{$info->goods_url}}" alt="{{$info->goods_name}}" width="125px" height="125px"/></a>
            </div>
            @endforeach--}}



        </div>
        <div class="clear "></div>
    </div>
            @endif
        @endforeach
    </div>
</div>

@endsection






