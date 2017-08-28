<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*$data = DB::table('users')->paginate(3);
        return view('admin/user.user_list')->with('data',$data);*/


        //判断搜索条件
        $search = empty(trim($request->search)) ? '' : trim($request->search);

        //拼接sql语句
        $data = DB::table('users')->where('name', 'like', '%'.$search.'%')->paginate(3);
        $info = DB::table('users')->where('name', 'like', '%'.$search.'%')->get();
        $count = count($info);


        return view('admin/user.user_list')->with('search',$search)->with('data',$data)->with('count',$count);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/user.user_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ' :attribute 是必填字段',
            'size'     => ':attribute 手机号不是11位',
            'email'    => ':attribute 邮箱格式不正确',
            'min' => ':attribute 密码至少6位',
            'confirmed'=> ':attribute 密码不一致',
            'unique'   => '该邮箱已经被使用',
        ];

        $this->validate($request, [
            'name' => 'required|max:16',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'mobile'   => 'required|size:11',
        ],$messages);


        $user['name']        = $request->name;
        $user['password']    = bcrypt($request->password);
        $user['mobile']      = $request->mobile;
        $user['email']       = $request->email;
        $user['created_at']  = date("Y-m-d H:i:s");
        $user['updated_at']  = date("Y-m-d H:i:s");
        $res = DB::table('users')->insert($user);
        if($res){
            return redirect('/admin/user');
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
        $data = DB::table('users')->where('id',$id)->first();
        return view('admin/user.user_show')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('users')->where('id',$id)->first();
        return view('admin/user.user_edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        DB::table('users')->where('id',$id)->update(['name'=>$request->name,'email'=>$request->email,'mobile'=>$request->mobile]);
        return redirect('/admin/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = DB::table('users')->where('id',$id)->delete();
        if($res){
            return view('/admin/user');
        }else{
            return back();
        }
    }

    public function delete($id)
    {
        $res = DB::table('users')->where('id',$id)->delete();
        if($res){
            return 1;
        }else{
            return 0;
        }
    }

   
}
