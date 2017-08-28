<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Cat;
use DB;

class CatController extends Controller
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
     *商品列表页
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $good = DB::table('goods')->where('cats_id','=',$id)->where('goods_status',0)->paginate(16);

        //商品数量
        $count = count($good);
        //拿到good_img信息
        for($i=0;$i<$count;$i++){
           $goods_imgs = DB::table('goods_imgs')->select('goods_url')->where('goods_id',$good[$i]->goods_id)->first();
            $good[$i]->goods_imgs = $goods_imgs;
        }
//        dd($good[0]->goods_imgs[0]->goods_url);


        return view('home.cat_show')->with('goods',$good);
        //去数据库取出栏目下的商品
        // $goods = \DB::table('goods')->select('goods_id','goods_name','shop_price')->get();
        // return view('home.cat_show')->with('goods',$goods);
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
     * 前台搜索功能
     */
    public  function search(Request $request)
    {
        $search = empty(trim($request->search)) ? '' : trim($request->search);
//        dd($search);
        $good = DB::table('goods')->where('goods_name','like','%'.$search.'%')->paginate(16);
        $count = count($good);
        for($i=0;$i<$count;$i++){
            $goods_imgs = DB::table('goods_imgs')->select('goods_url')->where('goods_id',$good[$i]->goods_id)->first();
            $good[$i]->goods_imgs = $goods_imgs;
        }
//        dd($good[0]->goods_imgs[0]->goods_url);
        return view('home.cat_show')->with('goods',$good)->with('search',$search);
    }

}
