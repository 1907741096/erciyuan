<?php
/**
 * Created by PhpStorm.
 * user: 王振远
 * Date: 2017/7/25
 * Time: 17:04
 */

namespace app\index\controller;


class News extends Common
{
    public function index(){
        $msg=validate('news')->gocheck('id');
        if(is_array($msg)){
            return $this->puterror($msg['message']);
        }
        $id=input('id');
        $data['status']=self::$status;
        $data['id']=$id;
        $new=model('news')->find($data);
        $this->assign('new',$new);
        $this->assign('menu_id',$new['menu_id']);
        return $this->fetch();
    }
}