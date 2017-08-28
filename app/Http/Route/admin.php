<?php
//路由群组
//,'middleware' => 'admin.login'
Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware' => 'admin.login'],function(){
    Route::get('index', 'IndexController@index');
    Route::get('welcome',function(){
        return  view('admin.welcome');
    });
    //会员管理资源路由
    Route::resource('user','UserController');

    //手动删除用户路由
    Route::post('user/delete/{id}','UserController@delete');

    //栏目管理路由
    Route::resource('cat','CatController');


    Route::resource('goods.goods','CatsController');

    //管理员资源路由
    Route::resource('ausers','AusersController');

    //手动删除栏目路由
    Route::post('cat/delete/{cats_id}','CatController@del');

    //后台管理员删除路由
    Route::post('ausers/delete/{ausers_id}','AusersController@delete');

    //后台退出操作路由
    Route::get('ausers/logout/{ausers_id}', 'AusersController@getLogout');


    //网站配置路由
    Route::resource('config','ConfigController');

    //会员用户搜索路由users
    Route::get('/findAdmin','UserController@index');

    //管理搜索路由 ausers
    Route::get('/findAusers','AusersController@index');

    //后台订单显示路由
    Route::resource('orders','OrdersController');

    //后台订单搜索
    Route::get('/findOrder/{search?}','OrdersController@index');

});


