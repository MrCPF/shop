<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;

class ReplyController extends Controller
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
     * 添加回复
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $eval_eid       = $request->eval_eid;
        $goods_id       = $request->goods_id;
        $replys_bid       = DB::table('goods')->where('goods_id',$goods_id)->first()->goods_bid;
        $replys_content = $request->replys_content;
        $time = date('Y-m-d H:i:s');
        $replys_id = DB::table('replys')->insertGetId([
            'replys_uid'     => $user->id,
            'replys_eid'       => $eval_eid,
            'replys_bid'       => $replys_bid,
            'replys_content' => $replys_content,
            'replys_time'    => $time,
            'created_at'     => $time,
            'updated_at'     => $time,
        ]);
        return redirect("/home/goods/$goods_id");
    }

    /**
     * 显示回复页面
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $evaluate = DB::table('evaluates')->where('eval_id',$id)
            ->join('users','users.id','=','evaluates.eval_uid')
            ->join('goods','goods.goods_id','=','evaluates.eval_gid')
            ->select('users.*','goods.*','evaluates.*')
            ->first();
        $data = DB::table('goods_imgs')->where('goods_id',$evaluate->goods_id)->first();
        $evaluate->goods_url = $data->goods_url;
        $replys = DB::table('replys')->where('replys_eid',$id)
            ->join('users','replys.replys_uid','=','users.id')
            ->get();
//        dd($replys);
        return view('home.showReply')->with('evaluate',$evaluate)->with('replys',$replys);
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
