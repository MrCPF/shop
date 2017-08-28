<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Art extends Model
{
    /**
     * 关联到模型的数据表
     * 
     * @var string
     */
    protected $table = 'article';
    
    /**
     * 指定可以被批量赋值的字段
     *
     * @var array
     */
    protected $fillable = ['title','content'];    
    
    /**
     * 表名模型是否应该被打上时间戳
     *
     * @var bool
     */
    public  $timestamps = false;
}
