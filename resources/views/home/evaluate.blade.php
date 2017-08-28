@extends('layouts.home_person')
@section('js')
    <link href="/home/css/appstyle.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/home/js/jquery-1.7.2.min.js"></script>
@endsection
@section('content')
    <div class="center">
        <div class="col-main">
            <div class="main-wrap">

                <div class="user-comment">
                    <!--标题 -->
                    <div class="am-cf am-padding">
                        <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">发表评论</strong> / <small>评论列表</small></div>
                    </div>
                    <hr/>

                    <div class="comment-main">
                        @foreach($order_done as $val)
                            <div class="comment-list">
                            <div class="item-pic">
                                <a href="/home/goods/{{$val->goods_id}}" class="J_MakePoint">
                                    <img src="{{$val->goods_url}}" class="itempic" width="150" height="150">
                                </a>
                            </div>

                            <div class="item-title">

                                <div class="item-name">
                                    <a href="/home/goods/{{$val->goods_id}}">
                                        <p class="item-basic-info">{{$val->goods_name}}</p>
                                    </a>
                                </div>
                                <div class="item-info">
                                    {{--<div class="info-little">
                                        <span>颜色：洛阳牡丹</span>
                                        <span>包装：裸装</span>
                                    </div>--}}
                                    <div class="item-price">
                                        价格：<strong>{{$val->goods_price}}元</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div class="item-comment">
                                <form action="/home/evaluate" method="post">
                                    {{csrf_field()}}
                                <textarea placeholder="请写下对宝贝的感受吧，对他人帮助很大哦！" name="eval_content"></textarea>
                            </div>
                            <div class="filePic">
                                {{--<input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*" >--}}
                                <input type="hidden" name="eval_gid" value="{{$val->goods_id}}" >
                                <input type="hidden" name="orders_id" value="{{$val->orders_id}}" >
                                {{--<span>晒照片(0/5)</span>--}}
                                <img src="/home/images/image.jpg" alt="">
                            </div>
                            <div class="item-opinion">
                                <label><input type="radio" name="eval_level" value="1" class="op1">好评</label>
                                <label><input type="radio" name="eval_level" value="2" class="op2">中评</label>
                                    <label><input type="radio" name="eval_level" value="3" class="op3">差评</label>
                                {{--<li><i class="op1"></i>好评</li>
                                <li><i class="op2"></i>中评</li>
                                <li><i class="op3"></i>差评</li>--}}
                            </div>
                        </div>

                        <!--多个商品评论-->

                        <div class="info-btn">
                            <button type="submit" class="am-btn am-btn-danger">发表评论</button>
                        </div>

                        <script type="text/javascript">
                            $(document).ready(function() {
                                $(".comment-list .item-opinion li").click(function() {
                                    $(this).prevAll().children('input').removeClass("active");
                                    $(this).nextAll().children('input').removeClass("active");
                                    $(this).children('input').addClass("active");

                                });
                            })
                        </script>
                            </form>
                        @endforeach


                    </div>

                </div>

            </div>

@endsection