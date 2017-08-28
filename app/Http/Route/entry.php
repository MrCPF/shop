<?php
//路由群组
Route::group(['namespace'=>'Home','prefix'=>'home','middleware' => 'home.login'],function(){

    //商家管理资源路由
    Route::resource('entry','entryController');
    Route::post('entryInsert','entryController@insert');
    //引入前台商家认证提交路由
//    Route::post('businesapply','UserController@doEntry');
});