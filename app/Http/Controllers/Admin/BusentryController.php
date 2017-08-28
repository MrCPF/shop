<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Busentry;
use DB;
use Session;

class BusentryController extends Controller
{
    /**
     * 搜索
     * @return mixed
     */
    public function index(Request $request)
    {
        /*//查询出所有的申请数据    0 商家  1 user
        $datas = DB::table('busines')->where('busines_status',1)->paginate(3);

        //显示申请的数据
        return view('admin/busentry.busentry_index')->with('datas',$datas);*/

        //搜索
        $count=DB::table('busines')->where('busines_status',1)->count('busines_id');
        // 判断搜索条件
        $search = empty(trim($request->search)) ? '' : trim($request->search);
        //从表中查询数据
        $datas = DB::table('busines')->where('busines_name', 'like', '%'.$search.'%')->where('busines_status',1)->paginate(3);

        foreach($datas as $data){
            $img = DB::table('busines')->select('busines_pic')->where('busines_id',$data->busines_id)->first();

            $url =  !empty($img) ? $img->busines_pic : '';
            $datas->busines_pic = $url;
        }
        return view('admin/busentry.busentry_index')->with('search',$search)->with('datas',$datas)->with('count',$count);
    }



    // 商家认证状态修改
    /**
     * @param $id  是busines表的 busines_id
     * busines表的apply_uid  =  user表的 id
     * 'busines_bid'=  $id]   连表
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function status($id)
    {
//        //拿到用户信息
//        $uid = Session::get('user')->id;
//        $user_info = DB::table('users')->find($uid);
        //查询到user表的uid
        $apply_uid = DB::table('busines')->where('busines_id',$id)->first()->apply_uid;
        //通过uid 查询user信息
        $user_info = DB::table('users')->where('id',$apply_uid)->first();

        $user_email = $user_info->email;
        $user_password = $user_info->password;

        //查出一条用户数据 将其状态改为0 则成为商家
        $data = DB::table('busines')->where('busines_id',$id)->first();

        $status = $data->busines_status;

        $str = md5('123456');
        if($status == 1){
            DB::table('busines')->where('busines_id',$id)->update(['busines_status'=>0]);

            DB::table('busines_ausers')->insert([
                'busines_aname' => 'admin',
                'busines_apassword' =>  $str,
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
                'busines_bid'=> $id]);

            return redirect('admin/busines');
        }

    }

    //删除审核表单（不完善）
    public function del($id)
    {
        //删除商家前删除图片
        $data = DB::table('busines')->where('busines_id',$id)->first();
        //获取图片路径
        $pic = $data->busines_pic;

        if(file_exists($pic)){
            unlink(public_path($pic));
            DB::table('busines')->where('busines_id',$id)->delete();
            return redirect('admin/busentry');
        }else{
            DB::table('busines')->where('busines_id',$id)->delete();
            return redirect('admin/busentry');
        }
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

}
