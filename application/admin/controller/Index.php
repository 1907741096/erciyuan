<?php
/**
 * Created by PhpStorm.
 * user: 王振远
 * Date: 2017/7/13
 * Time: 15:02
 */

namespace app\admin\controller;


use think\Controller;

class Index extends Base
{
    public function index(){
        $status['status']=array('neq',-1);
        $news_count=model('news')->where($status)->count();
        $user_count=model('user')->where($status)->count();
        $sound_count=model('sound')->where($status)->count();
        $style_count=model('style')->where($status)->count();
        $this->assign('news_count',$news_count);
        $this->assign('user_count',$user_count);
        $this->assign('sound_count',$sound_count);
        $this->assign('style_count',$style_count);
        $this->assign('nav','index');
        return $this->fetch();
    }

}