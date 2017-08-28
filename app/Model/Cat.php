<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'cats';
    protected $primaryKey = 'cats_id';

    /**
     * 指定可以被批量赋值的字段
     *
     * @var array
     */
    protected $fillable = ['cats_pid','cats_name','cats_desc','updated_at'];

    /**
     * 表名模型是否应该被打上时间戳
     *
     * @var bool
     */
    public  $timestamps = true;


    /**
     * 递归获取栏目
     * @param $arr
     * @param int $id
     * @param int $lev
     * @return array
     */
    public function findSon($arr,$id=0,$lev=0)
    {
        static $cat = [];
        foreach($arr as $val){
            if($val->cats_pid == $id){
                $val->lev = $lev;
                $cat[] = $val;
                $this->findSon($arr,$val->cats_id,$lev+1);
            }
        }
        return $cat;
    }

    /**
     * 获取数据库数据信息树
     * @return array
     */
    public function getTree()
    {
        $cat = self::select()->get();
        return $this->findSon($cat,0,0);
    }

    /**
     * @param $arr
     * @param int $id
     * @return array
     */
    public function findTop($arr,$id=0)
    {
        $sons = [];
        foreach($arr as $val){
            if($val->cats_pid == $id){
                $sons[] = $val;
            }
        }
        return $sons;
    }

}
