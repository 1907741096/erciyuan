<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/7/17
 * Time: 10:06
 */

namespace app\admin\controller;


use think\Controller;

class Position extends Base
{
    public function index(){
        $data['status']=array('neq',-1);
        $positions=model('Position')->getDatas(config('setting.page_count'),$data);
        $this->assign('positions',$positions);
        $this->assign('nav','position');
        return $this->fetch();
    }
    public function add(){
        $position='';
        if(!is_array(validate('Position')->goCheck('id'))){
            $position=model('Position')->find(input('id'));
        }
        $this->assign('position',$position);
        $this->assign('nav','addposition');
        return $this->fetch();
    }
    public function save(){
        if(input('id')){
            $data=validate('Position')->goCheck('edit');
            if(!is_array($data)){
                $position=model('Position')->isUpdate(true)->save(request()->param());
                if($position){
                    return json(['status'=>1,'message'=>'修改成功']);
                }else{
                    return json(['status'=>0,'message'=>'修改失败']);
                }
            }else{
                return json($data);
            }
        }else{
            $data=validate('Position')->goCheck('add');
            if(!is_array($data)){
                $position=model('Position')->create(request()->param());
                if($position){
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
        $data=validate('Position')->goCheck('status');
        if(!is_array($data)){
            $position=model('Position')->isUpdate(true)->save(request()->param());
            if($position){
                return json(['status'=>1,'message'=>'操作成功']);
            }else{
                return json(['status'=>0,'message'=>'操作失败']);
            }
        }else{
            return json($data);
        }
    }
}