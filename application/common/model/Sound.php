<?php
/**
 * Created by PhpStorm.
 * user: 王振远
 * Date: 2017/7/14
 * Time: 16:02
 */

namespace app\common\model;

class Sound extends Base
{
    protected $name='sound';
    protected $hidden=['id','status'];
    public function style(){
        return $this->belongsTo('style','style_id','id');
    }
    public function place(){
        return $this->belongsTo('place','place_id','id');
    }
    public function lang(){
        return $this->belongsTo('lang','lang_id','id');
    }
    public function getAllSound($count,$data){
        return $this->with('style,place,lang')->where($data)->paginate($count);
    }
}