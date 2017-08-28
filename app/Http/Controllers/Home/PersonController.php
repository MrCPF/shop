<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\User;
use Session;
use DB;
use Auth;
use Validator;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userInfo = User::find(Session::get('user')->id);
        $userInfo2 = DB::table('users_info')->where('uid',Session::get('user')->id)->where('pic','<>','')->orderBy('id','desc')->first();
        return view('home.userInfo')->with('userInfo',$userInfo)->with('userInfo2',$userInfo2);
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

    /**
     * 安全设置页面
     */
    public function showSafe()
    {
        $userInfo = User::find(Session::get('user')->id);
        $userInfo2 = DB::table('users_info')->where('uid',Session::get('user')->id)->orderBy('id','desc')->first();
        return view('home.user_safe')->with('userInfo2',$userInfo2)->with('userInfo',$userInfo);
    }

    /**
     * 发送邮件成功时的跳转页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSuc()
    {
        return view('home.success');
    }

    /**
     * 收货地址编辑页面显示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAddress()
    {
        $id = Session::get('user')->id;
        $addressInfo = DB::table('users_info')->where('uid',$id)->where('pic','=','')->get();
        return view('home.user_address')->with('id',$id)->with('addressInfo',$addressInfo);
    }

    /**
     * 新增收货地址
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addAddress(Request $request,$id)
    {
        $messages = [
            'required' => ' :attribute 是必填字段',
            'name'     => ':attribute 收货人必须填写',
            'mobile'    => '手机格式不正确',
            'address' => ':attribute 请填写详细地址',
        ];

        $this->validate($request, [
            'name' => 'required|max:60',
            'mobile'   => array('regex:/^1[34578]{1}\d{9}$/'),
            'address' => 'required|max:120',
        ],$messages);

        $name     = $request->name;
        $mobile   = $request->mobile;
        $address  = $request->s_province=="省份" ? '' : $request->s_province;
        $address .= $request->s_city=="地级市" ? '' : $request->s_city ;
        $address .= $request->s_county=="市、县级市" ? '' : $request->s_county;
        $address .= $request->address=="" ? '' : $request->address;
        empty($address) ? "" : $request->address;
        $sign = DB::table('users_info')->select('sign')->where('uid',$id)->where('pic','=','')->first();
        if(empty($sign)){
            DB::table('users_info')->insert([
                'uid'        => $id,
                'sign'       => 0,
                'name'       => $name,
                'mobile'     => $mobile,
                'address'    => $address,
                'created_at' => $request->created_at,
                'updated_at' => $request->updated_at
            ]);
        }else{
            if($sign->sign == 0){
                $sign = 1;
            }
            DB::table('users_info')->insert([
                'uid'        => $id,
                'sign'       => $sign,
                'name'       => $name,
                'mobile'     => $mobile,
                'address'    => $address,
                'created_at' => $request->created_at,
                'updated_at' => $request->updated_at
            ]);
        }
        return redirect('/home/address');
    }

    /**
     * 编辑收货地址页面
     * @param $id
     * @return $this
     */
    public function editAddress($id)
    {
        $addressInfo = DB::table('users_info')->where('id',$id)->first();
        return view('home.user_editAddress')->with("addressInfo",$addressInfo);
    }

    /**
     * 编辑收货地址操作
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateAddress(Request $request,$id)
    {
        $messages = [
            'required' => ' :attribute 是必填字段',
            'name'     => ':attribute 收货人必须填写',
            'mobile'    => '手机格式不正确',
            'address' => ':attribute 请填写详细地址',
        ];

        $this->validate($request, [
            'name' => 'required|max:60',
            'mobile'   => array('regex:/^1[34578]{1}\d{9}$/'),
            'address' => 'required|max:120',
        ],$messages);

        $name     = $request->name;
        $mobile   = $request->mobile;
        $address  = $request->s_province=="省份" ? '' : $request->s_province;
        $address .= $request->s_city=="地级市" ? '' : $request->s_city ;
        $address .= $request->s_county=="市、县级市" ? '' : $request->s_county;
        $address .= $request->address=="" ? '' : $request->address;
        empty($address) ? "" : $request->address;
        DB::table('users_info')->where('id',$id)->update([
            'name'       => $name,
            'mobile'     => $mobile,
            'address'    => $address,
            'updated_at' => $request->updated_at
        ]);
        return redirect('/home/address');
    }

    /**
     * 删除收货地址操作
     * @param $id
     */
    public function delAddress($id)
    {
        DB::table('users_info')->where('id',$id)->delete();
        return redirect('/home/address');
    }

    /**
     * 更改收货地址
     */
    public function changeAddress(Request $request)
    {
        $userInfo = DB::table('users_info')->where('id',$request->id)->first();
        DB::table('users_info')->where('sign',0)->where('uid',$userInfo->uid)->update(['sign'=>1]);
        DB::table('users_info')->where('id',$request->id)->update(['sign'=>0]);
        return 1;
    }
}
