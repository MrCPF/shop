<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Validator;

class EvaluateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 1;
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
     * 评论内容入库
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ' :attribute 是必填字段',
            'eval_content'    => ':attribute 内容不合法',
        ];

         $this->validate($request, [
            'eval_level' => 'required',
            'eval_content' => 'required|string',
        ],$messages);
//        dd($request);
        $time         = date('Y-m-d H:i:s');
        $user         = Auth::user();
        $eval_uid     = $user->id;
        $eval_gid     = $request->eval_gid;
        $eval_level   = $request->eval_level;
        $eval_content   = $request->eval_content;
        DB::table('evaluates')->insert([
            'eval_uid'     => $eval_uid,
            'eval_gid'     => $eval_gid,
            'eval_level'   => $eval_level,
            'eval_content' => $eval_content,
            'eval_time'    => $time,
            'created_at'   => $time,
            'updated_at'   => $time
        ]);
        DB::table('orders')->where('orders_id',$request->orders_id)->update(['orders_status'=>'4']);
        return redirect("home/evaluate/$request->orders_id");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
//         dd($user);
        $orders_uid = $user->id;
        //获取待评价订单
        $order_done= DB::table('orders')
            ->where(['orders_uid'=>$orders_uid,'orders_status'=>2])
            ->join('goods','orders.orders_gid','=','goods.goods_id')
            ->select('orders.*','goods.*')
            ->orderBy('orders_time','desc')
            ->paginate(10);
        foreach($order_done as $k=>$val){
            $data = DB::table('goods_imgs')->where('goods_id',$val->goods_id)->first();
            $val->goods_url = $data->goods_url;
        }
        return view('home.evaluate')->with('order_done',$order_done);
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

    public function evalList()
    {
        $user = Auth::user();
        $uid = $user->id;
        //获取待评价订单
       /* $order_eval= DB::table('orders')
            ->where(['orders_uid'=>$orders_uid,'orders_status'=>4])
            ->join('goods','orders.orders_gid','=','goods.goods_id')
            ->join('evaluates','goods.goods_id','=','evaluates.eval_gid')
            ->select('orders.*','goods.*','evaluates.*')
            ->orderBy('orders_time','desc')
            ->paginate(10);*/
        $evals = DB::table('evaluates')->where('eval_uid',$uid)->paginate(3);
        foreach($evals as $k=>$eval){
            $eval->goods_url = DB::table('goods_imgs')->where('goods_id',$eval->eval_gid)->orderBy('id','desc')->first()->goods_url;
            $eval->goods_name = DB::table('goods')->where('goods_id',$eval->eval_gid)->first()->goods_name;
        }
//        dd($order_eval);
        return view('/home/eval_list')->with('evals',$evals);
//            ->with('order_eval',$order_eval);
    }
}
