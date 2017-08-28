@extends('layouts.home_person')
@section('content')
<div class="center">
    <div class="col-main">
        <div class="main-wrap">
            <div class="wrap-left">
                <div class="wrap-list">
                    <div class="m-user">
                        <!--个人信息 -->
                        <div class="m-bg"></div>
                        <div class="m-userinfo">
                            <div class="m-baseinfo">
                                <a href="">
                                    <img src="{{$user_info->pic}}">
                                </a>
                                <em class="s-name">{{$user->name}}<span class="vip1"></em>
                                <div class="s-prestige am-btn am-round">
                                    </span>会员福利</div>
                            </div>
                            <div class="m-right">
                                <div class="m-new">
                                    {{--<a href="news.html"><i class="am-icon-bell-o"></i>消息</a>--}}
                                </div>
                                <div class="m-address">
                                    <a href="/home/address" class="i-trigger">我的收货地址</a>
                                </div>
                            </div>
                        </div>

                        <!--个人资产-->
                        <div class="m-userproperty" style="display:none;">
                            <div class="s-bar">
                                <i class="s-icon"></i>个人资产
                            </div>
                            <p class="m-bonus">
                                <a href="bonus.html">
                                    <i><img src="/home/images/bonus.png"/></i>
                                    <span class="m-title">红包</span>
                                    <em class="m-num">2</em>
                                </a>
                            </p>
                            <p class="m-coupon">
                                <a href="coupon.html">
                                    <i><img src="/home/images/coupon.png"/></i>
                                    <span class="m-title">优惠券</span>
                                    <em class="m-num">2</em>
                                </a>
                            </p>
                            <p class="m-bill">
                                <a href="bill.html">
                                    <i><img src="/home/images/wallet.png"/></i>
                                    <span class="m-title">钱包</span>
                                    <em class="m-num">2</em>
                                </a>
                            </p>
                            <p class="m-big">
                                <a href="#">
                                    <i><img src="/home/images/day-to.png"/></i>
                                    <span class="m-title">签到有礼</span>
                                </a>
                            </p>
                            <p class="m-big">
                                <a href="#">
                                    <i><img src="/home/images/72h.png"/></i>
                                    <span class="m-title">72小时发货</span>
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="box-container-bottom"></div>

                    <!--订单 -->
                   {{-- <div class="m-order">
                        <div class="s-bar">
                            <i class="s-icon"></i>我的订单
                            <a class="i-load-more-item-shadow" href="/home/pay" target="_self">全部订单</a>
                        </div>
                        <ul>
                            <li><a href="order.html"><i><img src="/home/images/pay.png"/></i><span>待付款</span></a></li>
                            <li><a href="order.html"><i><img src="/home/images/send.png"/></i><span>待发货<em class="m-num">1</em></span></a></li>
                            <li><a href="order.html"><i><img src="/home/images/receive.png"/></i><span>待收货</span></a></li>
                            <li><a href="order.html"><i><img src="/home/images/comment.png"/></i><span>待评价<em class="m-num">3</em></span></a></li>
                            <li><a href="change.html"><i><img src="/home/images/refund.png"/></i><span>退换货</span></a></li>
                        </ul>
                    </div>--}}
                    <!--九宫格-->
                    <div class="user-patternIcon">
                        <div class="s-bar">
                            <i class="s-icon"></i>我的常用
                        </div>
                        <ul>

                            <a href="../home/shopcart.html"><li class="am-u-sm-4"><i class="am-icon-shopping-basket am-icon-md"></i><img src="/home/images/iconbig.png"/><p>购物车</p></li></a>
                            <a href="collection.html"><li class="am-u-sm-4"><i class="am-icon-heart am-icon-md"></i><img src="/home/images/iconsmall1.png"/><p>我的收藏</p></li></a>
                            <a href="../home/home.html"><li class="am-u-sm-4"><i class="am-icon-gift am-icon-md"></i><img src="/home/images/iconsmall0.png"/><p>为你推荐</p></li></a>
                            <a href="comment.html"><li class="am-u-sm-4"><i class="am-icon-pencil am-icon-md"></i><img src="/home/images/iconsmall3.png"/><p>好评宝贝</p></li></a>
                            <a href="foot.html"><li class="am-u-sm-4"><i class="am-icon-clock-o am-icon-md"></i><img src="/home/images/iconsmall2.png"/><p>我的足迹</p></li></a>
                        </ul>
                    </div>
                    <!--物流 -->
                    <div class="m-logistics">

                        <div class="s-bar">
                            <i class="s-icon"></i>我的物流
                        </div>
                        <div class="s-content">
                            <ul class="lg-list">
                            @foreach($order_info as $info)
                                <li class="lg-item">
                                    <div class="item-info">
                                        <a href="#">
                                            <img src="{{$info->goods_url}}" alt="{{$info->goods_name}}" width="60" height="60">
                                        </a>

                                    </div>
                                    <div class="lg-info">

                                        <p>快件已发出</p>
                                        <time>{{$info->updated_at}}</time>

                                        <div class="lg-detail-wrap">
                                            <a class="lg-detail i-tip-trigger" href="">查看物流明细</a>
                                            <div class="J_TipsCon hide">
                                                <div class="s-tip-bar">中通快递&nbsp;&nbsp;&nbsp;&nbsp;运单号：373269427686</div>
                                                <div class="s-tip-content">
                                                    <ul>
                                                        <li>快件已从 发出</li>
                                                        <li>义乌 的 义乌总部直发车 已揽件</li>
                                                        <li class="s-omit"><a data-spm-anchor-id="a1z02.1.1998049142.3" target="_blank" href="#">··· 查看全部</a></li>
                                                        <li>您的订单开始处理</li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="lg-confirm">
                                        <a class="i-btn-typical" href="/home/orderupdate/{{$info->orders_id}}">确认收货</a>
                                    </div>
                                </li>
                        @endforeach
                                <div class="clear"></div>



                            </ul>

                        </div>

                    </div>

                    <!--收藏夹 -->
                    <div class="you-like" style="display: none;">
                        <div class="s-bar">我的收藏
                            <a class="am-badge am-badge-danger am-round">降价</a>
                            <a class="am-badge am-badge-danger am-round">下架</a>
                            <a class="i-load-more-item-shadow" href="#"><i class="am-icon-refresh am-icon-fw"></i>换一组</a>
                        </div>
                        <div class="s-content">
                            <div class="s-item-wrap">
                                <div class="s-item">

                                    <div class="s-pic">
                                        <a href="#" class="s-pic-link">
                                            <img src="/home/images/0-item_pic.jpg_220x220.jpg" alt="包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰" title="包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰" class="s-pic-img s-guess-item-img">
                                        </a>
                                    </div>
                                    <div class="s-price-box">
                                        <span class="s-price"><em class="s-price-sign">¥</em><em class="s-value">42.50</em></span>
                                        <span class="s-history-price"><em class="s-price-sign">¥</em><em class="s-value">68.00</em></span>

                                    </div>
                                    <div class="s-title"><a href="#" title="包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰">包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰</a></div>
                                    <div class="s-extra-box">
                                        <span class="s-comment">好评: 98.03%</span>
                                        <span class="s-sales">月销: 219</span>

                                    </div>
                                </div>
                            </div>

                            <div class="s-item-wrap">
                                <div class="s-item">

                                    <div class="s-pic">
                                        <a href="#" class="s-pic-link">
                                            <img src="/home/images/1-item_pic.jpg_220x220.jpg" alt="s925纯银千纸鹤锁骨链短款简约时尚韩版素银项链小清新秋款女配饰" title="s925纯银千纸鹤锁骨链短款简约时尚韩版素银项链小清新秋款女配饰" class="s-pic-img s-guess-item-img">
                                        </a>
                                    </div>
                                    <div class="s-price-box">
                                        <span class="s-price"><em class="s-price-sign">¥</em><em class="s-value">49.90</em></span>
                                        <span class="s-history-price"><em class="s-price-sign">¥</em><em class="s-value">88.00</em></span>

                                    </div>
                                    <div class="s-title"><a href="#" title="s925纯银千纸鹤锁骨链短款简约时尚韩版素银项链小清新秋款女配饰">s925纯银千纸鹤锁骨链短款简约时尚韩版素银项链小清新秋款女配饰</a></div>
                                    <div class="s-extra-box">
                                        <span class="s-comment">好评: 99.74%</span>
                                        <span class="s-sales">月销: 69</span>

                                    </div>
                                </div>
                            </div>

                            <div class="s-item-wrap">
                                <div class="s-item">

                                    <div class="s-pic">
                                        <a href="#" class="s-pic-link">
                                            <img src="/home/images/-0-saturn_solar.jpg_220x220.jpg" alt="4折抢购!十二生肖925银女戒指,时尚开口女戒" title="4折抢购!十二生肖925银女戒指,时尚开口女戒" class="s-pic-img s-guess-item-img">
                                        </a>
                                    </div>
                                    <div class="s-price-box">
                                        <span class="s-price"><em class="s-price-sign">¥</em><em class="s-value">378.00</em></span>
                                        <span class="s-history-price"><em class="s-price-sign">¥</em><em class="s-value">1888.00</em></span>

                                    </div>
                                    <div class="s-title"><a href="#" title="4折抢购!十二生肖925银女戒指,时尚开口女戒">4折抢购!十二生肖925银女戒指,时尚开口女戒</a></div>
                                    <div class="s-extra-box">
                                        <span class="s-comment">好评: 99.93%</span>
                                        <span class="s-sales">月销: 278</span>

                                    </div>
                                </div>
                            </div>

                            <div class="s-item-wrap">
                                <div class="s-item">

                                    <div class="s-pic">
                                        <a href="#" class="s-pic-link">
                                            <img src="/home/images/0-item_pic.jpg_220x220.jpg" alt="包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰" title="包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰" class="s-pic-img s-guess-item-img">
                                        </a>
                                    </div>
                                    <div class="s-price-box">
                                        <span class="s-price"><em class="s-price-sign">¥</em><em class="s-value">42.50</em></span>
                                        <span class="s-history-price"><em class="s-price-sign">¥</em><em class="s-value">68.00</em></span>

                                    </div>
                                    <div class="s-title"><a href="#" title="包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰">包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰</a></div>
                                    <div class="s-extra-box">
                                        <span class="s-comment">好评: 98.03%</span>
                                        <span class="s-sales">月销: 219</span>

                                    </div>
                                </div>
                            </div>

                            <div class="s-item-wrap">
                                <div class="s-item">

                                    <div class="s-pic">
                                        <a href="#" class="s-pic-link">
                                            <img src="/home/images/1-item_pic.jpg_220x220.jpg" alt="s925纯银千纸鹤锁骨链短款简约时尚韩版素银项链小清新秋款女配饰" title="s925纯银千纸鹤锁骨链短款简约时尚韩版素银项链小清新秋款女配饰" class="s-pic-img s-guess-item-img">
                                        </a>
                                    </div>
                                    <div class="s-price-box">
                                        <span class="s-price"><em class="s-price-sign">¥</em><em class="s-value">49.90</em></span>
                                        <span class="s-history-price"><em class="s-price-sign">¥</em><em class="s-value">88.00</em></span>

                                    </div>
                                    <div class="s-title"><a href="#" title="s925纯银千纸鹤锁骨链短款简约时尚韩版素银项链小清新秋款女配饰">s925纯银千纸鹤锁骨链短款简约时尚韩版素银项链小清新秋款女配饰</a></div>
                                    <div class="s-extra-box">
                                        <span class="s-comment">好评: 99.74%</span>
                                        <span class="s-sales">月销: 69</span>

                                    </div>
                                </div>
                            </div>

                            <div class="s-item-wrap">
                                <div class="s-item">

                                    <div class="s-pic">
                                        <a href="#" class="s-pic-link">
                                            <img src="/home/images/-0-saturn_solar.jpg_220x220.jpg" alt="4折抢购!十二生肖925银女戒指,时尚开口女戒" title="4折抢购!十二生肖925银女戒指,时尚开口女戒" class="s-pic-img s-guess-item-img">
                                        </a>
                                    </div>
                                    <div class="s-price-box">
                                        <span class="s-price"><em class="s-price-sign">¥</em><em class="s-value">378.00</em></span>
                                        <span class="s-history-price"><em class="s-price-sign">¥</em><em class="s-value">1888.00</em></span>

                                    </div>
                                    <div class="s-title"><a href="#" title="4折抢购!十二生肖925银女戒指,时尚开口女戒">4折抢购!十二生肖925银女戒指,时尚开口女戒</a></div>
                                    <div class="s-extra-box">
                                        <span class="s-comment">好评: 99.93%</span>
                                        <span class="s-sales">月销: 278</span>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="s-more-btn i-load-more-item" data-screen="0"><i class="am-icon-refresh am-icon-fw"></i>更多</div>

                    </div>

                </div>
            </div>
            <div class="wrap-right">

                <!-- 日历-->
                <div class="day-list">
                    <div class="s-bar">
                        <a class="i-history-trigger s-icon" href=""></a>日历
                        <a class="i-setting-trigger s-icon" href=""></a>
                    </div>
                    <div class="s-care s-care-noweather">
                        <div class="s-date">
                            <em><?php echo date('d');?></em>
                            <span>星期<?php echo date('N')?></span>
                            <span><?=date('Y');?>.<?=date('m')?></span>
                        </div>
                    </div>
                </div>
                <!--新品 -->
                {{--<div class="new-goods">
                    <div class="s-bar">
                        <i class="s-icon"></i>今日新品
                        <a class="i-load-more-item-shadow">15款新品</a>
                    </div>
                    <div class="new-goods-info">
                        <a class="shop-info" href="#" target="_blank">
                            <div class="face-img-panel">
                                <img src="/home/images/imgsearch1.jpg" alt="">
                            </div>
                            <span class="new-goods-num ">4</span>
                            <span class="shop-title">剥壳松子</span>
                        </a>
                        <a class="follow " target="_blank">关注</a>
                    </div>
                </div>--}}

                <!--热卖推荐 -->
                {{--<div class="new-goods">
                    <div class="s-bar">
                        <i class="s-icon"></i>热卖推荐
                    </div>
                    <div class="new-goods-info">
                        <a class="shop-info" href="#" target="_blank">
                            <div >
                                <img src="/home/images/imgsearch1.jpg" alt="">
                            </div>
                            <span class="one-hot-goods">￥9.20</span>
                        </a>
                    </div>
                </div>--}}

            </div>
        </div>
@endsection