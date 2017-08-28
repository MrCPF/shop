@extends('layouts.home')
@section('content')

        <!--购物车 -->
<div class="concent">
    <div id="cartTable">
        <div class="cart-table-th">
            <div class="wp">
                <div class="th th-chk">
                    <div id="J_SelectAll1" class="select-all J_SelectAll">

                    </div>
                </div>
                <div class="th th-item">
                    <div class="td-inner">商品信息</div>
                </div>
                <div class="th th-price">
                    <div class="td-inner">单价</div>
                </div>
                <div class="th th-amount">
                    <div class="td-inner">数量</div>
                </div>
                <div class="th th-sum">
                    <div class="td-inner">金额</div>
                </div>
                <div class="th th-op">
                    <div class="td-inner">操作</div>
                </div>
            </div>
        </div>
        <div class="clear"></div>

        <tr class="item-list">
            <div class="bundle  bundle-last ">


                <div class="bundle-main">

                    {{--循环购物车--}}
                    @foreach($carts as $item)
                    <ul class="item-content clearfix">

                        <li class="td td-item">
                            <div class="item-pic">
                                <a href="/home/goods/{{$item->id}}" target="_blank" data-title="{{$item->name}}" class="J_MakePoint" data-point="tbcart.8.12">
                                    <img src="{{$item->goods_url}}" class="itempic J_ItemImg"></a>
                            </div>
                            <div class="item-info">
                                <div class="item-basic-info">
                                    <a href="/home/goods/{{$item->id}}" target="_blank" title="{{$item->name}}" class="item-title J_MakePoint" data-point="tbcart.8.11">{{$item->name}}</a>
                                </div>
                            </div>
                        </li>
                        <li class="td td-info">
                            &nbsp;
                        </li>
                        <li class="td td-price">
                            <div class="item-price price-promo-promo">
                                <div class="price-content">
                                    <div class="price-line">
                                        <em class="price-original">

                                            {{--原价  通过add() 扩展信息option 数据添加--}}
                                            <?php  echo ($item->options->has('mk_price')? $item->options->mk_price:$item->price);?>

                                        </em>
                                    </div>
                                    <div class="price-line">
                                        <em class="J_Price price-now" tabindex="0">{{$item->price}}</em>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- 购物车数量设置 -->
                        <!-- <li class="td td-amount">
                            <div class="amount-wrapper ">
                                <div class="item-amount ">
                                    <div class="sl">
                                        <input class="min am-btn" name="" type="button" value="-" />
                                        <input class="text_box" name="" type="text" value="3" style="width:30px;" />
                                        <input class="add am-btn" name="" type="button" value="+" />
                                    </div>
                                </div>
                            </div>
                        </li> -->


                        <!-- 简版  无任意数量设置 -->

                        <li class="td td-amount">
                          {{$item->qty}}

                        </li>


                        <li class="td td-sum">
                            <div class="td-inner">
                                <em tabindex="0" class="J_ItemSum number">{{$item->price}}</em>
                            </div>
                        </li>
                        <li class="td td-op">
                            <div class="td-inner">
                               {{-- <a title="移入收藏夹" class="btn-fav" href="#">
                                    移入收藏夹</a>--}}
                                <a href="/home/removeItem/{{$item->rowId}}" data-point-url="#" class="delete" >
                                    移除购物车</a>
                            </div>
                        </li>
                    </ul>
                    @endforeach


                </div>
            </div>
        </tr>
        <div class="clear"></div>


    </div>
    <div class="clear"></div>

    <div class="float-bar-wrapper">

        <div class="operations">

            <a href="/home/index"  class="deleteAll">继续购物</a>
            <a href="/home/cartdel"  class="deleteAll">清空购物车</a>

        </div>
        <div class="float-bar-right">
            <div class="amount-sum">
                <span class="txt">商品总数</span>
                <em id="J_SelectedItemsCount">

                    {{$count}}
                </em><span class="txt">件</span>
                <div class="arrow-box">
                    <span class="selected-items-arrow"></span>
                    <span class="arrow"></span>
                </div>
            </div>
            <div class="price-sum">
                <span class="txt">合计:</span>
                <strong class="price">¥<em id="J_Total"> {{$pay}}</em></strong>
            </div>
            <div class="btn-area">
                <a href="/home/showpay" id="J_Go" class="submit-btn submit-btn-disabled" aria-label="请注意如果没有选择宝贝，将无法结算">
                    <span>结&nbsp;算</span></a>
            </div>
        </div>

    </div>
@endsection
@section('js')
        <link href="/home/css/cartstyle.css" rel="stylesheet" type="text/css" />
@endsection