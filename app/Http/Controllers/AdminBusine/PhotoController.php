<?php

namespace App\Http\Controllers\Adminbusine;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data = DB::table('goods_imgs')->get();
         $count = DB::table('goods_imgs')->count('goods_id');
         // dd($count);
        return view('adminbusine/photo.photo_list')->with('data',$data)->with('count',$count);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('adminbusine/photo.photo_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $imgs = $request->file('img');
        $urls=[];
           // dd($img);
        foreach ($imgs as $img) {
           if($img->isValid()){
           $ext = $img->getClientOriginalExtension(); //获取上传文件名的后缀名
           $path = public_path('upload/images/');
           $name = time().rand(10,1000).'.'.$ext;
           $created_at  = date("Y-m-d H:i:s");
           $updated_at  = date("Y-m-d H:i:s");
           if($img->move($path,$name)){
               $url = '/upload/images/'.$name;
               $urls[]=['goods_url'=>$url,'created_at'=>$created_at,'updated_at'=>$updated_at];
               
           }
        }
        }
            $data = DB::table('goods_imgs')->insert($urls);
            
            return redirect('/adminbusine/photo');
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
        $data = DB::table('goods_imgs')->where('id',$id)->first();
         //dd($data);
        return view('adminbusine/photo.photo_edit')->with('data',$data);
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
        $data = DB::table('goods_imgs')->where('id',$id);
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
    public function delete($id)
    {
        $res = DB::table('goods_imgs')->where('goods_id',$id)->delete();
        if($res){
            return 1;
        }else{
            return 0;
        }
    }
}
