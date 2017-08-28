<?php

namespace App\Http\Controllers\Adminbusine;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //跳到登录界面
    public function index()
    {
    
        return view('adminbusine.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //登录界面操作
    public function doLogin(Request $request)
    {   
        //获取输入的id
         $bid = $request->id;
         $res=DB::table('busines')->where('busines_id',$bid)->first()->busines_status;
         if($res==1){
            return back()->withError('商家无权限');
         }else{
         $name = $request->name;
         $password = md5($request->password);
         $data = DB::table('busines_ausers')->where('busines_aname',$name)->where('busines_auth',0)->where('busines_bid',$bid)->first();
         if(!empty($data)){
            if($data->busines_apassword == $password){

                $request->session()->put('busines_aname', $data);
                  // dd(Session::get('busines_aname'));

                return redirect('/adminbusine/index');
            }else{
                return back()->with("msg","用户名或密码错误");
                 }
         }else{
            return back()->with("msg","用户名不存在");
        }
        }
    }
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
