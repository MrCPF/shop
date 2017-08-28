<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Validator;
class AusersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         /*$data = DB::table('ausers')->paginate(3);
         $count=DB::table('ausers')->count('ausers_id');*/

        $count=DB::table('ausers')->count('ausers_id');
        //判断是否有搜索条件
        $search = empty(trim($request->search)) ? '' : trim($request->search);
        //拼接sql语句
        $data = DB::table('ausers')->where('ausers_name', 'like', '%'.$search.'%')->paginate(3);

        return view('admin/ausers.ausers_list')->with("data",$data)->with("count",$count);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/ausers.ausers_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
                'ausers_name'=>'required|max:12',
                'ausers_email'=>'required',
                'ausers_password'=>'required', 
                ]);
                $user['ausers_name']=$request->ausers_name;
                // dd($user);
                $user['ausers_email']=$request->ausers_email;
                $user['ausers_password']=md5($request->ausers_password);
                DB::table('ausers')->insert($user);
                return redirect('/admin/ausers');
    
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
        $ausers = DB::table('ausers')->where('ausers_id', $id)->first();
        return view('/admin/ausers.ausers_pwd')->with('ausers',$ausers);        
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
        $messages = [
            'required' => ' :attribute 是必填字段',
            'email'    => ':attribute 邮箱格式不正确',
            'min' => ':attribute 密码至少6位',
            'unique'   => '该邮箱已经被使用',
        ];

        $this->validate($request, [
            'ausers_name' => 'required|max:255',
            'ausers_email' => 'required|email|max:255|unique:ausers',
            'oldpassword' => 'required|min:6',
            'ausers_password' => 'required|min:6',
        ],$messages);   

        $user = DB::table('ausers')->where('ausers_id',$id)->first();
        $pwd = md5($request->oldpassword);
        if($user->ausers_password !== $pwd){
            return back()->withErrors('原密码错误！');
        }
        $ausers_password = $request->ausers_password;        
        $password_confirmation = $request->password_confirmation;
        if($ausers_password !== $password_confirmation){
            return back()->withErrors('密码不一致！');
        } 

        $ausers_password = md5($request->ausers_password);

        DB::table('ausers')->where('ausers_id', $id)
            ->update([
            'ausers_name' => $request->ausers_name,
            'ausers_email' => $request->ausers_email,
            'ausers_password' => $ausers_password,
            'updated_at' => $request->updated_at,
        ]);

         return redirect('/admin/ausers');
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

    /**
     * @param  [type] $id
     *删除管理员
     * @return [type]
     */
    public function delete($id)
    {
        $data=DB::table('ausers')->where('ausers_id',$id)->delete();
        
            
            return 1;        
    }
    /**
     * 退出
     * @return [type]
     */
    public function getLogout($id)
    {

        Session::forget('ausers_name');
       // dd(Session::get('ausers_name'));
        return redirect('admin/login');
    }

}
