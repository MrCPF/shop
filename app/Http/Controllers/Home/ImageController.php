<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use DB;
use App\Model\User;
class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //头像上传
        $img = $request->file('photo');
           if($img->isValid()){
               $ext = $img->getClientOriginalExtension(); //获取上传文件名的后缀名
               $path = public_path('upload/pictures/');
               $name = "origin_".time().rand(10,100).'.'.$ext;
               if($img->move($path,$name)){
                   $url = '/upload/pictures/'.$name;
                   $uid = Session::get('user')->id;
                   $data = DB::table('users_info')->where('uid',Session::get('user')->id)->first();
                   if($data->pic !== '/upload/pictures/default.jpg' && $data->pic !== ""){
                       unlink(public_path($data->pic));
                       DB::table('users_info')->where('uid',Session::get('user')->id)->where('pic','<>','')->delete();
                   }
                   DB::table('users_info')->insert(['pic'=>$url,'uid'=>$uid]);
                   echo $url;
               }
           }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * 更新用户信息
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => ' :attribute 是必填字段',
            'mobile'     => ':attribute 必须填写正确格式的手机号',
            'email'    => ':attribute 邮箱格式不正确',
        ];

        $this->validate($request, [
            'name' => 'required|max:30',
            'email' => 'required|email|max:60',
            'mobile'   => array('regex:/^1[34578]{1}\d{9}$/'),
        ],$messages);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->sex = $request->sex;
        $user->mobile = $request->mobile;
        $user->save();
        $user = User::find($id);
        Session::forget('user');
        Session::put('user',$user);
        return redirect('/home/userInfo');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
