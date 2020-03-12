<?php

/**
 * Created by PhpStorm.
 * user: 王振远
 * Date: 2017/7/14
 * Time: 15:51
 */
namespace app\admin\controller;
use think\Controller;

class Place extends Base
{
    public function index(){
        $data['status']=array('neq',-1);
        $places=model('place')->getDatas(config('setting.page_count'),$data);
        $this->assign('places',$places);
        $this->assign('nav','place');
        return $this->fetch();
    }
    public function add(){
        $place='';
        if(!is_array(validate('place')->goCheck('id'))){
            $place=model('place')->find(input('id'));
        }
        $this->assign('place',$place);
        $this->assign('nav','addplace');
        return $this->fetch();
    }
    public function save(){
        if(input('id')){
            $data=validate('place')->goCheck('edit');
            if(!is_array($data)){
                $place=model('place')->isUpdate(true)->save(request()->param());
                if($place){
                    return json(['status'=>1,'message'=>'修改成功']);
                }else{
                    return json(['status'=>0,'message'=>'修改失败']);
                }
            }else{
                return json($data);
            }
        }else{
            $data=validate('place')->goCheck('add');
            if(!is_array($data)){
                $place=model('place')->create(request()->param());
                if($place){
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
        $data=validate('place')->goCheck('status');
        if(!is_array($data)){
            $place=model('place')->isUpdate(true)->save(request()->param());
            if($place){
                return json(['status'=>1,'message'=>'操作成功']);
            }else{
                return json(['status'=>0,'message'=>'操作失败']);
            }
        }else{
            return json($data);
        }
    }
}