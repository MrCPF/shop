<?php
//路由群组
Route::group(['namespace'=>'Admin','prefix'=>'admin'],function(){

    //商家管理资源路由
    Route::resource('busentry','BusentryController');

    //商家申请通过与否路由（不完善）
    Route::get('busentry/status/{id}','BusentryController@status');

    //商家申请单删除路由（不完善）
    Route::get("busentry/del/{id}","BusentryController@del");

    //搜索路由
    Route::get('/findApply/{search?}','BusentryController@index');


});