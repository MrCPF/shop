<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class EvalController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = empty(trim($request->search)) ? '' : trim($request->search);
     
        $eval = DB::table('evaluates')
                ->where('eval_content','like','%'.$search.'%')
                ->paginate(2);
            /*->join('users','users.id','=','evaluates.eval_uid')
            
            ->join('goods','goods.goods_id','=','evaluates.eval_gid')
            ->join('busines','busines.busines_id','=','goods.goods_bid')
            ->select('evaluates.*','users.name','goods.goods_name','busines.busines_name')
            ->get();*/
            // dd($eval);
            foreach ($eval as $k => $val){
                //��ȡusers�����uid
                $val->name = DB::table('users')
                ->where('id',$val->eval_uid)
                ->first()
                ->name;

               $val->goods_bid = DB::table('goods')
               ->where('goods_id',$val->eval_gid)
               ->first()
               ->goods_bid;

               $val->goods_name = DB::table('goods')
               ->where('goods_id',$val->eval_gid)
               ->first()
               ->goods_name;
               
                $val->busines_name = DB::table('busines')
                ->where('busines_id',$val->goods_bid)
                ->first()
                ->busines_name;
            }
        // dd($eval);
        // $count = count($eval);
        // for($i=0;$i<$count;$i++){
        //     // $eval_gid = DB::table('goods')->where('goods_id',$eval[$i]->eval_gid)->first()->eval;
        //     //  $eval[$i]->eval_gid = $eval_gid;
        // }
       
       
        return view('/admin/eval.eval')->with('eval',$eval);
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
        //ÆÀÂÛÁÐ±íÉ¾³ý
        $res = DB::table('evaluates')->where('eval_id', $id)->delete();
        if ($res) {
            return 1;
        } else {
            return 0;
        }
    }
}
