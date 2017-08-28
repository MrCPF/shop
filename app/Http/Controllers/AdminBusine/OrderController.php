<?php

namespace App\Http\Controllers\AdminBusine;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request);

       $busines_bid = Session::get('busines_aname')->busines_bid;
       $search = isset($request->search) ? ($request->search) : "" ;
       // dd($search);
       // dd($busines_bid);
        //多变联查订单信息和用户名
        $orders = DB::table('orders')
                        ->orderBy('orders_id','desc')
                        ->where('orders_sign', 'like', '%'.$search.'%')
                        ->where('goods_bid',$busines_bid)
                        ->join('users','orders.orders_uid','=','users.id')
                        ->select('users.name','orders.*')
                        ->paginate(5);                      
        

        // dd($orders);
        // 获取订单总数
        $count = count($orders);
       // $data = DB::table('orders')->paginate(3);
        // $count= DB::table('orders')->count('orders_id');
        // dd($count);
        // 一个定单有多个商品名,遍历商品名
        for ($i=0;$i<$count;$i++) {
             
                $name= DB::table('users')->where('id',$orders[$i]->orders_uid)
                ->first()->name;            
            $goods_name = DB::table('goods')->where('goods_id',$orders[$i]->orders_gid)->first()->goods_name;
             $orders[$i]->name = $name;
            //把每个商品名赋给每个商品
            $orders[$i]->goods_name = $goods_name;
        }
        //显示订单列表
        return view("adminbusine/order.order_list")->with('orders',$orders)->with('count',$count)->with('search',$search);
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
                
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
                               
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
    public function orderUpdate($id)
    {   
        //修改商家订单状态
        $orders = DB::table('orders')                
                    ->where('orders_id',$id)
                    ->update(['orders_status'=>1]);
    
          
        //显示订单列表     
        return redirect("adminbusine/order");
                
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
