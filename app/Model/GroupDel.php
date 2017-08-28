<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class GroupDel extends Model
{
	/**
	 * 表明模型是否应该被打上时间戳
	 *
	 */
	public $timestamps = false;
	/**
	 * 批量删除
	 * @param 字符串 $str
	 * @param 数据表名 $table
	 */
	public function groupDel($table,$str)
	{    
		$data = explode(',', $str);
		$len = count($data);
		for($i=0;$i<$len;$i++){
			DB::table("$table")->where('id',$data["$i"])->delete();
		}
		return 1;
	}
}
