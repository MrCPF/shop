<?php
//路由群组
Route::group(['namespace'=>'Home','prefix'=>'home','middleware' => 'home.login'],function(){
    //个人中心资源路由
    Route::resource('userInfo','PersonController');
    //修改头像资源路由
    Route::resource('image','ImageController');
    //修改个人资料
    Route::post('image/{id}','ImageController@up');
    //安全设置--渲染页面
    Route::get('safe','PersonController@showSafe');
    //安全设置--密码设置
    Route::get('pwd','PersonController@showPwd');
   /* //购物车
    Route::resource('cart','CartController');*/
    //清空购物车
    Route::get('cartdel','CartController@dellCart');
    //移除购物车中的一件商品
    Route::get('removeItem/{rowId}','CartController@removeItem');
   /* //添加商品到购物车
    Route::get('addCart/{gid}/{num?}','CartController@addCart');*/

    //安全设置--邮件发送成功
    Route::get('success','PersonController@showSuc');
    //收货地址
    Route::get('address','PersonController@showAddress');
    //新增收货地址
    Route::post('address/add/{uid}','PersonController@addAddress');

    //编辑收货地址
    Route::get('address/edit/{id}','PersonController@editAddress');
    //更新收货地址
    Route::post('address/edit/{id}','PersonController@updateAddress');
    //删除收货地址
    Route::get('address/del/{id}','PersonController@delAddress');
    //临时修改收货地址
    Route::post('address/change','PersonController@changeAddress');

    //显示结算路由
    Route::resource('showpay','OrdersController');
    //显示支付路由
    Route::resource('paysuccess','OrdersController');
    //订单生成路由
    Route::get('pay','OrdersController@createOrder');
    //显示二次进入支付页面
    Route::get('paySuc/{order_id}','OrdersController@paySuc');
    //订单详情页
    Route::get('details','OrdersController@showDetails');
    //订单列表
    Route::get('userinfo','OrdersController@showOrder');
    //订单支付
    Route::post('dopay','OrdersController@doPay');
    //订单删除路由
    Route::get('orderdel/{orders_id}',"OrdersController@orderDel");
    //前台订单确认收货
    Route::get('orderupdate/{orders_id}',"OrdersController@orderUpdate");
  
    //退款显示路由
    Route::get('orderrefund','OrdersController@orderRefund');
    //评价路由
    Route::resource('evaluate','EvaluateController');
    //显示已评价列表
    Route::get('evalList','EvaluateController@evalList');
    //显示回复页面路由
    Route::resource('reply','ReplyController');
    //订单详情页
     Route::get('details','OrdersController@showDetails');
});

//前台首页
Route::get('home/index','Home\IndexController@index');
//前台栏目管理资源路由
Route::resource('home/cat','Home\CatController');
//前台用户中心资源路由
Route::resource('home/user','Home\UserController');
//商品页面
Route::resource('home/goods','Home\GoodsController');
//购物车
Route::resource('home/cart','Home\CartController');
//清空购物车
Route::get('home/cartdel','Home\CartController@dellCart');
//移除购物车中的一件商品
Route::get('home/removeItem/{rowId}','Home\CartController@removeItem');
//添加商品到购物车
Route::get('home/addCart/{gid}/{num?}','Home\CartController@addCart');
//前台搜索功能
Route::get('home/search/{search?}','Home\CatController@search');

