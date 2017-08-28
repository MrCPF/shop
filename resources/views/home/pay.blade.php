<?php error_reporting(0);?>
@extends('layouts.home')
@section('js')
	<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />

	<link href="/home/basic/css/demo.css" rel="stylesheet" type="text/css" />
	<link href="/home/css/cartstyle.css" rel="stylesheet" type="text/css" />

	<link href="/home/css/jsstyle.css" rel="stylesheet" type="text/css" />

	<script type="text/javascript" src="/home/js/address.js"></script>
@endsection
@section('content')
			<div class="clear"></div>
			<div class="concent">
				<!--地址 -->
				<div class="paycont">
					<div class="address">
						<h3>确认收货地址</h3>
						<div class="control">
							<div class="tc-btn createAddr theme-login am-btn am-btn-danger"><a href="address">使用新地址</a></div>
						</div>
						<div class="clear"></div>
						
							@foreach($user_info as $info)
                            @if($info->sign == 0)
                            <li class="user-addresslist defaultAddr">
                                <span class="new-option-r"><i class="am-icon-check-circle"></i>默认地址</span>
                                <p class="new-tit new-p-re">
                                    <span class="new-txt">{{$info->name}}</span>
                                    <span class="new-txt-rd2">{{$info->mobile}}</span>
                                </p>
                                <div class="new-mu_l2a new-p-re">
                                    <p class="new-mu_l2cw">
                                        <span class="title">地址：</span>
                                        <span class="province">{{$info->address}}
                                       </span></p>
                                </div>
                                <div class="new-addr-btn">
                                    <button href="" onclick="oldAdress()" style="background-color:#fff">使用默认</button>
                                </div>

                            </li>
                            @else
                                <li class="user-addresslist">
                                    <span class="new-option-r">
                                        <span class="new-txt">{{$info->name}}</span>
                                        <span class="new-txt-rd2">{{$info->mobile}}</span>
                                    </p>
                                    <div class="new-mu_l2a new-p-re">
                                        <p class="new-mu_l2cw">
                                            <span class="title">地址：</span>
                                        <span class="province">{{$info->address}}
                                       </span></p>
                                    </div>
                                    <div class="new-addr-btn">
                                        <input type="hidden" name="" id="changeId" value="{{$info->id}}">
                                        <button href="" onclick="changeAdress()" style="background-color:#fff">选择此地址</button>
                                    </div>
                                </li>
                            @endif

                        @endforeach						

						<div class="clear"></div>
					</div>
					<!--物流 -->
					<div class="logistics">
						<h3>选择物流方式</h3>
						<ul class="op_express_delivery_hot">
							<li data-value="yuantong" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -468px"></i>圆通<span></span></li>
							<li data-value="shentong" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -1008px"></i>申通<span></span></li>
							<li data-value="yunda" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -576px"></i>韵达<span></span></li>
							<li data-value="zhongtong" class="OP_LOG_BTN op_express_delivery_hot_last "><i class="c-gap-right" style="background-position:0px -324px"></i>中通<span></span></li>
							<li data-value="shunfeng" class="OP_LOG_BTN  op_express_delivery_hot_bottom"><i class="c-gap-right" style="background-position:0px -180px"></i>顺丰<span></span></li>
						</ul>
					</div>
					<div class="clear"></div>

					<!--支付方式-->
					<div class="logistics">
						<h3>选择支付方式</h3>
						<ul class="pay-list">
							<li class="pay card"><img src="/home/images/wangyin.jpg" />银联<span></span></li>
							<li class="pay qq"><img src="/home/images/weizhifu.jpg" />微信<span></span></li>
							<li class="pay taobao"><img src="/home/images/zhifubao.jpg" />支付宝<span></span></li>
						</ul>
					</div>
					<div class="clear"></div>

					<!--订单 -->
					<div class="concent">
						<div id="payTable">
							<h3>确认订单信息</h3>
							<div class="cart-table-th">
								<div class="wp">

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
									<div class="th th-oplist">
										<div class="td-inner">配送方式</div>
									</div>

								</div>
							</div>
							<div class="clear"></div>
							@foreach ($cart as $v)
								
							
							<tr class="item-list">
								<div class="bundle  bundle-last">

									<div class="bundle-main">
										<ul class="item-content clearfix">
											<div class="pay-phone">
												<li class="td td-item">
													<div class="item-pic">
														<a href="#" class="J_MakePoint">
															<img src="{{$v->goods_url}}" class="itempic J_ItemImg" width="80" height="80"></a>
													</div>
													<div class="item-info">
														<div class="item-basic-info">
															<a href="#" class="item-title J_MakePoint" data-point="tbcart.8.11">{{$v->name}}</a>
														</div>
													</div>
												</li>
												<li class="td td-info">
													<div class="item-props">
														<span class="sku-line">颜色：12#川南玛瑙</span>
														<span class="sku-line">包装：裸装</span>
													</div>
												</li>
												<li class="td td-price">
													<div class="item-price price-promo-promo">
														<div class="price-content">
															<em class="J_Price price-now">{{$v->price}}</em>
														</div>
													</div>
												</li>
											</div>
											<li class="td td-amount">
												<div class="amount-wrapper ">
													<div class="item-amount ">
														<span class="phone-title">购买数量</span>
														<div class="sl">

															<b >{{$v->qty}}</b>

														</div>
													</div>
												</div>
											</li>
											<li class="td td-sum">
												<div class="td-inner">
													<em tabindex="0" class="J_ItemSum number">{{$v->price*$v->qty}}</em>
												</div>
											</li>
											<li class="td td-oplist">
												<div class="td-inner">
													<span class="phone-title">配送方式</span>
													<div class="pay-logis">
														快递<b class="sys_item_freprice">包邮</b>
													</div>
												</div>
											</li>

										</ul>
										<div class="clear"></div>

									</div>
							</tr>
							<div class="clear"></div>
							</div>
							@endforeach
							
							<!-- </div>
							<div class="clear"></div> -->
							<div class="pay-total">
						<!--留言-->
							<div class="order-extra">
								<div class="order-user-info">
									<div id="holyshit257" class="memo">
										<label>买家留言：</label>
										<input type="text" title="选填,对本次交易的说明（建议填写已经和卖家达成一致的说明）" placeholder="选填,建议填写和卖家达成一致的说明" class="memo-input J_MakePoint c2c-text-default memo-close">
										<div class="msg hidden J-msg">
											<p class="error">最多输入500个字符</p>
										</div>
									</div>
								</div>

							</div>
							<!--优惠券 -->

							<!--含运费小计 -->
							<div class="buy-point-discharge ">
								<p class="price g_price ">
									合计（含运费） <span>¥</span><em class="pay-sum">{{$pay}}</em>
								</p>
							</div>

							<!--信息 -->
							<div class="order-go clearfix">
								<div class="pay-confirm clearfix">
									<div class="box">
										<div tabindex="0" id="holyshit267" class="realPay"><em class="t">实付款：</em>
											<span class="price g_price ">
                                    <span>¥</span> <em class="style-large-bold-red " id="J_ActualFee">{{$pay}}</em>
											</span>
										</div>

										<div id="holyshit268" class="pay-address">

											<p class="buy-footer-address">
												<span class="buy-line-title buy-line-title-type">寄送至：</span>
												<span class="buy--address-detail">
								   
												<span class="street" id="doneAddress">{{$user_info2->address}}</span>
												</span>
												</span>
											</p>
											<p class="buy-footer-address">
												<span class="buy-line-title">收货人：</span>
												<span class="buy-address-detail">   
                                         <span class="buy-user" id="doneUser">{{$user_info2->name}} </span>
												<span class="buy-phone" id="donePhone">{{$user_info2->mobile}}</span>
												</span>
											</p>
										</div>
									</div>

									<div id="holyshit269" class="submitOrder">
										<div class="go-btn-wrap">
											<a id="J_Go" href="/home/pay" class="btn-go" tabindex="0" title="点击此按钮，提交订单">提交订单</a>
										</div>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div

						<div class="clear"></div>
					</div>
				</div>
	<script type="text/javascript">
        function changeAdress(){

            $.ajaxSetup({
             headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
             });
             var id = $('#changeId').val();
             $.post('/home/address/change',{'id':id},function(data){
             console.log(data);
                 location.reload();
             return;
             });
        }
	</script>

@endsection