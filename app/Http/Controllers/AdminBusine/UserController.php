<?php

namespace App\Http\Controllers\AdminBusine;

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
    public function index()
    {

         $data = DB::table('busines_ausers')->paginate(3);
         // dd($data);
         $count= DB::table('busines_ausers')->count('busines_aid');
         return view('adminbusine/user.user_list')->with('data',$data)->with('count',$count);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminbusine/user.user_add');
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
            'min' => ':attribute 密码至少6位',
            'confirmed'=> ':attribute 密码不一致',
        ];

        $this->validate($request, [
            'name' => 'required|max:16',
            'password' => 'required|confirmed|min:6',
        ],$messages);
        $user['busines_bid']   = $request->session()->get('busines_aname')->busines_bid;
        $user['busines_aname']        = $request->name;
        $user['busines_apassword']    = md5($request->password);
        $user['created_at']  = date("Y-m-d H:i:s");
        $user['updated_at']  = date("Y-m-d H:i:s");
        $res = DB::table('busines_ausers')->insert($user);
        if($res){
            return redirect('/adminbusine/user');
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

          $data = DB::table('busines_ausers')->where('busines_aid',$id)->first();
          // dd($data);
         return view('adminbusine/user.user_show')->with('data',$data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {       

          $data = DB::table('busines_ausers')->where('busines_aid',$id)->first();
          return view('adminbusine/user.user_edit')->with('data',$data);
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
         $time = date("Y-m-d H:i:s");
         $data = DB::table('busines_ausers')->where('busines_aid',$id)->update(['busines_aname'=>$request->name,'updated_at'=>$time]);
         return redirect('/adminbusine/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = DB::table('busines_ausers')->where('id',$id)->delete();
        if($res){
            return view('/adminbusine/user');
        }else{
            return back();
        }
    }
    //删除用户操作
    public function delete($id)
    {
        $res = DB::table('busines_ausers')->where('busines_aid',$id)->delete();
        if($res){
            return 1;
        }else{
            return 0;
        }
    }
    //停用用户
    // public function forbid($id)
    // {
    //     $res = DB::table('busines_ausers')->where('busines_aid',$id)->
    // }
}
