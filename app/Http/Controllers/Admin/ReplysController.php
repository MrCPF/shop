<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class ReplysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $search = empty(trim($request->search)) ? '' : trim($request->search);
         $replys = DB::table('replys')
            ->where('replys_content','like','%'.$search.'%')
            ->paginate(2);

         foreach ($replys as $k => $val){
            //获取users里面的uid
            $val->name = DB::table('users')
            ->where('id',$val->replys_uid)
            ->first()
            ->name;

            $val->busines_name = DB::table('busines')
            ->where('busines_id',$val->replys_bid)
            ->first()
            ->busines_name;

            $val->eval_gid = DB::table('evaluates')
            ->where('eval_id',$val->replys_eid)
            ->first()
            ->eval_gid;

            $val->goods_name = DB::table('goods')
            ->where('goods_id',$val->eval_gid)
            ->first()
            ->goods_name;

        } 
        // dd($replys);
         return view('/admin/replys.replys')->with('replys',$replys);
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

    public function del($id)
    {
        //回复删除
        $res = DB::table('replys')->where('replys_id', $id)->delete();
        if ($res) {
            return 1;
        } else {
            return 0;
        }
    }
}
