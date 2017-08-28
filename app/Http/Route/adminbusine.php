<?php
//商家后台路由群组
Route::group(['namespace'=>'Adminbusine','prefix'=>'adminbusine','middleware' => 'adminbusine.login'],function(){
    Route::get('index', 'IndexController@index');
    Route::get('welcome',function(){
        return  view('adminbusine.welcome');
    });

    //会员管理资源路由
    Route::resource('user','UserController');
    //手动删除路由
    Route::post('user/delete/{id}','UserController@delete');
    //栏目管理路由
    Route::resource('cat','CatController');
    //手动删除路由
    Route::post('cat/delete/{id}','CatController@delete');
    //分类管理路由
    Route::resource('goods','GoodsController');
    //手动删除路由
    Route::post('goods/delete/{id}','GoodsController@delete');
    //图片管理路由
    Route::resource('photo','PhotoController');
    //手动删除路由
    Route::post('photo/delete/{id}','PhotoController@delete');
    //搜索路由
    Route::get('/find/{search?}','GoodsController@index');
    //商家后台退出操作路由
    Route::get('busines_ausers/logout/{busines_aid}', 'Busines_AusersController@getLogout');
    //自定义添加商品
    Route::post('goodsInsert','GoodsController@insert'); 
    //自定义编辑商品图片
    Route::get('picedit/{goods_id?}','GoodsController@picedit');
    //自定义添加商品图片
    Route::get('picadd/{goods_id?}','GoodsController@picadd');
    //自定义添加商品图片操作
    Route::post('picinsert/{goods_id?}','GoodsController@picInsert');
    //批量删除图片
    Route::post('deletes','GoodsController@deletes');
    //商品下架
    Route::post('under/{goods_id?}','GoodsController@under');
    });
    
    //商家登录路由
    Route::get('adminbusine/login','Adminbusine\LoginController@index');

    //商家登录认证路由
    Route::post('/adminbusine/dologin','Adminbusine\LoginController@doLogin');
