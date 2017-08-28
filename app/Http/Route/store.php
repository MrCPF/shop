<?php
//路由群组
Route::group(['namespace'=>'Home','prefix'=>'home',],function(){
    //个人中心资源路由
    Route::resource('store','StoreController');
});

//前台店铺搜索功能
Route::get('home/storesearch/{search?}','Home\StoreController@search');
