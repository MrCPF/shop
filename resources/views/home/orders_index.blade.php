<?php error_reporting('offset:77');  ?>
@extends('layouts.home_person')
@section('js')
<link href="/home/css/orstyle.css" rel="stylesheet" type="text/css">
<script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<script src="/home/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
		<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-order">

						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">订单管理</strong> / <small>Order</small></div>
						</div>
						<hr/>

						<div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>

							<ul class="am-avg-sm-5 am-tabs-nav am-nav am-nav-tabs">
								<li class="am-active"><a href="#tab1">所有订单</a></li>
								<li><a href="#tab2">待付款</a></li>
								<li><a href="#tab3">待发货</a></li>
								<li><a href="#tab4">待收货</a></li>
								<li><a href="#tab5">待评价</a></li>
							</ul>

							<div class="am-tabs-bd">
								<div class="am-tab-panel am-fade am-in am-active" id="tab1">
									<div class="order-top">
										<div class="th th-item">
											<td class="td-inner">商品</td>
										</div>
										<div class="th th-price">
											<td class="td-inner">单价</td>
										</div>
										<div class="th th-number">
											<td class="td-inner">数量</td>
										</div>
										<div class="th th-operation">
											<td class="td-inner">&nbsp;&nbsp;</td>
										</div>
										<div class="th th-amount">
											<td class="td-inner">合计</td>
										</div>
										<div class="th th-status">
											<td class="td-inner">交易状态</td>
										</div>
										<div class="th th-change">
											<td class="td-inner">交易操作</td>
										</div>
									</div>

									<div class="order-main">
										<div class="order-list">
											@foreach($orderInfo as $v)

											<!--交易成功-->
											<div class="order-status5">
												<div class="order-title">
													<div class="dd-num">订单编号：<a href="javascript:;">{{$v->orders_sign}}</a></div>
													<span>成交时间：{{$v->orders_time}}</span>
												</div>

												<div class="order-content">
													<div class="order-left">

															<ul class="item-list">
															<li class="td td-item">
																<div class="item-pic">
																	<a href="/home/goods/{{$v->goods_id}}" class="J_MakePoint">
																		<img src="{{$v->goods_url}}" class="itempic J_ItemImg">
																	</a>
																</div>
																<div class="item-info" >
																	<div class="item-basic-info">
																		<a href="/home/goods/{{$v->goods_id}}">
																			<p><?php echo substr($v->goods_name,0,37) ?></p>
																			<!-- <p class="info-little">颜色：12#川南玛瑙
																				-->
																		</a>
																	</div>
																</div>
															</li>
															<li class="td td-price">
																<div class="item-price">
																	{{$v->orders_gprice}}
																</div>
															</li>
															<li class="td td-number">
																<div class="item-number">
																	<span>×</span>{{$v->orders_gnum}}
																</div>
															</li>
															<li class="td td-operation">
																<div class="item-operation">
																	
																</div>
															</li>
														</ul>


													</div>
													<div class="order-right">
														<li class="td td-amount">
															<div class="item-amount">
																{{$v->orders_total}}
																<p>含运费：<span>10.00</span></p>
															</div>
														</li>
														<div class="move-right">
															<li class="td td-status">
																<div class="item-status">
																	<p class="Mystatus">{{$orders_status[$v->orders_id]}}</p>
																	<p class="order-info"><a href="/home/details">订单详情</a></p>
																	{{--<p class="order-info"><a href="logistics.html">查看物流</a></p>--}}
																</div>
															</li>
															<li class="td td-change">
																<div class="am-btn am-btn-danger anniu">
																	<a href="/home/orderdel/{{$v->orders_id}}">删除订单</a></div>
															</li>
														</div>
													</div>
												</div>
											</div>
											@endforeach
											{!! $orderInfo->render() !!}
										</div>
									</div>
								</div>
								<div class="am-tab-panel am-fade am-in am-active" id="tab2">
									<div class="order-top">
										<div class="th th-item">
											<td class="td-inner">商品</td>
										</div>
										<div class="th th-price">
											<td class="td-inner">单价</td>
										</div>
										<div class="th th-number">
											<td class="td-inner">数量</td>
										</div>
										<div class="th th-operation">
											<td class="td-inner">&nbsp;&nbsp;</td>
										</div>
										<div class="th th-amount">
											<td class="td-inner">合计</td>
										</div>
										<div class="th th-status">
											<td class="td-inner">交易状态</td>
										</div>
										<div class="th th-change">
											<td class="td-inner">交易操作</td>
										</div>
									</div>

									<div class="order-main">
										<div class="order-list">
											@foreach($order_npay as $v)

											<!--交易成功-->
											<div class="order-status5">
												<div class="order-title">
													<div class="dd-num">订单编号：<a href="javascript:;">{{$v->orders_sign}}</a></div>
													<span>成交时间：{{$v->orders_time}}</span>

												</div>

												<div class="order-content">
													<div class="order-left">
														<ul class="item-list">
															<li class="td td-item">
																<div class="item-pic">
																	<a href="/home/goods/{{$v->goods_id}}" class="J_MakePoint">
																		<img src="{{$v->goods_url}}" class="itempic J_ItemImg">
																	</a>
																</div>
																<div class="item-info">
																	<div class="item-basic-info">
																		<a href="/home/goods/{{$v->goods_id}}">
																			<p><?php echo substr($v->goods_name,0,37) ?></p>
																			<!-- <p class="info-little">颜色：12#川南玛瑙
																				-->
																		</a>
																	</div>
																</div>
															</li>
															<li class="td td-price">
																<div class="item-price">
																	{{$v->orders_gprice}}
																</div>
															</li>
															<li class="td td-number">
																<div class="item-number">
																	<span>×</span>{{$v->orders_gnum}}
																</div>
															</li>
															<li class="td td-operation">
																<div class="item-operation">
																	
																</div>
															</li>
														</ul>

													</div>
													<div class="order-right">
														<li class="td td-amount">
															<div class="item-amount">
																{{$v->orders_total}}
																<p>含运费：<span>10.00</span></p>
															</div>
														</li>
														<div class="move-right">
															<li class="td td-status">
																<div class="item-status">
																	<p class="Mystatus">{{$orders_status[$v->orders_id]}}</p>
																	<p class="order-info"><a href="/home/paySuc/{{$v->orders_id}}">去支付</a></p>
																	{{--<p class="order-info"><a href="logistics.html">查看物流</a></p>--}}
																</div>
															</li>
															<li class="td td-change">
																<div class="am-btn am-btn-danger anniu">
																	<a href="/home/orderdel/{{$v->orders_id}}">删除订单</a></div>
															</li>
														</div>
													</div>
												</div>
											</div>
											@endforeach
											{!! $order_npay->render() !!}
										</div>
									</div>
								</div>								
							

								<div class="am-tab-panel am-fade" id="tab3">
									<div class="order-top">
										<div class="th th-item">
											<td class="td-inner">商品</td>
										</div>
										<div class="th th-price">
											<td class="td-inner">单价</td>
										</div>
										<div class="th th-number">
											<td class="td-inner">数量</td>
										</div>
										<div class="th th-operation">
											<td class="td-inner">&nbsp;&nbsp;</td>
										</div>
										<div class="th th-amount">
											<td class="td-inner">合计</td>
										</div>
										<div class="th th-status">
											<td class="td-inner">交易状态</td>
										</div>
										<div class="th th-change">
											<td class="td-inner">交易操作</td>
										</div>
									</div>

									<div class="order-main">
										<div class="order-list">
										@foreach($order_paid as $v)
											<div class="order-status2">
												<div class="order-title">
													<div class="dd-num">订单编号：<a href="javascript:;">{{$v->orders_sign}}</a></div>
													<span>成交时间：{{$v->orders_time}}</span>
													<!--    <em>店铺：小桔灯</em>-->
												</div>
												<div class="order-content">
													<div class="order-left">
														<ul class="item-list">
															<li class="td td-item">
																<div class="item-pic">
																	<a href="/home/goods/{{$v->goods_id}}" class="J_MakePoint">
																		<img src="{{$v->goods_url}}" class="itempic J_ItemImg">
																	</a>
																</div>
																<div class="item-info">
																	<div class="item-basic-info">
																		<a href="/home/goods/{{$v->goods_id}}">
																			<p><?php echo substr($v->goods_name,0,37) ?></p>

																		</a>
																	</div>
																</div>
															</li>
															<li class="td td-price">
																<div class="item-price">
																	{{$v->orders_gprice}}
																</div>
															</li>
															<li class="td td-number">
																<div class="item-number">
																	<span>×</span>{{$v->orders_gnum}}
																</div>
															</li>
															<li class="td td-operation">
																<div class="item-operation">
																	
																</div>
															</li>
														</ul>

														
													</div>
													<div class="order-right">
														<li class="td td-amount">
															<div class="item-amount">
																合计：{{$v->orders_total}}
																<p>含运费：<span>10.00</span></p>
															</div>
														</li>
														<div class="move-right">
															<li class="td td-status">
																<div class="item-status">
																	<p class="Mystatus">{{$orders_status[$v->orders_id]}}</p>
																	<p class="order-info"><a href="/home/details">订单详情</a></p>
																</div>
															</li>
															<li class="td td-change">
																<div class="am-btn am-btn-danger anniu" onclick="alert('提醒成功,请耐心等待~~')">
																	提醒发货</div>
															</li>
														</div>
													</div>
												</div>
											</div>
													@endforeach
											{!! $order_paid->render() !!}											
										</div>
									</div>
								</div>
								<div class="am-tab-panel am-fade" id="tab4">
									<div class="order-top">
										<div class="th th-item">
											<td class="td-inner">商品</td>
										</div>
										<div class="th th-price">
											<td class="td-inner">单价</td>
										</div>
										<div class="th th-number">
											<td class="td-inner">数量</td>
										</div>
										<div class="th th-operation">
											<td class="td-inner">&nbsp;&nbsp;</td>
										</div>
										<div class="th th-amount">
											<td class="td-inner">合计</td>
										</div>
										<div class="th th-status">
											<td class="td-inner">交易状态</td>
										</div>
										<div class="th th-change">
											<td class="td-inner">交易操作</td>
										</div>
									</div>

									<div class="order-main">
										<div class="order-list">
										@foreach($order_send as $v)
											<div class="order-status3">
												<div class="order-title">
													<div class="dd-num">订单编号：<a href="javascript:;">{{$v->orders_sign}}</a></div>
													<span>成交时间：{{$v->orders_time}}</span>
													<!--    <em>店铺：小桔灯</em>-->
												</div>
												<div class="order-content">
													<div class="order-left">
														<ul class="item-list">
															<li class="td td-item">
																<div class="item-pic">
																	<a href="/home/goods/{{$v->goods_id}}" class="J_MakePoint">
																		<img src="{{$v->goods_url}}" class="itempic J_ItemImg">
																	</a>
																</div>
																<div class="item-info">
																	<div class="item-basic-info">
																		<a href="/home/goods/{{$v->goods_id}}">
																			<p><?php echo substr($v->goods_name,0,37) ?></p>

																		</a>
																	</div>
																</div>
															</li>
															<li class="td td-price">
																<div class="item-price">
																	{{$v->orders_gprice}}
																</div>
															</li>
															<li class="td td-number">
																<div class="item-number">
																	<span>×</span>{{$v->orders_gnum}}
																</div>
															</li>
															<li class="td td-operation">
																<div class="item-operation">
																	
																</div>
															</li>
														</ul>

												

													</div>
													<div class="order-right">
														<li class="td td-amount">
															<div class="item-amount">
																合计：{{$v->orders_total}}
																<p>含运费：<span>10.00</span></p>
															</div>
														</li>
														<div class="move-right">
															<li class="td td-status">
																<div class="item-status">
																	<p class="Mystatus">{{$orders_status[$v->orders_id]}}</p>
																	<p class="order-info"><a href="/home/details">订单详情</a></p>
																	{{--<p class="order-info"><a href="logistics.html">查看物流</a></p>--}}
																	<p class="order-info"><a href="#"></a></p>
																</div>
															</li>
															<li class="td td-change">
																<div class="am-btn am-btn-danger anniu"><a href="/home/orderupdate/{{$v->orders_id}}">
																	确认收货</a></div>
															</li>
														</div>
													</div>
												</div>
											</div>
												@endforeach
											{!! $order_send->render() !!}
										</div>
									</div>
								</div>

								<div class="am-tab-panel am-fade" id="tab5">
									<div class="order-top">
										<div class="th th-item">
											<td class="td-inner">商品</td>
										</div>
										<div class="th th-price">
											<td class="td-inner">单价</td>
										</div>
										<div class="th th-number">
											<td class="td-inner">数量</td>
										</div>
										<div class="th th-operation">
											<td class="td-inner">&nbsp;&nbsp;</td>
										</div>
										<div class="th th-amount">
											<td class="td-inner">合计</td>
										</div>
										<div class="th th-status">
											<td class="td-inner">交易状态</td>
										</div>
										<div class="th th-change">
											<td class="td-inner">交易操作</td>
										</div>
									</div>

									<div class="order-main">
										<div class="order-list">
										@foreach ($order_done as $v)
											
										
											<!--不同状态的订单	-->
										<div class="order-status4">
												<div class="order-title">
													<div class="dd-num">订单编号：<a href="javascript:;">{{$v->orders_sign}}</a></div>
													<span>成交时间：{{$v->orders_time}}</span>

												</div>
												<div class="order-content">
													<div class="order-left">
														<ul class="item-list">
															<li class="td td-item">
																<div class="item-pic">
																	<a href="/home/goods/{{$v->goods_id}}" class="J_MakePoint">
																		<img src="{{$v->goods_url}}" class="itempic J_ItemImg">
																	</a>
																</div>
																<div class="item-info">
																	<div class="item-basic-info">
																		<a href="/home/goods/{{$v->goods_id}}">
																			<p><?php echo substr($v->goods_name,0,37) ?></p>

																		</a>
																	</div>
																</div>
															</li>
															<li class="td td-price">
																<div class="item-price">
																	{{$v->orders_gprice}}
																</div>
															</li>
															<li class="td td-number">
																<div class="item-number">
																	<span>×</span>{{$v->orders_gnum}}
																</div>
															</li>
															<li class="td td-operation">
																<div class="item-operation">
																	
																</div>
															</li>
														</ul>

													</div>
													<div class="order-right">
														<li class="td td-amount">
															<div class="item-amount">
																合计：{{$v->orders_total}}
																<p>含运费：<span>10.00</span></p>
															</div>
														</li>
														<div class="move-right">
															<li class="td td-status">
																<div class="item-status">
																	<p class="Mystatus">{{$orders_status[$v->orders_id]}}</p>
																	<p class="order-info"><a href="/home/details">订单详情</a></p>
																	{{--<p class="order-info"><a href="logistics.html">查看物流</a></p>--}}
																</div>
															</li>
															<li class="td td-change">
																<a href="/home/evaluate/{{$v->goods_id}}">
																	<div class="am-btn am-btn-danger anniu">
																		评价商品</div>
																</a>
															</li>
														</div>
													</div>
												</div>
											</div>
											@endforeach
										{!! $order_done->render() !!}

										</div>

									</div>

								</div>
							</div>

						</div>
					</div>
				</div>
				@endsection