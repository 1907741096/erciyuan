<?php

/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/7/14
 * Time: 15:51
 */
namespace app\admin\controller;
use think\Controller;

class Lang extends Base
{
    public function index(){
        $data['status']=array('neq',-1);
        $langs=model('Lang')->getDatas(config('setting.page_count'),$data);
        $this->assign('langs',$langs);
        $this->assign('nav','lang');
        return $this->fetch();
    }
    public function add(){
        $lang='';
        if(!is_array(validate('Lang')->goCheck('id'))){
            $lang=model('Lang')->find(input('id'));
        }
        $this->assign('lang',$lang);
        $this->assign('nav','addlang');
        return $this->fetch();
    }
    public function save(){
        if(input('id')){
            $data=validate('Lang')->goCheck('edit');
            if(!is_array($data)){
                $lang=model('Lang')->isUpdate(true)->save(request()->param());
                if($lang){
                    return json(['status'=>1,'message'=>'修改成功']);
                }else{
                    return json(['status'=>0,'message'=>'修改失败']);
                }
            }else{
                return json($data);
            }
        }else{
            $data=validate('Lang')->goCheck('add');
            if(!is_array($data)){
                $lang=model('Lang')->create(request()->param());
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
        $data=validate('Lang')->goCheck('status');
        if(!is_array($data)){
            $lang=model('Lang')->isUpdate(true)->save(request()->param());
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