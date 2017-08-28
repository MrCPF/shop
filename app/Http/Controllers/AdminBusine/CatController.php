<?php

namespace App\Http\Controllers\AdminBusine;

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

    public function index()
    {
        
        $data = $this->cat->getTree();
        // dd($data);
        return view('adminbusine/cat.cat_list')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->getTree();
        return view('adminbusine/cat.cat_add')->with('data',$data);
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
            'required' => ':attribute 是必填的',
            'max'      => ':description 标题不能超过255位',
        ];
        $this->validate($request,[
            'cat_name' => 'required',
            'description' => 'required|max:255',
        ],$message);
        $cat              = new Cat();
        $cat->cat_name    = $request->cat_name;
        $cat->pid         = $request->pid;
        $cat->description = $request->description;
        $res = $cat->save();
        return redirect('adminbusine/cat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Cat::find($id);
        return view('adminbusine/cat.cat_show')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->getTree();
        $cat_info = Cat::find($id);
        return view('adminbusine/cat.cat_edit',['data'=>$data])->with('cat_info',$cat_info);
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
        $cat = Cat::find($id);
        $cat->cat_name = $request->cat_name;
        $cat->description = $request->description;
        $cat->pid = $request->pid;
        $res = $cat->save();
        return redirect('adminbusine/cat');
        /*if($res){
        }else{
            return back();
        }*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Cat::destroy){
            return 1;
        }else{
            return 0;
        }
    }

    /**
     * 自定义删除
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        $info = Cat::where('pid',$id)->get();
        foreach($info as $val){
            Cat::destroy($val->id);
        }
        if(Cat::destroy($id)){
            return 1;
        }else{
            return 0;
        }
    }

    /**
     * 递归获取栏目
     * @param $arr
     * @param int $id
     * @param int $lev
     * @return array
     */
    // protected function findSon($arr,$id=0,$lev=0)
    // {
    //     static $cat = [];
    //     foreach($arr as $val){
    //         if($val['pid'] == $id){
    //             $val['lev'] = $lev;
    //             $cat[] = $val;
    //             $cat = $this->findSon($arr,$val['id'],$lev+1);
    //         }
    //     }
    //     return $cat;
    // }

    /**
     * 获取数据库数据信息树
     * @return array
     */
    // protected function getTree()
    // {
    //     $cat = Cat::all();
    //     return $this->findSon($cat,0,0);
    // }
}
