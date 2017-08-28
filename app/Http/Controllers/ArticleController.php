<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Model\Art;

use DB;

use GrahamCampbell\Markdown\Facades\Markdown;

use Captcha;

use Auth;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     * 显示文章列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Art::orderBy('id','desc')->paginate(5);
        //$data = DB::table('article')->orderBy('id','desc')->paginate(3);
        return view('art.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     * 显示添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('art.add');
        
    }

    /**
     * Store a newly created resource in storage.
     * 进行数据存储
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 判断是否为ajax请求
        if($request->ajax()){
            $id = DB::table('article')->insertGetId([
                'title' => $_POST['title'], 'content' => $_POST['content']
            ]);
            $data = Art::find($id);
            return response()->json(['id'=>$data->id,'title' => $data->title, 'content' => $data->content]);
        }else{
            $res = Art::create($request->except("_token"));
            if($res){
                return redirect('/art');
            }else{
                return back();
            }
        }
        //DB方法
        /* $id = DB::table('article')->insertGetId(
            ['title'=>$request->title,'content'=>$request->content]    
        ); */
       
        //orm :第一种方法  save
        /* $art = new Art;
        $art->title = $request->title;
        $art->content = $request->content;
        $res = $art->save(); */
        
        //orm :第二种方法： 
        //$res = Art::create(['title'=>$request->title,'content'=>$request->content]);
        //当字段较多时可以按以下方式
         //$res = Art::create($request->except('_token'));
            /* $data = Art::find($id);
            return response()->json(['title' => $data->title, 'content' => $data->content]);
         */
        
    }

    /**
     * Display the specified resource.
     * 文章详情页显示
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //DB方式的show
        //$data = DB::table('article')->where('id',$id)->first();
        //orm方法 
        $data = Art::find($id);
        //$data->content = Markdown::convertToHtml(strip_tags($data->content));
        return view('art.show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     * 修改页面显示
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$data = DB::table('article')->where('id',$id)->first();
        $data = Art::find($id);
        return view('art.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     * 修改操作
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$res = DB::table('article')->where('id',$id)->update(['title'=>$request->title,'content'=>$request->content]);
        //orm方法1：save
        /* $art = Art::find($id);
        $art->title = $request->title;
        $art->content = $request->content;
        $art->save(); */
        
        //orm方法2：update()
        //Art::where('id',$id)->update($request->except('_token','_method'));
        Art::where('id',$id)->update(['title'=>$request->title,'content'=>$request->content]);
        return redirect('/art');
    }

    /**
     * Remove the specified resource from storage.
     * 删除操作
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //$res = DB::table('article')->where('id',$id)->delete();
       //orm方法1：
       /* $art = Art::find($id);
      $res = $art->delete(); */
        
        //方法2：
        //$res = Art::destroy($id);
        
        //方法3：
        $res = Art::where('id',$id)->delete();
        if($res){
            return redirect('/art');
        }else{
            return back();
        }
    }
    
    /**
     * markdown测试
     * 
     */
    
    public function getMk()
    {
        $str = "##  aa";
        return Markdown::convertToHtml($str);
    }


    //验证码测试
    public function getCode()
    {
        return Captcha::src();
    }
    public function getCod()
    {
        dd(Captcha::check('3jx2'));
    }

    /**
     * 获取当前认证用户信息
     */
    public function getUser()
    {
        if(Auth::check()){
            dd(Auth::user());
        }
    }

    /**
     * 手动认证
     */
    public function getLogout()
    {
        Auth::logout();

    }

    public function postLogin(Request $request)
    {
        $res = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if($res){
            return redirect('/art');
        }else{
           echo back();
        }

    }
}