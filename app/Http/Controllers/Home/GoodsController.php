<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Redis;

class GoodsController extends Controller
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
     * 商品详情页展示
     * Display the specified resource.
     *  goods_bid = busines_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

 /*       根据id去数据库取出商品记录   $id 数据处理      可能需要查附件表
         $goods_info = DB::table('goods_info')->where('goods_id','=',$id)->get();
        $good = \DB::table('goods')->where('goods_id','=',$id)->first();
        return view('home.goods_show')->with('good',$good);*/

        $good = \DB::table('goods')->where('goods_id','=',$id)->first();
        //获取店铺推荐商品的id
        $goods_id = $good->goods_relation;
        $goods_relation = \DB::table('goods')->where('goods_id','=',$goods_id)->first();
        $goods_relation->goods_url = \DB::table('goods_imgs')->where('goods_id','=',$goods_id)->first()->goods_url;

        $goods_bid = \DB::table('goods')->where('goods_id','=',$id)->first()->goods_bid;
        $busines = DB::table('busines')->where('busines_id',$goods_bid)->first();


        $goods_imgs = \DB::table('goods_imgs')->select('goods_url')->where('goods_id',$id)->get();
//        dd($goods_imgs);
        //Redis缓存
        $key = $id;
        if(Redis::exists($key)){
            //如果Redis中存在直接读取
            $data = Redis::smembers($key);
            //            dd($data);
            //            $goods_img = (object)null;
            foreach ($goods_imgs as $k => $goods_img) {
                $goods_img->goods_url = $data[$k];
            }
            $goods_imgs = $goods_imgs;
//            echo 111111111,'这是Redis中的！！';
        }else {
            //如果Redis中不存在先存入Redis再读取
            $posts = $goods_imgs;
            foreach ($posts as $post) {
                //将图片URL存放到集合中
                //            echo $post->goods_url,'<br>';

                Redis::sadd($key, $post->goods_url);
            }
            /*if(Redis::exists($key)){
                //根据键名获取键值
                dd(Redis::smembers($key));
            }*/
            //获取集合元素总数(如果指定键不存在返回0)
            $nums = Redis::scard($key);
            if ($nums > 0) {
                //从指定集合中随机获取三个标题
                $data = Redis::smembers($key);
                //            dd($data);
                //            $goods_img = (object)null;
                foreach ($goods_imgs as $k => $goods_img) {
                    $goods_img->goods_url = $data[$k];
                }
//                echo 2222222,'这是先读的数据库而后存入Redis中的！！';
            }
        }


        $evaluates  = \DB::table('evaluates')
            ->join('users','evaluates.eval_uid','=','users.id')
            ->where('eval_gid',$id)->orderBy('eval_id','desc')->paginate(20);
        foreach($evaluates as $k=>$eval){
            $data = DB::table('replys')->where('replys_eid',$eval->eval_id)->get();
            $user_info = DB::table('users_info')
                ->where('uid',$evaluates[$k]->id)
                ->where('pic','<>','')
                ->orderBy('id','desc')
                ->first();
            $eval->reply_count = count($data);
            $eval->pic = $user_info->pic;
        }
        //总的评价数
        $evaluates2  = \DB::table('evaluates')
            ->where('eval_gid',$id)
            ->get();
        $count_total = count($evaluates2);
        //总的好评数
        $count_up   = 0;
        $count_mid  = 0;
        $count_down = 0;
        for($i=0;$i<$count_total;$i++){
            if($evaluates2[$i]->eval_level == 1){
                $count_up = $count_up + 1;
            }else if($evaluates2[$i]->eval_level == 2){
                $count_mid  = $count_mid + 1;
            }else{
                $count_down = $count_down + 1;
            }
        }

        return view('home.goods_show')->with('good',$good)
            ->with('goods_imgs',$goods_imgs)->with('evaluates',$evaluates)
            ->with('count_up',$count_up)->with('count_mid',$count_mid)->with('count_down',$count_down)
            ->with('count_total',$count_total)
            ->with('goods_relation',$goods_relation)
            ->with('busines',$busines);
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
