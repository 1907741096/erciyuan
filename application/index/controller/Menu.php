<?php
/**
 * Created by PhpStorm.
 * user: 王振远
 * Date: 2017/7/25
 * Time: 16:45
 */

namespace app\index\controller;


class Menu extends Common
{
    public function index(){
        $msg=validate('menu')->gocheck('id');
        if(is_array($msg)){
            return $this->puterror($msg['message']);
        }else{
            $id=input('id');
            $data['status']=self::$status;
            $data['menu_id']=$id;
            $news=model('news')->getAllNews(2,$data);
            $this->assign('news',$news);
            $this->assign('menu_id',$id);
            return $this->fetch();
        }
    }
}