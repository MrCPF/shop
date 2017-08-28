<?php

Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware' => 'admin.login'],function(){
    		Route::get('goods','GoodsController@index');

    		//添加产品路由
    		Route::resource('goods','GoodsController');
    		
    		//自定义删除
    		Route::post('goods/del/{goods_id}','GoodsController@del');

			//自定义添加商品
            Route::post('goodsInsert','GoodsController@insert');


            //添加图片路由进入goods_image.blade.php页面
            Route::get("image/{goods_id}","GoodsController@image");

            //添加图片路由进入goods_img.blade.php页面
            Route::get("img/{id}","GoodsController@img");

            //添加图片路由回到goods_image.blade.php页面
            Route::post("goodsImgs","GoodsController@goodsImg");

            //批量删除
            Route::post('deletes','GoodsController@groupdel');


            //总后台评论列表
            Route::get('eval','EvalController@index');

            //总后台评论删除
            Route::post('eval/del/{eval_id}','EvalController@del');

            //总后台回复列表
            Route::get('replys','ReplysController@index');
            //总后台回复删除
            Route::post('replys/del/{replys_id}','ReplysController@del');

            //总后台搜索商品路由
            Route::get('/findGoods/{search?}','GoodsController@index');

});
        //商家评论列表
          Route::resource('adminbusine/eval',
            'AdminBusine\EvalController@index'
            );
        //商家评论删除列表
          Route::post('
            adminbusine/eval/del/{eval_id}',
            'AdminBusine\EvalController@del'
            );
        //商家回复列表
        Route::resource('adminbusine/replys',
            'AdminBusine\ReplysController@index'
            );
