<?php
/**
 * Created by PhpStorm.
 * user: 王振远
 * Date: 2017/7/14
 * Time: 16:02
 */

namespace app\common\model;

class Content extends Base
{
    protected $name='content';
    protected $hidden=['id','status'];
    public function position(){
        return $this->belongsTo('position','position_id','id');
    }
    public function news(){
        return $this->belongsTo('news','news_id','id');
    }
    public function getAllPosition($count,$data){
        return $this->with('position,news')->where($data)->order('listorder desc')->paginate($count);
    }
}