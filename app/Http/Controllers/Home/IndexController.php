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

class IndexController extends Controller
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
        $busines = Busines::whereBetween('busines_id',[1,5])->get();
        $user = Auth::user();
        if($user){
            $user->pic = DB::table('users_info')->where('uid',$user->id)->where('pic','<>','')->first()->pic;
        }
        Session::put('user',$user);
//        dd(Session::get('user')->id);
        $data = Cat::all();
        $tops = $this->cat->findTop($data,0);
        $sons = $this->cat->getTree($data,0,0);
        foreach($sons as $k=>$son){
            if($son->lev == 2){
                $son->goods_info = DB::table('goods')->where('cats_id',$son->cats_id)->where('goods_status',0)->take(8)->get();
                foreach($son->goods_info as $info){
                    $info->goods_url = DB::table('goods_imgs')->where('goods_id',$info->goods_id)->first()->goods_url;
                }
            }
        }
        return view('home.index')->with('tops',$tops)->with('sons',$sons)->with('busines',$busines);
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
