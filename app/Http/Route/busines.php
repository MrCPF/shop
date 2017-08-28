<?php
//路由群组
Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware' => 'admin.login'],function() {

    //商家管理资源路由
    Route::resource('busines', 'BusinesController');

    //手动删除商家路由
//    Route::('busines/del/{id}','BusinesController@del');
    Route::get("busines/del/{id}","BusinesController@del");

    //商家状态路由
    Route::get('busines/status/{id}', 'BusentryController@status');

    //商家信息修改路由
    Route::Post('edit', 'BusinesController@entryUpdate');

    //商家启用禁用状态修改
    Route::get('busines/doEditStatus/{id}', 'BusinesController@doEditStatus');

    //搜索商家路由
    Route::get('/find/{search?}','BusinesController@index');

    //删除商家放进回收站路由
    Route::get('showRecycle','BusinesController@showRecycle');

    //将删除的商家从回收站还原
    Route::get('busines/doRecycle/{id}','BusinesController@doRecycle');

    //搜索商家路由
    Route::get('/findRecycle/{search?}','BusinesController@showRecycle');
});