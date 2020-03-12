<?php
/**
 * Created by PhpStorm.
 * user: 王振远
 * Date: 2017/7/17
 * Time: 10:06
 */

namespace app\admin\controller;


use think\Controller;

class Position extends Base
{
    public function index(){
        $data['status']=array('neq',-1);
        $positions=model('position')->getDatas(config('setting.page_count'),$data);
        $this->assign('positions',$positions);
        $this->assign('nav','position');
        return $this->fetch();
    }
    public function add(){
        $position='';
        if(!is_array(validate('position')->goCheck('id'))){
            $position=model('position')->find(input('id'));
        }
        $this->assign('position',$position);
        $this->assign('nav','addposition');
        return $this->fetch();
    }
    public function save(){
        if(input('id')){
            $data=validate('position')->goCheck('edit');
            if(!is_array($data)){
                $position=model('position')->isUpdate(true)->save(request()->param());
                if($position){
                    return json(['status'=>1,'message'=>'修改成功']);
                }else{
                    return json(['status'=>0,'message'=>'修改失败']);
                }
            }else{
                return json($data);
            }
        }else{
            $data=validate('position')->goCheck('add');
            if(!is_array($data)){
                $position=model('position')->create(request()->param());
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
        $data=validate('position')->goCheck('status');
        if(!is_array($data)){
            $position=model('position')->isUpdate(true)->save(request()->param());
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