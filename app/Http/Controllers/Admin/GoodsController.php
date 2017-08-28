<?php


namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Goods;
use GrahamCampbell\Markdown;
use App\Model\Cat;
use App\Model\GroupDel;
class GoodsController extends Controller {
    protected $goods;
    public function __construct()
    {
        $this->cat = new Goods();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){


        /*//获取goods.blade.php数据
        $goods = DB::table('goods')->paginate(2);
        
        foreach ($goods as $val) {
            $img = DB::table('goods_imgs')->select('goods_url')->where('goods_id', $val->goods_id)->first();
            $url = !empty($img) ? $img->goods_url : '';
            $val->goods_url = $url;
        }
        //跳转goods.blade.php页面
        return view('admin/goods.goods')->with('goods', $goods);*/


        $count = DB::table('goods')->count('goods_id');

        //判断是否有搜索条件
        $search = empty(trim($request->search)) ? '' : trim($request->search);

        //拼接sql语句
        $goods = DB::table('goods')->where('goods_name', 'like', '%'.$search.'%')->paginate(5);

        //遍历拿到图片数据
        foreach($goods as $val){
            $img = DB::table('goods_imgs')->select('goods_url')->where('goods_id',$val->goods_id)->first();

            $url =  !empty($img) ? $img->goods_url : '';
            $val->goods_url = $url;
        }
        return view('admin/goods.goods')->with('search',$search)->with('goods', $goods)->with('count',$count);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //跳到添加页面和添加栏目
        $this->cat = new Cat();
        $data = Cat::all();
        //获取getTree
        $data = $this->cat->getTree($data, 0, 0);
        return view('admin/goods.goods_add')->with('data', $data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //添加多图上传
        $image = $request->file('img');
        $urls = [];
        foreach ($image as $img) {
            if ($img->isValid()) {
                $ext = $img->getClientOriginalExtension(); //获取上传文件名的后缀名
                $path = 'upload/images/';
                $name = "origin_" . time() . rand(10, 100) . '.' . $ext;
                if ($img->move($path, $name)) {
                    $url = '/upload/images/' . $name;
                    $urls[] = ['goods_url' => $url];
                }
            }
        }
        //返回ajax
        $data = ['status' => 200, 'msg' => '成功', 'data' => $urls];
        echo json_encode($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //跳到goods_edit.blade.php编辑页面和编辑栏目
        //nmew一个Cat
        $this->cat = new Cat();
        //获取商品id
        $goods = DB::table('goods')->where('goods_id', $id)->first();
        //在cat里找出getTree
        $good = $this->cat->getTree($goods, 0, 0);
        //跳到goods_edit页面
        return view('admin/goods.goods_edit')->with('goods', $goods)->with('good', $good);
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
     {
        //goods_edit.blade.php页面编辑///编辑进库
        DB::table('goods')->where('goods_id', $id)->update([
            'goods_name' => $request->goods_name,
            'goods_price' => $request->goods_price,
            'goods_sprice' => $request->goods_sprice,
            'goods_detail' => $request->goods_detail,
            'goods_number' => $request->goods_number
        ]);
        //编辑完成返回goods.blade.php
        return redirect('/admin/goods');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //goods_blade.php页面删除
        $res = DB::table('goods')->where('goods_id', $id)->delete();
        if ($res) {
            return view('/admin/goods.goods');
        } else {
            return back();
        }
    }
    public function del($id)
    {
        //goods_blade.php页面删除
        $res = DB::table('goods')->where('goods_id', $id)->delete();
        if ($res) {
            return 1;
        } else {
            return 0;
        }
    }

    //验证goods_add.blade.php添加入库
    public function insert(Request $request)
    {
        $messages = [
            'goods_name.required' => '产品名称是必填项',
            'goods_price.required' => '商品原价是必填项',
            'goods_sprice.required' => '商品促销价是必填项',
            'goods_detail.required' => '商品详情是必填项',
            'goods_number.required' => '商品数量是必填项',
            'goods_number.integer' => '商品数量必须为整数',
            'cats_id.required' => '栏目必须选',
        ];

        $this->validate($request, [
            'goods_name' => 'required|max:30',
            'goods_price' => 'max:100',
            'goods_sprice' => 'required',
            'goods_detail' => 'required',
        ], $messages);
        //goods_add.blade.php添加入库
            $id = DB::table('goods')->insertGetId([
                'goods_name'    => $request->goods_name,
                'cats_id'       => $request->cats_id,
                "goods_price"   => $request->goods_price,
                "goods_sprice"  => $request->goods_sprice,
                "created_at"    => $request->created_at,
                "updated_at"    => $request->updated_at,
                "goods_detail"  => $request->goods_detail,
                "goods_number"  => $request->goods_number
            ]);
            $goods = Goods::find($id);
            $goods_id = $goods->goods_id;
            // dd($goods->goods_id);
            $count = count($request->image);
            $image = $request->image;
            for ($i = 0; $i < $count; $i++) {
                DB::table('goods_imgs')->insert([
                    'goods_id' => $goods_id,
                    'goods_url' => $image[$i]
                ]);
            }
            return redirect('/admin/goods');
    }


    //从goods.blade.php跳到goods_image.blade.php页面管理图片
    public function image(Request $request, $id) {
        //添加图片
        $imgInfo = DB::table('goods')->where('goods_id', $id)->first();
        $imgs = DB::table('goods_imgs')->where('goods_id', $id)->get();
        return view('admin/goods.goods_image')->with('imgs', $imgs)->with('imgInfo', $imgInfo)->with('goods_id',$id);
    }
   
    //goods_image.blade.php页面跳到goods_img.blade.php添加图片
    public function img($id)
    {   
        //跳到goods.goods_img页面
        $goods = DB::table('goods_imgs');
        return view('admin/goods.goods_img')->with('goods',$goods)->with('goods_id',$id);
    }

    /**
     * 多图上传处理
     */
    public function imgs()
    {
         //添加多图上传
        $imgs = $request->file('img');
        $urls = [];
        foreach ($imgs as $img) {
            if ($img->isValid()) {
                $ext = $img->getClientOriginalExtension(); //获取上传文件名的后缀名
                $path = 'upload/images/';
                $name = "origin_" . time() . rand(10, 100) . '.' . $ext;
                if ($img->move($path, $name)) {
                    $url = '/upload/images/' . $name;
                    $urls[] = ['goods_url' => $url];
                }
            }
        }
        //返回ajax
        $data = ['status' => 200, 'msg' => '成功', 'data' => $urls];
        echo json_encode($data);
    }


    //goods_img.blade.php页面添加图片返回到goods_image.blade.php
    public function goodsImg(Request $request)
    {

        $images = $request->image;
        $count = count($images);
        for($i=0;$i<$count;$i++){
            DB::table('goods_imgs')->insert([

                'goods_id'  => $request->goods_id,
                'created_at'=> $request->created_at,
                'updated_at'=> $request->updated_at,
                'goods_url' => $images[$i]
            ]);      
        }
        $goods_id = $request->goods_id;
        return redirect("admin/image/$goods_id");
    }

    /**
     * 批量删除
     */
    public function groupdel(Request $request)
    {
        $str = $request->idstr;
        $data = new GroupDel();
        $data = $data->groupDel('goods_imgs',$str);
        return $data;
    }
}

