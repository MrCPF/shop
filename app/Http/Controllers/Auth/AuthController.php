<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Captcha;
use DB;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    // 认证成功的跳转地址
    protected $redirectPath = '/home/index';
    //退出后的跳转地址
    protected $redirectAfterLogout = '/home/index';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $messages = [
            'required' => ' :attribute 是必填字段',
            'size'     => ':attribute 手机号不是11位',
            'email'    => ':attribute 邮箱格式不正确',
            'min' => ':attribute 密码至少6位',
            'confirmed'=> ':attribute 密码不一致',
            'unique'   => '该邮箱已经被使用',
            'verify'   => ':attribute ',
        ];

        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'mobile'   => 'required|size:11',
            'verify'   => 'required',
        ],$messages);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        //插入主表   返回user对象信息
         $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => bcrypt($data['password']),
        ]);

        //如果有插入附加表的需要，可以在这里添加，不建议，因为用户表字段越少越好，其余信息可以在用户中心添加
        // 再次可以插入附加表user_info
        //先获取user的id,
        $uid = $user->id;
        $user_info = [];
        $user_info['pic'] = '/upload/images/default.jpg';
        $user_info['uid'] = $uid;
        DB::table('users_info')->insert($user_info);

        return $user;
    }

    /**
     * 生成验证码
     */
    public function Verify()
    {
        //返回url
        return Captcha::src();
    }

    /**
     * 验证验证码
     */
    protected function checkVerify($code)
    {
        return Captcha::check($code);
    }
}

















