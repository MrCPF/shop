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
    protected $table = 'evaluates';
     protected $primaryKey = 'eval_id';
    /**
     * 指定可以被批量赋值的字段
     *
     * @var array
     */
  protected $fillable = ['eval_uid','eval_gid','eval_level','eval_time','eval_content'];    
    
    /**
     * 表名模型是否应该被打上时间戳
     *
     * @var bool
     */
    public  $timestamps = false;
}
