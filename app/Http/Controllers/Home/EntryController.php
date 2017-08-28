<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Entry;
use Session;
use Captcha;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //加载认证页面
        $uid = Session::get('user')->id;

        return view('home.showEntry')->with('uid',$uid);
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

        //多图
        /*$imgs = $request->file('img');
        $urls=[];
        foreach($imgs as $img){
            if($img->isValid()){
                $ext = $img->getClientOriginalExtension(); //获取上传文件名的后缀名
                $path = 'upload/images/';
                $name = "origin_".time().rand(10,100).'.'.$ext;
                if($img->move($path,$name)){
                    $url = '/upload/images/'.$name;
                    $urls[]=['pic'=>$url];
                }
            }
        }

        $data =[
            'status'=>200,
            'msg'=>'成功',
            'data'=>$urls
        ];
        echo json_encode($data);*/

        $img = $request->file('img');
        if($img->isValid()) {
            $ext = $img->getClientOriginalExtension(); //获取上传文件名的后缀名
            $path = public_path('upload/images/');
            $name = "origin_" . time() . rand(10, 100) . '.' . $ext;
            if ($img->move($path, $name)) {
                $url = '/upload/images/' . $name;
                echo $url;
            }
        }


    }

    /**
     * 添加信息 提交入库
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function insert(Request $request)
    {
        $uid = Session::get('user')->id;
//        dd($request);
        $messages = [
            'busines_mobile.required' => '联系手机是必填项',
            'busines_name.required' => '商家名是必填项',
            'busines_address.required' => '地址是必填项',
            'busines_desc.required' => '地址是必填项',
            'busines_pic.required' => '图片必须传',
            'busines_mobile.regex' => '手机格式不正确',
            'verify.required'   => '验证码为必填项'
        ];


        $this->validate($request, [
            'busines_name' => 'required|max:16|unique:busines',
            'busines_desc' => 'max:100',
            'busines_mobile' => array('regex:/^1[34578]{1}\d{9}$/'),
            'busines_pic' => 'required'
        ],$messages);
        //设置默认状态 1
        $status = 1;
        //验证验证码
        if(!$this->checkVerify($request->verify)) {
            return back()->withErrors('验证码错误');
        }

        //验证用户 禁止一个用户注册多个店铺
        $busines_info = DB::table('busines')->where('apply_uid',$uid)->first();
        if(empty($busines_info)){
            //插入数据库
            $res = DB::table('busines')->insert([
                'busines_name'    => $request->busines_name,
                'busines_id'      => $request->busines_id,
                'created_at'      => $request->created_at,
                'updated_at'      => $request->updated_at,
                'busines_desc'   => $request->busines_desc,
                'busines_address' => $request->busines_address,
                'busines_mobile'   => $request->busines_mobile,
                'busines_status'   => $status,
                'busines_pic' => $request->busines_pic,
                'apply_uid' => $request->uid
            ]);
            if ($res) {
                return redirect('home/index')->withErrors('提交成功!请等待系统通知！');
            } else {
                return redirect()->back()->withInput()->withErrors('保存失败！');
            }
        }else{
            return back()->withErrors('请不要重复注册');
        }

    }


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
