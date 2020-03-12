<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/7/13
 * Time: 15:02
 */

namespace app\admin\controller;


use think\Controller;

class Index extends Base
{
    public function index(){
        $status['status']=array('neq',-1);
        $news_count=model('News')->where($status)->count();
        $user_count=model('User')->where($status)->count();
        $sound_count=model('Sound')->where($status)->count();
        $style_count=model('Style')->where($status)->count();
        $this->assign('news_count',$news_count);
        $this->assign('user_count',$user_count);
        $this->assign('sound_count',$sound_count);
        $this->assign('style_count',$style_count);
        $this->assign('nav','index');
        return $this->fetch();
    }

}