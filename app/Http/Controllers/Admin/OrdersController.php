<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = empty(trim($request->search)) ? '' : trim($request->search);

        $orders = DB::table('orders')
                ->orderBy('orders_id','desc')
                ->join('users','orders.orders_uid','=','users.id')
                ->select('users.name','orders.*')
                ->where('orders_sign', 'like', '%'.$search.'%')
                ->paginate(10);
         // dd($orders);
        $count = count($orders);
       // $data = DB::table('orders')->paginate(3);
        // $count= DB::table('orders')->count('orders_id');
        // dd($count);
        for($i=0;$i<$count;$i++){
            $goods_name = DB::table('goods')->where('goods_id',$orders[$i]->orders_gid)->first()->goods_name;
            $orders[$i]->goods_name = $goods_name;
        }
        return view("admin/order.orders_index")->with('orders',$orders)->with('count',$count)->with('search',$search);
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
     * @param  [type] $id
     *
     * 改变状态
     * @return [type]
     */
    public function orderUpdate($id)
    {   
        //修改自营订单状态
        $orders = DB::table('orders')
                    ->join('users','orders.orders_uid','=','users.id')
                    ->select('users.name','orders.*')        
                    ->where('orders_id',$id)
                    ->update(['orders_status'=>0]);

        $orders = DB::table('orders')->get();
        // dd($orders);
        $count = count($orders);
       // $data = DB::table('orders')->paginate(3);
        // $count= DB::table('orders')->count('orders_id');
        // dd($count);
        for ($i=0;$i<$count;$i++) {
            $goods_name = DB::table('goods')->where('goods_id',$orders[$i]->orders_gid)->first()->goods_name;
            $orders[$i]->goods_name = $goods_name;
        }        
        return view("admin/order.orders_index")->with('orders',$orders)->with('count',$count);
                
    }    
}
