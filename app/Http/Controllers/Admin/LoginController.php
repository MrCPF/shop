<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
// use Bcrypt;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Login;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //登陆页面
    public function login()
    {   
        return view("admin.login");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //执行登陆
    public function doLogin(Request $request)
    {
        // dd($request->all());
        $ausers_name = $request->ausers_name;
       // dd($ausers_name);
        $passWord = md5($request->ausers_password);

        $model = new Login();

        $user = $model->getInfo($ausers_name);
        
        if(!empty($user)){
             if($user->ausers_password == $passWord){
                $request->session()->put('ausers_name', $user);
                return redirect('/admin/index');
            }else{
                return back()->with("msg","用户名或密码错误");
            }
        }else{
            return back()->with("msg","用户名不存在");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
