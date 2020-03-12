<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/7/14
 * Time: 16:02
 */

namespace app\common\model;

class News extends Base
{
    protected $name='news';
    public function menu(){
        return $this->belongsTo('menu','menu_id','id');
    }
    public function getAllNews($count,$data){
        return $this->with('menu')->where($data)->paginate($count);
    }
//    public function getThumbAttr($value,$data){
//        return config('setting.img_prefix').$value;
//    }
}