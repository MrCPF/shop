<?php
//路由群组
Route::group(['namespace'=>'Home','prefix'=>'Home'],function(){

    //商家管理资源路由
    Route::resource('busentry','BusentryController');

    //手动删除用户路由
//    Route::post('busentry/delete/{busines_id}','BusinesController@delete');

});