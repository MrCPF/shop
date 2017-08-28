<?php

namespace App\Http\Controllers\Adminbusine;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Img;
use GrahamCampbell\Markdown\Facades\Markdown;
use DB;
use App\Model\Goods;
// use Markdown;
use App\Model\Cat;
use App\Model\GroupDel;
use Session;
class GoodsController extends Controller
{

    protected $goods;

    public function __construct()
    {
        $this->cat = new Goods();
    }   

    //商品的显示页面
    public function index(Request $request)
    {    
        //获取登录该商家的bid
        // dd($request->session()->get('busines_aname'));
        $bid = $request->session()->get('busines_aname')->busines_bid;
        $search = isset($request->search) ? ($request->search) : "" ;
             $goods = DB::table('goods')
                    ->where('goods_name', 'like', '%'.$search.'%')
                    ->where('goods_bid',$bid)
                    ->orderBy('goods_id','desc')
                    ->paginate(3);  
             $goods2 = DB::table('goods')
                    ->where('goods_name', 'like', '%'.$search.'%')
                    ->where('goods_bid',$bid)
                    ->orderBy('goods_id','desc')
                    ->get(); 
            $count = count($goods2);               
        foreach($goods as $val){
        $img = DB::table('goods_imgs')->select('goods_url')->where('goods_id',$val->goods_id)->first();

        $url =  !empty($img) ? $img->goods_url : '';
        $val->goods_url = $url;
            }                        
         return view('adminbusine/goods.goods_list')->with('goods',$goods)->with('count',$count)->with('search',$search);
    }
    //跳转到商品添加界面
     public function create()
    {
        $this->cat = new Cat();
        $data = Cat::all();
        $data = $this->cat->getTree($data,0,0);
        // dd($data);
        return view('adminbusine/goods.goods_add')->with('data',$data);
    }
    //多图上传
    public function store(Request $request)
    {   

        $imgs = $request->file('img');
        $urls=[];
        // dd($imgs);
        foreach($imgs as $img){
            if($img->isValid()){
                $ext = $img->getClientOriginalExtension(); //获取上传文件名的后缀名
                $path = 'upload/images/';
                // dd($path);
                $name = "origin_".time().rand(10,100).'.'.$ext;
                if($img->move($path,$name)){
                    $url = '/upload/images/'.$name;
                    $urls[]=['goods_url'=>$url];
                }
            }
        }
        $data =[
            'status'=>200,
            'msg'=>'成功',
            'data'=>$urls
        ];
        echo json_encode($data);
      
    }
    //跳转到商品编辑界面
    public function edit($id)
    {

        $goods = Goods::find($id);
        return view('adminbusine/goods.goods_edit')->with('goods',$goods);
    }
    //商品信息更改操作
     public function update(Request $request, $id)
    {
        $goods = DB::table('goods')->where('goods_id',$id)->update([
            'goods_name'=>$request->goods_name,
            'goods_price'=>$request->goods_price,
            'goods_sprice'=>$request->goods_sprice,
            'goods_detail'=>$request->goods_detail,
            'goods_number'=>$request->goods_number,
            "updated_at"         => date("Y-m-d H:i:s")
            ]);
        // dd($goods);
        return redirect('adminbusine/goods');
    }

    public function insert(Request $request)
    {
        $messages = [
            'goods_name.required' => '产品名称是必填项',
            'cats_id.required' => '商品栏目是必填项',
            'goods_detail.required' => '商品详情是必填项',
            'goods_number.required' => '商品库存是必填项且为整数',
            'goods_number.integer' => '商品库存必须为整数',
            'goods_price.required' => '商品价格填项',
        ];


        $this->validate($request, [
            'goods_name' => 'required|min:1',
            'cats_id' => 'max:100',
            'goods_detail' => 'required',
            'goods_number' => 'required|integer',
            'goods_price' => 'required|integer',
        ], $messages);
        //得到$goods_bid
        $goods_bid = Session::get('busines_aname')->busines_bid;

        //通过id
        $id = DB::table('goods')->insertGetId([
            'goods_bid'      => $goods_bid,
            'goods_name'     => $request->goods_name,
            'cats_id'        => $request->cats_id,
            "goods_price"    => $request->goods_price,
            "goods_sprice"   => $request->goods_sprice,
            // "created_at"     => date("Y-m-d H:i:s"),
            "created_at"     => $request->created_at,
            "updated_at"     => $request->updated_at,
            "goods_detail"   => $request->goods_detail,
            "goods_number"   => $request->goods_number,
            "goods_bid"   => $goods_bid
        ]);
        $goods = Goods::find($id);

        $goods_id = $goods->goods_id;

        $count = count($request->image);
        // dd($count);
        $image = $request->image;
        // dd($image);
        for($i=0;$i<$count;$i++){
             DB::table('goods_imgs')->insert(['goods_id'=>$goods_id,'goods_url'=>$image[$i]]);
        }
        return redirect('/adminbusine/goods');        
    }
    //跳转图片编辑页面
    public function picedit($id)
    {    
        $data = DB::table('goods_imgs')->where('goods_id',$id)->get();
          
        return view('adminbusine/goods.pic_list')->with('data',$data)->with('goods_id',$id);
    } 
    //跳转图片添加页面
    public function picadd($id)
    {
        //获取商品goods_id 把商品goods_id传到pic_add界面
         $data = DB::table("goods")->where("goods_id",$id)->get();
         
        return view('adminbusine/goods.pic_add')->with('data',$data)->with('goods_id',$id);
    }
    //图片遍历返回
    public function picInsert(Request $request,$id)
    {
        $count = count($request->image);
        $image = $request->image;
         // dd($image);
        for($i=0;$i<$count;$i++){
             DB::table('goods_imgs')->insert([
                'goods_id'=>$id,
                "updated_at"=> $request->updated_at,
                "created_at"=> $request->created_at,
                'goods_url'=>$image[$i]
            ]);
        }
        return redirect('/adminbusine/goods');  
    }
    //批量删除图片
    public function deletes(Request $request)
    {

        // dd($request);
        $str = $request->idstr;
        $data = new GroupDel();
        $data = $data->groupDel('goods_imgs',$str);
        return $data; 
    }
    //商品下架
    public function under($id)
    {   
       $sta = DB::table('goods')->where('goods_id',$id)->first()->goods_status;
       // $sta = $request->goods_status;
       // dd($sta);
       // $status = !$sta; 
       if($sta==0){
            $data=DB::table('goods')->where('goods_id',$id)->update(['goods_status'=>1]); 
            
       }else{
            $data=DB::table('goods')->where('goods_id',$id)->update(['goods_status'=>0]); 
           
       }
       return 1; 
    }
}
