<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Busentry extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'busines';
    protected $primaryKey = 'busines_id';

    /**
     * 指定可以被批量赋值的字段
     *
     * @var array
     */
    protected $fillable = ['busines_pic','busines_name','busines_desc','updated_at','created_at','busines_address'];

    /**
     * 表名模型是否应该被打上时间戳
     *
     * @var bool
     */
    public  $timestamps = false;
}
