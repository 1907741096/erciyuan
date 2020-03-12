<?php

/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/7/14
 * Time: 15:51
 */
namespace app\admin\controller;
use think\Controller;

class Menu extends Base
{
    public function index(){
        $data['status']=array('neq',-1);
        $menus=model('menu')->getDatas(config('setting.page_count'),$data);
        $this->assign('menus',$menus);
        $this->assign('nav','menu');
        return $this->fetch();
    }
    public function add(){
        $menu='';
        if(!is_array(validate('menu')->goCheck('id'))){
            $menu=model('menu')->find(input('id'));
        }
        $this->assign('menu',$menu);
        $this->assign('nav','addmenu');
        return $this->fetch();
    }
    public function save(){
        if(input('id')){
            $data=validate('menu')->goCheck('edit');
            if(!is_array($data)){
                $menu=model('menu')->isUpdate(true)->save(request()->param());
                if($menu){
                    return json(['status'=>1,'message'=>'修改成功']);
                }else{
                    return json(['status'=>0,'message'=>'修改失败']);
                }
            }else{
                return json($data);
            }
        }else{
            $data=validate('menu')->goCheck('add');
            if(!is_array($data)){
                $menu=model('menu')->create(request()->param());
                if($menu){
                    return json(['status'=>1,'message'=>'添加成功']);
                }else{
                    return json(['status'=>0,'message'=>'添加失败']);
                }
            }else{
                return json($data);
            }
            return json($data);
        }
    }
    public function status(){
        $data=validate('menu')->goCheck('status');
        if(!is_array($data)){
            $menu=model('menu')->isUpdate(true)->save(request()->param());
            if($menu){
                return json(['status'=>1,'message'=>'操作成功']);
            }else{
                return json(['status'=>0,'message'=>'操作失败']);
            }
        }else{
            return json($data);
        }
    }
}