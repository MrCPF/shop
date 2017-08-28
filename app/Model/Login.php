<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Login extends Model
{
    //执行登录  数据库查询:控制器怎么写 MODEl怎么写  
    public function getInfo($ausers_name)
    {
    	
        $data = DB::table("ausers")->where("ausers_name",$ausers_name)->first();
         //dd($data);
        return $data;

    }
}

