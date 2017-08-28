<link href="/css/bootstrap.css" rel="stylesheet" type="text/css">
@extends('layouts.home_person')
@section('js')
    <link href="/home/css/cmstyle.css" rel="stylesheet" type="text/css">
    <script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
    <script src="/home/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
@endsection
@section('content')

    <div class="center">
        <div class="col-main">
            <div class="main-wrap">

                <div class="user-comment">
                    <!--标题 -->
                    <div class="am-cf am-padding">
                        <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">评价管理</strong> / <small>评价列表</small></div>
                    </div>
                    <hr/>

                    <div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>

                        <ul class="am-avg-sm-2 am-tabs-nav am-nav am-nav-tabs">
                            <li class="am-active"><a href="#tab1">所有评价</a></li>
                            {{--<li><a href="#tab2">有图评价</a></li>--}}

                        </ul>

                        <div class="am-tabs-bd">
                            <div class="am-tab-panel am-fade am-in am-active" id="tab1">

                                <div class="comment-main">
                                    <div class="comment-list">
                                        @foreach($evals as $eval)

                                        <ul class="item-list">
                                            <div class="comment-top">
                                                <div class="th th-price">
                                                    <td class="td-inner">评价</td>
                                                </div>
                                                <div class="th th-item">
                                                    <td class="td-inner" style="text-align: center">商品</td>
                                                </div>
                                            </div>
                                            <li class="td td-item">
                                                <div class="item-pic">
                                                    <a href="/home/goods/{{$eval->eval_gid}}" class="J_MakePoint">
                                                        <img src="{{$eval->goods_url}}" class="itempic" width="80" height="80">
                                                    </a>
                                                </div>
                                            </li>

                                            <li class="td td-comment">
                                                <div class="item-title">
                                                    <div class="item-opinion">好评</div>
                                                    <div class="item-name">
                                                        <a href="/home/goods/{{$eval->eval_gid}}">
                                                            <p class="item-basic-info" style="text-align:center;">{{$eval->goods_name}}</p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="item-comment" style="text-align:center;">
                                                    {{$eval->eval_content}}
                                                </div>

                                                <div class="item-info" style="height:70px;width:500px;text-indent:100px;line-height: 70px;">
                                                        <div style="float:left;clear:left;">{{$eval->eval_time}}</div>
                                                </div>
                                            </li>
                                        </ul>
                                    @endforeach

                                    </div>
                                </div>

                            </div>
                            {!! $evals->render() !!}
                            <div class="am-tab-panel am-fade" id="tab2">

                                <div class="comment-main">
                                    <div class="comment-list">
                                        <ul class="item-list">


                                            <div class="comment-top">
                                                <div class="th th-price">
                                                    <td class="td-inner">评价</td>
                                                </div>
                                                <div class="th th-item">
                                                    <td class="td-inner">商品</td>
                                                </div>
                                            </div>
                                            <li class="td td-item">
                                                <div class="item-pic">
                                                    <a href="#" class="J_MakePoint">
                                                        <img src="/home/images/kouhong.jpg_80x80.jpg" class="itempic">
                                                    </a>
                                                </div>
                                            </li>

                                            <li class="td td-comment">
                                                <div class="item-title">
                                                    <div class="item-opinion">好评</div>
                                                    <div class="item-name">
                                                        <a href="#">
                                                            <p class="item-basic-info">美康粉黛醉美唇膏 持久保湿滋润防水不掉色</p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="item-comment">
                                                    宝贝非常漂亮，超级喜欢！！！ 口红颜色很正呐，还有第两支半价，买三支免单一支的活动，下次还要来买。就是物流太慢了，还要我自己去取快递，店家不考虑换个物流么？
                                                    <div class="filePic"><img src="/home/images/image.jpg" alt=""></div>
                                                </div>

                                                <div class="item-info">
                                                    <div>
                                                        <p class="info-little"><span>颜色：12#玛瑙</span> <span>包装：裸装</span> </p>
                                                        <p class="info-time">2015-12-24</p>

                                                    </div>
                                                </div>
                                            </li>

                                        </ul>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

@endsection
