<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Cat;

class CatController extends Controller
{
    protected $cat;

    public function __construct()
    {
        $this->cat = new Cat();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->cat->getTree();
        return view('admin/cat.cat_list')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data =  $this->cat->getTree();
        return view('admin/cat.cat_add')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'cats_name.required' => '栏目是必填项',
            'cats_desc.required' => '栏目描述是必填的',
            'max'      => 'description 标题不能超过255位',
        ];
        $this->validate($request,[
            'cats_name' => 'required',
            'cats_desc' => 'required|max:255',
        ],$message);
        $cat              = new Cat();
        $cat->cats_name   = $request->cats_name;
        $cat->cats_pid    = $request->cats_pid;
        $cat->cats_desc   = $request->cats_desc;
        $res = $cat->save();
        return redirect('admin/cat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cats_id)
    {
        $data = $this->cat->where('cats_id',$cats_id)->first();
        return view('admin/cat.cat_show')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cats_id)
    {
        $data = $this->cat->getTree();
        $cat_info =  Cat::where('cats_id',$cats_id)->first();
        return view('admin/cat.cat_edit',['data'=>$data])->with('cat_info',$cat_info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cats_id)
    {
        $cat = $this->cat->where('cats_id',$cats_id)->first();
        $cat->cats_name = $request->cats_name;
        $cat->cats_desc = $request->cats_desc;
        $cat->cats_pid = $request->cats_pid;
        $cat->updated_at = date('Y-m-d H:i:s');
        $res = $cat->save();
        if($res){
            return redirect('admin/cat');
        }else{
            return back()->withErrors('更新失败!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    /**
     * 自定义删除
     * @param $id
     * @return int
     */
    public function del($cats_id)
    {
//        $info = Cat::where('cats_pid',$cats_id)->get();
        /*foreach($info as $val){
            Cat::delete($val->cats_id);
        }*/
        $info = Cat::all();
        $cat  = $this->cat->findSon($info,$cats_id);
        foreach($cat as $val){
            Cat::where('cats_id',$val->cats_id)->delete();
        }
        if(Cat::destroy($cats_id)){
            return 1;
        }else{
            return 0;
        }
    }


}
