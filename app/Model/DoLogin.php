<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DoLogin extends Model
{
    /**
     * 关联到模型的数据表
     * 
     * @var string
     */
    protected $table = 'ausers';
    protected $primaryKey = 'ausers_id';
    
    /**
     * 指定可以被批量赋值的字段
     *
     * @var array
     */
    protected $fillable = ['ausers_name','ausers_email','ausers_password'];    
    
    /**
     * 表名模型是否应该被打上时间戳
     *
     * @var bool
     */
    public  $timestamps = false;
}
