<?php

/**
 * Created by PhpStorm.
 * user: 王振远
 * Date: 2017/7/14
 * Time: 15:51
 */
namespace app\admin\controller;
use think\Controller;

class Lang extends Base
{
    public function index(){
        $data['status']=array('neq',-1);
        $langs=model('lang')->getDatas(config('setting.page_count'),$data);
        $this->assign('langs',$langs);
        $this->assign('nav','lang');
        return $this->fetch();
    }
    public function add(){
        $lang='';
        if(!is_array(validate('lang')->goCheck('id'))){
            $lang=model('lang')->find(input('id'));
        }
        $this->assign('lang',$lang);
        $this->assign('nav','addlang');
        return $this->fetch();
    }
    public function save(){
        if(input('id')){
            $data=validate('lang')->goCheck('edit');
            if(!is_array($data)){
                $lang=model('lang')->isUpdate(true)->save(request()->param());
                if($lang){
                    return json(['status'=>1,'message'=>'修改成功']);
                }else{
                    return json(['status'=>0,'message'=>'修改失败']);
                }
            }else{
                return json($data);
            }
        }else{
            $data=validate('lang')->goCheck('add');
            if(!is_array($data)){
                $lang=model('lang')->create(request()->param());
                if($lang){
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
        $data=validate('lang')->goCheck('status');
        if(!is_array($data)){
            $lang=model('lang')->isUpdate(true)->save(request()->param());
            if($lang){
                return json(['status'=>1,'message'=>'操作成功']);
            }else{
                return json(['status'=>0,'message'=>'操作失败']);
            }
        }else{
            return json($data);
        }
    }
}