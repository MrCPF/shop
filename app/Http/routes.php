<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
require_once app_path('Http/Route').'/admin.php';

require_once app_path('Http/Route').'/index.php';

//引入商家管理的路由
require_once app_path('Http/Route').'/busines.php';

//引入后台商家申请入驻路由
require_once app_path('Http/Route').'/busentry.php';

//引入前台商家注册
require_once app_path('Http/Route').'/entry.php';

//引入商家后台管理
require_once app_path('Http/Route').'/adminbusine.php';

//引入商家后台订单管理
require_once app_path('Http/Route').'/adminorder.php';

//引入商家管理界面
require_once app_path('Http/Route').'/goods.php';

//引入店铺主页路由
require_once app_path('Http/Route').'/store.php';



Route::get('/', function () {
    return view('welcome');
});

//资源路由
Route::resource('/art','ArticleController');
// Route::controller('/arts','ArticleController');

Route::controller('/cs','ArticleController');

//登录注册
// 认证路由...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
// 注册路由...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// 首页路由
Route::get('auth/index',['middleware' => 'auth',function(){
    return view('home.index');
}]);

//加载后台登陆页面,路由
Route::get("/admin/login","Admin\LoginController@login");
Route::post("/admin/doLogin","Admin\LoginController@doLogin");

// 密码重置链接请求路由
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
// 密码重置路由
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

//测试验证码路由
Route::get('aaa','Auth\AuthController@Verify');
Route::get('bbb','Auth\AuthController@checkVerify');

//前台显示订单路由
Route::get('orderInfo','Home\OrdersController@showOrder');











