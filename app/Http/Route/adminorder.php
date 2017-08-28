<?php
Route::group(['namespace'=>'Adminbusine','prefix'=>'adminbusine'],function(){
	Route::get('index', 'IndexController@index');
	
	//后台订单管理资源路由
    Route::resource('order','OrderController');	
	//该订单发货路由
    Route::get('orderupdate/{orders_id}',"OrderController@orderUpdate");   



    //后台订单搜索路由
    Route::get('search','OrderController@index');    

	    
});