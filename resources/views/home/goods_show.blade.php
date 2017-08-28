@extends('layouts.store_home')

<b class="line"></b>
@section('content')

    <ol class="am-breadcrumb am-breadcrumb-slash">
        <li><a href="/home/index">首页</a></li>
        <li><a href="/home/cat/{{$good->cats_id}}">分类</a></li>
        <li class="am-active">内容</li>
    </ol>
    <script type="text/javascript" src="/home/js/list.js"></script>
    <script type="text/javascript">
        $(function() {});
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                start: function(slider) {
                    $('body').removeClass('loading');
                }
            });

        });
    </script>
    <div class="scoll">
        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <li>
                        <img src="/home/images/01.jpg" title="pic" />
                    </li>
                    <li>
                        <img src="/home/images/02.jpg" />
                    </li>
                    <li>
                        <img src="/home/images/03.jpg" />
                    </li>
                </ul>
            </div>
        </section>
    </div>

    <!--放大镜-->
    <div class="item-inform">
        <div class="clearfixLeft" id="clearcontent">

            <div class="box">
                <script type="text/javascript">
                    $(document).ready(function() {
                        $(".jqzoom").imagezoom();
                        $("#thumblist li a").click(function() {
                            $(this).parents("li").addClass("tb-selected").siblings().removeClass("tb-selected");
                            $(".jqzoom").attr('src', $(this).find("img").attr("mid"));
                            $(".jqzoom").attr('rel', $(this).find("img").attr("big"));
                        });
                    });
                </script>

                <div class="tb-booth tb-pic tb-s310">
                    <a href="{{$goods_imgs[0]->goods_url}}"><img src="{{$goods_imgs[0]->goods_url}}" alt="细节展示放大镜特效" rel="{{$goods_imgs[0]->goods_url}}" class="jqzoom" /></a>
                </div>
                <ul class="tb-thumb" id="thumblist">
                    @foreach($goods_imgs as $goods_img)
                        <li class="tb-selected">
                            <div class="tb-pic tb-s40">
                                <a href="#"><img src="{{$goods_img->goods_url}}" mid="{{$goods_img->goods_url}}" big="{{$goods_img->goods_url}}"></a>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>

            <div class="clear"></div>
        </div>

        <div class="clearfixRight">

            <!--规格属性-->
            <!--名称-->
            <div class="tb-detail-hd">
                <h1>
                    {{$good->goods_name}}
                </h1>
            </div>
            <div class="tb-detail-list">
                <!--价格-->
                <div class="tb-detail-price">
                    <li class="price iteminfo_price">
                        <dt>促销价</dt>
                        <dd><em>¥</em><b class="sys_item_price"></b> {{$good->goods_sprice}}  </dd>
                    </li>
                    <li class="price iteminfo_mktprice">
                        <dt>原价</dt>
                        <dd><em>¥</em><b class="sys_item_mktprice"></b> {{$good->goods_price}}</dd>
                    </li>
                    <div class="clear"></div>
                </div>





                <!--各种规格-->
                <dl class="iteminfo_parameter sys_item_specpara">
                    <dt class="theme-login"><div class="cart-title">可选规格<span class="am-icon-angle-right"></span></div></dt>
                    <dd>
                        <!--操作页面-->

                        <div class="theme-popover-mask"></div>

                        <div class="theme-popover">
                            <div class="theme-span"></div>
                            <div class="theme-poptit">
                                <a href="javascript:;" title="关闭" class="close">×</a>
                            </div>
                            <div class="theme-popbod dform">
                                <form class="theme-signin" name="loginform" action="" method="post">

                                    <div class="theme-signin-left">

                                        {{--<div class="theme-options">
                                            <div class="cart-title">口味</div>
                                            <ul>
                                                <li class="sku-line selected">原味<i></i></li>
                                                <li class="sku-line">奶油<i></i></li>
                                                <li class="sku-line">炭烧<i></i></li>
                                                <li class="sku-line">咸香<i></i></li>
                                            </ul>
                                        </div>
                                        <div class="theme-options">
                                            <div class="cart-title">包装</div>
                                            <ul>
                                                <li class="sku-line selected">手袋单人份<i></i></li>
                                                <li class="sku-line">礼盒双人份<i></i></li>
                                                <li class="sku-line">全家福礼包<i></i></li>
                                            </ul>
                                        </div>--}}
                                        <div class="theme-options">
                                            <div class="cart-title number">数量</div>
                    <dd>
                        <input id="min" class="am-btn am-btn-default" name="" type="button" value="-" />
                        <input id="text_box" name="" type="text" value="1" style="width:30px;" />
                        <input id="add" class="am-btn am-btn-default" name="" type="button" value="+" />
                        <span id="Stock" class="tb-hidden">库存<span class="stock">{{$good->goods_number}}</span>件</span>
                    </dd>
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
            <div class="clear"></div>

            <div class="btn-op">
                <div class="btn am-btn am-btn-warning">确认</div>
                <div class="btn close am-btn am-btn-warning">取消</div>
            </div>
        </div>
        <div class="theme-signin-right">
            <div class="img-info">
                <img src="/home/images/songzi.jpg" />
            </div>
            <div class="text-info">
                <span class="J_Price price-now">¥39.00</span>
                <span id="Stock" class="tb-hidden">库存<span class="stock">1000</span>件</span>
            </div>
        </div>

        </form>
    </div>
    </div>

    </dd>
    </dl>
    <div class="clear"></div>
    <!--活动  -->
    <div class="shopPromotion gold">
        <div class="hot">
            <dt class="tb-metatit">店铺优惠</dt>
            <div class="gold-list">
                <p>敬请期待！<span>{{--<i class="am-icon-sort-down"></i>--}}</span></p>
            </div>
        </div>
        <div class="clear"></div>
       {{-- <div class="coupon">
            <dt class="tb-metatit">优惠券</dt>
            <div class="gold-list">
                <ul>
                    <li>125减5</li>
                    <li>198减10</li>
                    <li>298减20</li>
                </ul>
            </div>
        </div>--}}
    </div>
    </div>

    <div class="pay">
        <div class="pay-opt">
            <a href="home.html"><span class="am-icon-home am-icon-fw">首页</span></a>
            <a><span class="am-icon-heart am-icon-fw">收藏</span></a>

        </div>
        <li>
            <div class="clearfix tb-btn tb-btn-buy theme-login">
                <a id="LikBuy" title="点此按钮到下一步确认购买信息" href="/home/addCart/{{$good->goods_id}}/1">立即购买</a>
            </div>
        </li>
        <li>
            <div class="clearfix tb-btn tb-btn-basket theme-login">
                <a id="LikBasket" title="加入购物车" href="/home/addCart/{{$good->goods_id}}/1"  goods_id="{{$good->goods_id}}"    ><i></i>加入购物车</a>
            </div>
        </li>
    </div>

    </div>

    <div class="clear"></div>

    </div>




    <!-- introduce-->

    <div class="introduce">
        <div class="browse">
            <div class="mc">
                <ul>
                    <div class="mt">
                        <h2>店家推荐</h2>
                    </div>

                    <li class="first">
                        <div class="p-img">
                            <a  href="/home/goods/{{$goods_relation->goods_id}}"> <img class="" src="{{$goods_relation->goods_url}}" width="192" height="192"> </a>
                        </div>
                        <div class="p-name"><a href="/home/goods/{{$goods_relation->goods_id}}">
                                {{$goods_relation->goods_name}}
                            </a>
                        </div>
                        <div class="p-price"><strong>￥{{$goods_relation->goods_sprice}}</strong></div>
                    </li>

                </ul>
            </div>
        </div>
        <div class="introduceMain">
            <div class="am-tabs" data-am-tabs>
                <ul class="am-avg-sm-3 am-tabs-nav am-nav am-nav-tabs">
                    <li class="am-active">
                        <a href="#">

                            <span class="index-needs-dt-txt">宝贝详情</span></a>

                    </li>

                    <li>
                        <a href="#">

                            <span class="index-needs-dt-txt">全部评价</span></a>

                    </li>


                </ul>

                <div class="am-tabs-bd">

                    <div class="am-tab-panel am-fade am-in am-active">
                        <div class="J_Brand">

                            {{--<div class="attr-list-hd tm-clear">--}}
                                {{--<h4>产品参数：</h4></div>--}}
                            {{--<div class="clear"></div>--}}
                            {{--<ul id="J_AttrUL">
                                <li title="">产品类型:&nbsp;烘炒类</li>
                                <li title="">原料产地:&nbsp;巴基斯坦</li>
                                <li title="">产地:&nbsp;湖北省武汉市</li>
                                <li title="">配料表:&nbsp;进口松子、食用盐</li>
                                <li title="">产品规格:&nbsp;210g</li>
                                <li title="">保质期:&nbsp;180天</li>
                                <li title="">产品标准号:&nbsp;GB/T 22165</li>
                                <li title="">生产许可证编号：&nbsp;QS4201 1801 0226</li>
                                <li title="">储存方法：&nbsp;请放置于常温、阴凉、通风、干燥处保存 </li>
                                <li title="">食用方法：&nbsp;开袋去壳即食</li>
                            </ul>--}}
                            <div class="clear"></div>
                        </div>

                        <div class="details">
                            <div class="attr-list-hd after-market-hd">
                                <h4>商品细节</h4>
                            </div>
                            <div class="twlistNews">
                                @foreach($goods_imgs as $img)
                                    <img src="{{$img->goods_url}}" style="width:450px;"/>
                                @endforeach
                            </div>
                        </div>
                        <div class="clear"></div>

                    </div>

                    <div class="am-tab-panel am-fade">

                        <div class="actor-new">
                            <div class="rate">
                                <strong>100<span>%</span></strong><br> <span>好评度</span>
                            </div>
                            <dl>
                                <dt>买家印象</dt>
                                <dd class="p-bfc">
                                    <q class="comm-tags"><span>非常实用</span><em>(2177)</em></q>
                                    <q class="comm-tags"><span>价格公道</span><em>(1860)</em></q>
                                    <q class="comm-tags"><span>商品不错</span><em>(1689)</em></q>
                                    <q class="comm-tags"><span>值得购买</span><em>(1488)</em></q>
                                    <q class="comm-tags"><span>非常不错</span><em>(1392)</em></q>
                                    <q class="comm-tags"><span>还会再来</span><em>(1119)</em></q>
                                    <q class="comm-tags"><span>特价买的</span><em>(865)</em></q>
                                </dd>
                            </dl>
                        </div>
                        <div class="clear"></div>
                        <div class="tb-r-filter-bar">
                            <ul class=" tb-taglist am-avg-sm-4">
                                <li class="tb-taglist-li tb-taglist-li-current">
                                    <div class="comment-info">
                                        <span>全部评价</span>
                                        <span class="tb-tbcr-num">({{$count_total}})</span>
                                    </div>
                                </li>

                                <li class="tb-taglist-li tb-taglist-li-1">
                                    <div class="comment-info">
                                        <span>好评</span>
                                        <span class="tb-tbcr-num">({{$count_up}})</span>
                                    </div>
                                </li>

                                <li class="tb-taglist-li tb-taglist-li-0">
                                    <div class="comment-info">
                                        <span>中评</span>
                                        <span class="tb-tbcr-num">({{$count_mid}})</span>
                                    </div>
                                </li>

                                <li class="tb-taglist-li tb-taglist-li--1">
                                    <div class="comment-info">
                                        <span>差评</span>
                                        <span class="tb-tbcr-num">({{$count_down}})</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="clear"></div>

                        <ul class="am-comments-list am-comments-list-flip">

                        @foreach($evaluates as $val)
                            <li class="am-comment">
                                <!-- 评论容器 -->
                                <a href="">
                                    <img class="am-comment-avatar" src="{{$val->pic}}" />
                                    <!-- 评论者头像 -->
                                </a>

                                <div class="am-comment-main">
                                    <!-- 评论内容容器 -->
                                    <header class="am-comment-hd">
                                        <!--<h3 class="am-comment-title">评论标题</h3>-->
                                        <div class="am-comment-meta">
                                            <!-- 评论元数据 -->
                                            <a href="#link-to-user" class="am-comment-author">{{$val->name}}</a>
                                            <!-- 评论者 -->
                                            评论于
                                            <time datetime="">{{$val->eval_time}}</time>
                                        </div>
                                    </header>

                                    <div class="am-comment-bd">
                                        <div class="tb-rev-item " data-id="255776406962">
                                            <div class="J_TbcRate_ReviewContent tb-tbcr-content ">
                                                {{$val->eval_content}}
                                            </div>
                                            <div class="tb-r-act-bar">
                                                颜色分类：柠檬黄&nbsp;&nbsp;尺码：S
                                            </div>
                                        </div>

                                    </div>
                                    <!-- 评论内容 -->
                                    <div  class="am-comment-bd" style="text-align: right;">
                                        <a href="/home/reply/{{$val->eval_id}}" target="_blank"><i class="am-icon-comment"></i>回复({{$val->reply_count}})</a>
                                    </div>
                                </div>

                            </li>

                        @endforeach
                        </ul>

                        <div class="clear"></div>

                        <!--分页 -->
                        <ul class="am-pagination am-pagination-right">
                          {!! $evaluates->render() !!}
                        </ul>
                        <div class="clear"></div>

                        <div class="tb-reviewsft">
                            <div class="tb-rate-alert type-attention">购买前请查看该商品的 <a href="#" target="_blank">购物保障</a>，明确您的售后保障权益。</div>
                        </div>

                    </div>



                </div>

            </div>

            <div class="clear"></div>
@endsection
@section('js')

                <link type="text/css" href="/home/css/optstyle.css" rel="stylesheet" />
                <link type="text/css" href="/home/css/style.css" rel="stylesheet" />


                <script type="text/javascript" src="/home/js/jquery.imagezoom.min.js"></script>
                <script type="text/javascript" src="/home/js/jquery.flexslider.js"></script>

@endsection