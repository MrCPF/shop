@extends('layouts.store_head')
@section('store_head')

            <div class="main">
                <div id="J_SuggestTipWrap">

                </div>
                <form id="J_NavAttrsForm" class="navAttrsForm"  >  <a id="J_AttrsTrigger" class="attrsTrigger" href="javascript:;" atpanel=",,,,selectbutton,20,selectbutton,">筛选<i class="list-font i-expand">&#xf0002;</i><i class="list-font i-collapse">&#xf0003;</i><s class="attrsTrigger-new"></s></a>
                    <div class="attrs j_NavAttrs" style="display:block">
                        <div class="cateAttrs j_nav_cat" data-spm="a220m.1000858.1000721">
                        </div>
                        <div class="attrs-border"></div>
                    </div>
                    <input type="hidden" name="sort" value="s"/><input type="hidden" name="style" value="g"/><input type="hidden" name="from" value="sn_1_brand-qp"/><input type="hidden" name="active" value="1"/><input type="hidden" name="q" value="核桃"/><input type="hidden" name="brand" value="110416"/>
                    <input type="hidden" name="prop" value=""/>

                </form>



                <div id="J_Combo" class="combo">
                </div>


                <div class="view grid-nosku "
                     id="J_ItemList" data-spm="a220m.1000858.1000725" data-area="杭州"
                     data-atp-a="{p},{id},,,spu,1,spu,{user_id}"
                     data-atp-b="{p},{id},,,spu,2,spu,{user_id}">

                    @foreach($goods_num as $goods)
                    <div class="product  " data-id="539146037616"
                         data-atp="a!,,50013099,,,,,,,,">
                        <div class="product-iWrap">
                            <div class="productImg-wrap">
                                <a href="/home/goods/{{$goods->goods_id}}" target="_self" data-p="56-10">
                                    <img  src="{{$goods->goods_url}}" />
                                </a>

                            </div>

                            <p class="productPrice">

                                <em title="88.00"><b>&yen;</b>{{$goods->goods_price}}</em>

                            </p>

                            <p class="productTitle">

                                <a href="/home/goods/{{$goods->goods_id}}" target="_self"  data-p="56-11" >
                                    {{$goods->goods_name}}
                                </a>

                            </p>

                            <div class="productShop" data-atp="b!56-3,{user_id},,,,,,">
                                <a class="productShop-name" href="" target="_blank">
                                    {{$busines->busines_name}}
                                </a>
                            </div>
                            <p class="productStatus" >
                                <span>库存<em>{{$goods->goods_number}}</em></span>
                                <span><a href="/home/addCart/{{$goods->goods_id}}/1" target="_self" data-p="56-1"  goods_id="{{$goods->goods_id}}">加入购物车 </a></span>
                                {{--<a id="LikBasket" title="加入购物车" href="/home/addCart/{{$good->goods_id}}/1"  goods_id="{{$good->goods_id}}"    ><i></i>加入购物车</a>--}}

                            </p>
                        </div>

                    </div>
                    @endforeach


                </div>

                {{--<div class="product  " data-id="536307954291"
                     data-atp="a!,,50012995,,,,,,,,">
                    <div class="product-iWrap">
                        <div class="productImg-wrap">
                            <a href="//detail.tmall.com/item.htm?id=536307954291&amp;skuId=3200399867783&amp;user_id=389048191&amp;cat_id=2&amp;is_b=1&amp;rn=e3272129364bad000fd38601953f4d71" class="productImg" target="_blank" data-p="2-10">
                                <img  src=  "//img.alicdn.com/bao/uploaded/i3/TB1u9J9SpXXXXcdXVXXXXXXXXXX_!!0-item_pic.jpg_b.jpg" />
                            </a>

                        </div>

                        <p class="productPrice">

                            <em title="22.40"><b>&yen;</b>22.40</em>

                        </p>

                        <p class="productTitle">

                            <a href="//detail.tmall.com/item.htm?id=536307954291&amp;skuId=3200399867783&amp;user_id=389048191&amp;cat_id=2&amp;is_b=1&amp;rn=e3272129364bad000fd38601953f4d71" target="_blank" title="好想你薄皮核桃454g新疆阿克苏手剥核桃新货原味薄纸皮大生核桃仁" data-p="2-11" >
                                好想你薄皮<span class=H>核桃</span>454g新疆阿克苏手剥<span class=H>核桃</span>新货原味薄纸皮大生<span class=H>核桃</span>仁
                            </a>

                        </p>

                        <div class="productShop" data-atp="b!2-3,{user_id},,,,,,">
                            <a class="productShop-name" href="//store.taobao.com/search.htm?user_number_id=389048191&amp;rn=e3272129364bad000fd38601953f4d71&amp;keyword=核桃" target="_blank">
                                好想你官方旗舰店
                            </a>
                        </div>
                        <p class="productStatus" >
                            <span>月成交 <em>5.0万笔</em></span>
                            <span>评价 <a href="//detail.tmall.com/item.htm?id=536307954291&amp;skuId=3200399867783&amp;user_id=389048191&amp;cat_id=2&amp;is_b=1&amp;rn=e3272129364bad000fd38601953f4d71&on_comment=1#J_TabBar" target="_blank" data-p="2-1">6.8万</a></span>
<span data-icon="small" class="ww-light ww-small m_wangwang J_WangWang" data-item="536307954291" data-nick="好想你官方旗舰店" data-tnick="好想你官方旗舰店" data-display="inline"
      data-atp="a!2-2,,,,,,,389048191"></span>
                        </p>
                    </div>

                </div>--}}

                <!--start PCSceneVideo -->
                <!--end PCSceneVideo -->
                {!! $goods_num->appends(['search' => $search])->render() !!}
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
@endsection