<?php
/**
 * Created by PhpStorm.
 * user: 王振远
 * Date: 2017/7/19
 * Time: 13:45
 */

namespace app\admin\controller;


use think\Controller;

class Style extends Base
{
    public function index(){
        $data['status']=array('neq',-1);
        $styles=model('style')->getDatas(config('setting.page_count'),$data);
        $this->assign('styles',$styles);
        $this->assign('nav','style');
        return $this->fetch();
    }
    public function add(){
        $style='';
        if(!is_array(validate('style')->goCheck('id'))){
            $style=model('style')->find(input('id'));
        }
        $this->assign('style',$style);
        $this->assign('nav','addstyle');
        return $this->fetch();
    }
    public function save(){
        if(input('id')){
            $data=validate('style')->goCheck('edit');
            if(!is_array($data)){
                $style=model('style')->isUpdate(true)->save(request()->param());
                if($style){
                    return json(['status'=>1,'message'=>'修改成功']);
                }else{
                    return json(['status'=>0,'message'=>'修改失败']);
                }
            }else{
                return json($data);
            }
        }else{
            $data=validate('style')->goCheck('add');
            if(!is_array($data)){
                $style=model('style')->create(request()->param());
                if($style){
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
        $data=validate('style')->goCheck('status');
        if(!is_array($data)){
            $style=model('style')->isUpdate(true)->save(request()->param());
            if($style){
                return json(['status'=>1,'message'=>'操作成功']);
            }else{
                return json(['status'=>0,'message'=>'操作失败']);
            }
        }else{
            return json($data);
        }
    }
}