<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Cart;
use DB;
use Session;

class CartController extends Controller
{
    protected $uid;
    public function __construct()
    {
//        isset(Session::get('user')) ? Session::get('user') : '' ;
      /*  (null !== Session::get('user')) ? Session::get('user') : '';
        $this->uid = Session::get('user')->id ? Session::get('user')->id : 'main';*/
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //取出购物车里面的数据 Cart::content()
        $carts = (Cart::instance($this->uid)->content());
        /* echo "<pre>";
        print_r($carts);*/
        // dd($carts);
        //购物车商品总数
        $count = Cart::instance($this->uid)->count();
        $_SESSION['count'] = $count;
        /*foreach($carts as $item)
        {
            echo $item->rowId;
            echo "</br>";
            echo $item->qty;

            Cart::update($item->rowId,100);
        }
        echo "<pre>";
        print_r(Cart::content());
        dd();*/
        //Cart::update($rowId, 2);

        //商品总价格 含税款
       // $money = Cart::total();

        //商品总价格 不含税款
        $pay = Cart::instance($this->uid)->subtotal();
        foreach($carts as $k=>$val){
           $goods_url = DB::table('goods_imgs')->where('goods_id',$val->id)->orderBy('id','desc')->first()->goods_url;
            $val->goods_url = $goods_url;
        }
        return view('home.cart_index')->with('carts',$carts)
            ->with('count',$count)->with('pay',$pay);
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
     * 添加购物车
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //根据id取出商品  前台提交过来的数据不安全  金额必须从数据库取
        //购物车添加  add()  http://186.com/cart/1/3
        // Basic form 基础表单   id, name 商品名称, quantity 商品数量 , price 价格 opt
       // Cart::add('293ad', 'Product 1', 1, 9.99, array('size' => 'large'));
        $good = DB::table('goods')->where('goods_id','=',$id)->first();

        Cart::instance($this->uid)->add($good->goods_id,$good->goods_name,1,$good->shop_price,['mk_price'=>$good->market_price]);


        //批量添加购物车
     /*   $data =[
            ['id' => '1', 'name' => 'Product 1', 'qty' => 1,  'price' => 10.00],
            ['id' => '2', 'name' => 'Product 2', 'qty' => 2,  'price' => 10.00],
            ['id' => '3', 'name' => 'Product 3', 'qty' => 10, 'price' => 10.00],
            ];
        //插入购物车
        Cart::add($data);*/

        return redirect('/home/cart');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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


    public  function dellCart()
    {
        //清空
        $res = Cart::instance($this->uid)->destroy();
//        print_r($res);
        return redirect('/home/cart');
    }

    /**
     * 移出购物车
     */
    public  function removeItem($rowId)
    {
        Cart::instance($this->uid)->remove($rowId);

        return redirect('/home/cart');
    }

    /**
     * 添加购物车
     */
    public  function addCart($goods_id,$num=1)
    {
        $good = DB::table('goods')->where('goods_id','=',$goods_id)->first();
        if(!($num <= $good->goods_number)){
            return back()->withErrors('库存不足');
        }
//        $newNum = $good->goods_number - $num;
//        DB::table('goods')->where('goods_id',$goods_id)->update(['goods_number'=>$newNum]);
        Cart::instance($this->uid)->add($good->goods_id,$good->goods_name,$num,$good->goods_sprice,['mk_price'=>$good->goods_price]);

        //t跳转到购物车列表页
        return redirect('/home/cart');

    }
}