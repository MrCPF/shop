<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    /**
     * 关联到模型的数据表
     * 
     * @var string
     */
    protected $table = 'goods';
    protected $primaryKey = 'goods_id';

    
    /**
     * 指定可以被批量赋值的字段
     *
     * @var array
     */
    protected $fillable = ['goods_name','goods_price','goods_sprice','created_at','updated_at','goods_detail','goods_number'];
    
    /**
     * 表名模型是否应该被打上时间戳
     *
     * @var bool
     */
    public  $timestamps = false;
}
