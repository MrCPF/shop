<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Cat;
use App\Model\Busines;
use Session;
use Auth;
use DB;

class StoreController extends Controller
{
    protected $cat;
    public function __construct()
    {
        $this->cat = new Cat();
    }

    public function show($id)
    {
        $user = Auth::user();
        Session::put('user',$user);
//        dd(Session::get('user')->id);
        $data = Cat::all();
        //拿到所有的顶级栏目
        $tops = $this->cat->findTop($data,0);
        //拿到所有的子栏目
        $sons = $this->cat->getTree($data,0,0);

        foreach($sons as $k => $son){
            if($son->lev == 2){
                $son->goods_info = DB::table('goods')->where('cats_id',$son->cats_id)->take(6)->get();
                foreach($son->goods_info as $info){
                    $info->goods_url = DB::table('goods_imgs')->where('goods_id',$info->goods_id)->orderBy('goods_id','desc')->first()->goods_url;
                }
            }
        }

//        dd($son->cats_name);

        //展示店铺页面

        $good = DB::table('goods')->where('goods_bid', $id)->first();
//dd($good);
        //查询店铺里所有的商品
        $goods_num = DB::table('goods')->where('goods_bid', $id)->paginate(10);;
//        $goods_num2 = DB::table('goods')->where('goods_bid', $id)->take(9)->get();

        $busines = DB::table('busines')->where('busines_id', $id)->first();

        $busines2 = Busines::whereBetween('busines_id',[1,5])->get();

        //通过goods_bid拿到goods_id
    //        $goods_id = DB::table('goods')->where('goods_bid',$id)->first()->goods_id;

        foreach ($goods_num as $k => $val) {
            $goods_imgs = DB::table('goods_imgs')->select('goods_url')->where('goods_id', $goods_num[$k]->goods_id)->first();
            $url = !empty($goods_imgs) ? $goods_imgs->goods_url : '';
            $val->goods_url = $url;
        }
		

       /* $goods_id = DB::table('goods')->where('goods_bid',$id)->first()->goods_id;
        $goods_imgs = DB::table('goods_imgs')->select('goods_url')->where('goods_id',$goods_id)->first();*/

        return view('home.store_index')->with('good', $good)->with('goods_num', $goods_num)
        ->with('busines', $busines)->with('busines2', $busines2)->with('tops',$tops)->with('sons',$sons);
    }

    /**
     * 店铺搜索首页
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        $search = empty(trim($request->search)) ? '' : trim($request->search);
//        dd($search);
        $good = DB::table('goods')->where('goods_name','like','%'.$search.'%')->where('goods_bid',$request->id)->paginate(16);
        $count = count($good);
        for($i=0;$i<$count;$i++){
            $goods_imgs = DB::table('goods_imgs')->select('goods_url')->where('goods_id',$good[$i]->goods_id)->first();
            $good[$i]->goods_imgs = $goods_imgs;
        }
//        dd($good[0]->goods_imgs[0]->goods_url);
        return view('home.cat_show')->with('goods',$good)->with('search',$search);
    }
}
