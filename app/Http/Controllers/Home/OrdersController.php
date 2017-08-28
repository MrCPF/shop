<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Cart;
use DB;
use Captcha;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // echo 1111;
        $cart = Cart::content();
        // echo '<pre>';
       // dd($cart);
        $pay = Cart::subtotal();
        // $pay = intval($pay)+10;
        // $pay = $pay+10;
        // dd($cart);
        $user = Auth::user();
        // dd($user);
        $uid = $user->id;
        $user_info = DB::table('users_info')->where('uid',$uid)->where('pic','')->get();
        $user_info2 = DB::table('users_info')->where('uid',$uid)->where('pic','')->where('sign',0)->first();
        // dd($res);
        return view('home.pay')->with('cart',$cart)->with('pay',$pay)->with('user_info',$user_info)->with('user_info2',$user_info2);
    }

    /**
     * 生成订单
     */
     public function createOrder()
    {

        //获取购物车信息
        $cart = (Cart::content());
//         dd($cart);
        //获取下单时间
        $time = time();
        //获取用户信息
        $user = Auth::user();
        // dd($user);
        // 获取订单总价
        $pay = Cart::subtotal();
        $uid = $user->id;
        // dd($uid);
        //生成订单号
        $order_num = substr($time,-4).rand(10000,99999);
        // dd($order_num);
        foreach($cart as $v){
            //商品id
            $gid  = $v->id;
            //商品单价
            $price  = $v->price;            
            // dd($gid);
            //商品数量
            $g_num = $v->qty;
            // dd($g_num);
            //商品总价格
            $total = ($v->qty)*($v->price);
            // echo $total;
            // die;
            //商家id
            $shop = DB::table('goods')->where('goods_id',$gid)->first();
             // dd($shop);
            $bid = $shop->goods_bid;
            // dd($bid);
           
            $data = [] ;
            $data['orders_sign'] = $order_num;

            $data['orders_uid'] = $uid;
             
            //$data['busines_name'] = $busines_name;
            $data['goods_bid'] = $bid;

            $data['orders_time'] = date("Y-m-d H:i:s");
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_at'] = date("Y-m-d H:i:s");
            $data['orders_gid'] = $gid;
            $data['orders_gnum'] = $g_num;
            $data['orders_total'] = $total;
            $data['orders_gprice'] = $price;
            $data['orders_status'] = 5;
            // dd($data); 
            //存入订单主表
        // dd($res);
           $orders_id = DB::table('orders')->insertGetId($data);
        }

        // dd($orders);
        Cart::destroy();
        return redirect("/home/paySuc/$orders_id")->with('cart',$cart);
    }

    /**
     * 进入支付页面
     */
    public function paySuc(Request $request,$id)
    {
        $orders = DB::table('orders')->where('orders_id',$id)->first();
        $ordersInfo = DB::table('orders')->where('orders_sign',$orders->orders_sign)->get();
        $pay = 0;
        foreach($ordersInfo as $info){
           $pay += $info->orders_total;
        }
        $userInfo = DB::table('users_info')->where('uid',$orders->orders_uid)
            ->where('sign','=',0)
            ->where('pic','=','')
            ->first();
        return view('home.paysuccess')->with('orders',$orders)->with('userInfo',$userInfo)->with('pay',$pay);
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
    public function showOrder()
    {
        $user = Auth::user();
        // dd($user);
        $orders_uid = $user->id;
        //获取全部订单信息
        $orderInfo = DB::table('orders')
                        ->where('orders_uid',$orders_uid)
                        ->join('goods','orders.orders_gid','=','goods.goods_id')
//                        ->leftJoin('goods_imgs','goods.goods_id','=','goods_imgs.goods_id')
                        ->select('orders.*','goods.*')
                        ->orderBy('orders_time','desc')
                        ->paginate(6);
//        array_unique($orderInfo);
//        dd($orderInfo);
        foreach($orderInfo as $k=>$val){
            $data = DB::table('goods_imgs')->where('goods_id',$val->goods_id)->first();
            $val->goods_url = $data->goods_url;
        }
//        dd($orderInfo);
       /* foreach($orderInfo as $k=>$val){
            echo $k,'=>',$val->orders_sign,'<br>';

            $data[] = DB::table('orders')->where('orders_sign',$val->orders_sign)->get();
            $goodsInfo = $val->goodsInfo = [];
            /*foreach($data as $k=>$v){
                $info = DB::table('goods')->where('goods_id',$v->orders_gid)->first();
                $data = DB::table('goods_imgs')->where('goods_id',$info->goods_id)->first();
                $info->goods_url = $data->goods_url;
                array_push($goodsInfo,$info);
            }
        }*/
        // //获取未发货订单
        $order_paid= DB::table('orders')
                        ->where(['orders_uid'=>$orders_uid,'orders_status'=>0,])
                        ->join('goods','orders.orders_gid','=','goods.goods_id')
//                        ->leftJoin('goods_imgs','goods.goods_id','=','goods_imgs.goods_id')
                        ->select('orders.*','goods.*')
                        ->orderBy('orders_time','desc')
                        ->paginate(10);
        foreach($order_paid as $k=>$val){
            $data = DB::table('goods_imgs')->where('goods_id',$val->goods_id)->first();
            $val->goods_url = $data->goods_url;
        }
        //获取未确认收货订单
        $order_send= DB::table('orders')
                        ->where(['orders_uid'=>$orders_uid,'orders_status'=>1,])
                        ->join('goods','orders.orders_gid','=','goods.goods_id')
//                        ->leftJoin('goods_imgs','goods.goods_id','=','goods_imgs.goods_id')
                        ->select('orders.*','goods.*')
                        ->orderBy('orders_time','desc')
                        ->paginate(10);
        foreach($order_send as $k=>$val){
            $data = DB::table('goods_imgs')->where('goods_id',$val->goods_id)->first();
            $val->goods_url = $data->goods_url;
        }
        //获取待评价订单
        $order_done= DB::table('orders')
                        ->where(['orders_uid'=>$orders_uid,'orders_status'=>2])
                        ->join('goods','orders.orders_gid','=','goods.goods_id')
//                        ->leftJoin('goods_imgs','goods.goods_id','=','goods_imgs.goods_id')
                        ->select('orders.*','goods.*')
                        ->orderBy('orders_time','desc')
                        ->paginate(10);
        foreach($order_done as $k=>$val){
            $data = DB::table('goods_imgs')->where('goods_id',$val->goods_id)->first();
            $val->goods_url = $data->goods_url;
        }

//获取未支付订单
        $order_npay= DB::table('orders')
                        ->where(['orders_uid'=>$orders_uid,'orders_status'=>5])
                        ->join('goods','orders.orders_gid','=','goods.goods_id')
//                        ->leftJoin('goods_imgs','goods.goods_id','=','goods_imgs.goods_id')
                        ->select('orders.*','goods.*')
                        ->orderBy('orders_time','desc')
                        ->paginate(10);
        foreach($order_npay as $k=>$val){
            $data = DB::table('goods_imgs')->where('goods_id',$val->goods_id)->first();
            $val->goods_url = $data->goods_url;
        }        
        //判断收货状态
        $orders_status = [];
        // dd($status);
        foreach($orderInfo as $v){
            
            switch($v->orders_status){
                case 0:
                    $a ='买家已付款';
                break;
                case 1:
                    $a = '卖家已发货';
                break;
                case 2:
                     $a = '待评价';
                break;
                case 3:
                     $a = '交易成功';
                break;
                case 4:
                    $a = '评价完成';
                break;
                case 5:
                    $a = '待支付';
                break;                
            }
         $orders_status[$v->orders_id]=$a;
        }
        
//        dd($orderInfo);
        return view('home.orders_index')->with('orderInfo',$orderInfo)
                                        ->with('order_paid',$order_paid)
                                        ->with('order_send',$order_send)
                                        ->with('order_done',$order_done)
                                        ->with('order_npay',$order_npay)
                                        ->with('orders_status',$orders_status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDetails()
    {
        return view("home.orders_details");
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
      $orders = DB::table('orders')->where('orders_id',$id)->update(['orders_status'=>2]);
       return redirect('orderInfo');
               
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
     * 删除订单;
     * @return [type]
     */
    public function orderDel($id)
    {
       $data=DB::table('orders')->where('orders_id',$id)->delete();
       // dd($data);
       return redirect('orderInfo');
    }

    public function getUrl($orders_uid,$goods_id)
    {


    }

    public function showRefund()
    {   
        //用户ID
        $uid = Auth::user()->id;
        //退货信息
        $refundInfo = DB::table('orders')
                            ->where('uid',$uid)
                            ->whereIn('refund',[1,2,3])
                            ->join('refund','orders.id','=','refund.orders_id')
                            ->join('goods','orders.goods_id','=','goods.goods_id')
                            ->select('goods.goods_name','orders.orders_gnum','order.refund','refund.id','refund.refund_time','refund.refund_money')
                            ->orderBy('refund_time','desc')
                            ->paginate(10);

        //转换退货状态
        $status = [] ;
        foreach($refundInfo as $v){
             switch($v->refund){
                case 1:
                $a = '退款中';
                break;
                case 2:
                $a = '退款完成';
                break;
                case 3:
                $a = '退款失败';
                break;
            }
        $orders_status[$v->id] = $a;
        }
       dd($refundInfo);
        //dd($status);
        return view('home.refund_index')->with('refundInfo',$refundInfo)
                                       ->with('orders_status',$orders_status);
    }


    /**
     * 退款退货
     * @return [type]
     */
    public function orderRefund()
    {
        return view('home.refund_index');
    }     

    /**
     * 支付确认处理
     * @return [type]
     */
    public function doPay(Request $request)
    {
        if(!$this->checkVerify($request->verify)){
            return 0;
        }
        $data = DB::table('orders')->where('orders_id',$request->orders_id)->first();
        $info = DB::table('orders')->where('orders_sign',$data->orders_sign)->get();
        foreach($info as $val){
            $order = DB::table('orders')->where('orders_sign',$val->orders_sign)->update(['orders_status'=>0]);
            $good = DB::table('goods')->where('goods_id',$val->orders_gid)->first();
            $newNum = $good->goods_number - $val->orders_gnum;
            DB::table('goods')->where('goods_id',$val->orders_gid)->update(['goods_number'=>$newNum]);
        }
        return 1;
    }     

     /**
     * 验证验证码
     */
    protected function checkVerify($code)
    {
        return Captcha::check($code);
    }
}
