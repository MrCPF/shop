<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App\Model\Busines;
use Session;

class BusinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*//查出所有商家数据  0 商家 1 普通用户
        $users = DB::table('busines')->where('busines_status', '<>', 1)->paginate(10);
        return view('admin\busines.busines_index')->with('users', $users);*/

        $count=DB::table('busines')->where('busines_status','<>',1)->where('busines_status','<>',3)->count('busines_id');

        //判断搜索条件
        $search = empty(trim($request->search)) ? '' : trim($request->search);
        //拼接sql语句
        $users = DB::table('busines')->where('busines_name', 'like','%'.$search.'%')->where('busines_status','<>',1)->where('busines_status','<>',3)->paginate(10);

        //遍历拿到图片数据
        foreach($users as $user){
            $img = DB::table('busines')->select('busines_pic')->where('busines_id',$user->busines_id)->first();

            $url =  !empty($img) ? $img->busines_pic : '';
            $user->busines_pic = $url;
        }
        return view('admin\busines.busines_index')->with('search',$search)->with('users',$users)->with('count',$count);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*//跳转到添加页
        return view('admin\busines.busines_add');*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $img = $request->file('img');
        if ($img->isValid()) {
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
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $users = DB::table('busines')->where('busines_id', $id)->first();
//        dd($users);
        //用户个人详情
        return view('admin\busines.busines_show')->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //跳转到编辑页面
        $datas = DB::table('busines')->where('busines_id', $id)->first();

        return view('admin\busines.busines_edit')->with('datas', $datas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * 商家信息更新修改
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function entryUpdate(Request $request)
    {
        $messages = [
            'busines_mobile.required' => '联系手机是必填项',
            'busines_name.required' => '商家名是必填项',
            'busines_address.required' => '地址是必填项',
            'busines_desc.required' => '地址是必填项',
            'busines_pic.required' => '图片必须传',
            'busines_mobile.regex' => '手机格式不正确',
        ];


        $this->validate($request, [
            'busines_name' => 'required|max:16',
            'busines_desc' => 'max:100',
            'busines_mobile' => array('regex:/^1[34578]{1}\d{9}$/'),
            'busines_pic' => 'required'
        ], $messages);

        //插入数据库
//        dd($request->all());
        $busines_id = $request->busines_id;

        $res = DB::table('busines')->where('busines_id', $busines_id)->update([
            'busines_name' => $request->busines_name,
            'busines_id' => $request->busines_id,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
            'busines_desc' => $request->busines_desc,
            'busines_address' => $request->busines_address,
            'busines_mobile' => $request->busines_mobile,
            'busines_pic' => $request->busines_pic
        ]);

        return redirect('admin/busines');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* $res = DB::table('busines')->where('busines_id',$id)->delete();
         if($res){
             return view('/admin/busines');
         }else{
             return back();
         }*/
    }


    /**
     * 删除商家进入回收站
     * $id   = busines_id  = busines_bid
     * @param $id
     * @return int
     */
    public function del($id)
    {
        /*//删除商家前删除图片
        $data = DB::table('busines')->where('busines_id',$id)->first();
        //获取图片路径
        $pic = $data->busines_pic;
//        dd($pic);
        if($pic){
            unlink(public_path($pic));
            //删除
            DB::table('busines')->where('busines_id',$id)->delete();
            DB::table('busines_ausers')->where('busines_bid',$id)->delete();
            return redirect('admin/busines');
        }else{
            DB::table('busines')->where('busines_id',$id)->delete();
            DB::table('busines_ausers')->where('busines_bid',$id)->delete();
            return redirect('admin/busines');
        }*/

        //放入回收站
        DB::table('busines')->where('busines_id', $id)->update([
            'busines_status'=>3
        ]);
        return redirect('admin/busines');
    }

    /**
     * 修改商家启用禁用   0 启用  2 禁用，并且禁止登录商家后台
     *                 0  商家  1 apply 申请单
     * @param $id   = busines_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function doEditStatus($id)
    {
        //查询出商家原来状态
        $status = DB::table('busines')->where('busines_id', $id)->first()->busines_status;
        //判断
        $status = $status ? 0 : 2;
        DB::table('busines')->where('busines_id', $id)->update(['busines_status' => $status]);

        if ($status == 2) {
            $ausers = DB::table('busines_ausers')->where('busines_bid', $id)->get();
            for ($i = 0; $i < count($ausers); $i++) {
                DB::table('busines_ausers')->where('busines_aid', $ausers[$i]->busines_aid)->update(['busines_auth' => 1]);
            }
        }else {
            $ausers = DB::table('busines_ausers')->where('busines_bid', $id)->get();
            for ($i = 0; $i < count($ausers); $i++) {
                DB::table('busines_ausers')->where('busines_aid', $ausers[$i]->busines_aid)->update(['busines_auth' => 0]);
            }
        }
        return redirect('admin/busines');
    }

    /**
     * 展示回收站页面
     * @param Request $request
     * @return mixed
     */
    public function showRecycle(Request $request)
    {
        //展示回收站页面
//搜索
        $count=DB::table('busines')->where('busines_status',3)->count('busines_id');
        // 判断搜索条件
        $search = empty(trim($request->search)) ? '' : trim($request->search);
        //从表中查询数据
        $recycles = DB::table('busines')->where('busines_name', 'like', '%'.$search.'%')->where('busines_status',3)->paginate(3);

        foreach($recycles as $recycle){
            $img = DB::table('busines')->select('busines_pic')->where('busines_id',$recycle->busines_id)->first();

            $url =  !empty($img) ? $img->busines_pic : '';
            $recycle->busines_pic = $url;
        }
        return view('admin\busines.showRecycle')->with('search',$search)->with('recycles',$recycles)->with('count',$count);
    }

    public function doRecycle($id)
    {

        $res = DB::table('busines')->where('busines_id', $id)->update([
            'busines_status'=>0
        ]);
        if(!$res){
            return back()->withErrors('还原失败');
        }
        return redirect('admin/busines');
    }
}