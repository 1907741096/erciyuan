<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/7/19
 * Time: 13:45
 */

namespace app\admin\controller;


use think\Controller;

class Sound extends Base
{
    public function index(){
        $data=validate('Sound')->getData();
        if(array_key_exists('style_id',$data)) {$this->assign('style_id',$data['style_id']);}else{$this->assign('style_id','');}
        if(array_key_exists('place_id',$data)) {$this->assign('place_id',$data['place_id']);}else{$this->assign('place_id','');}
        if(array_key_exists('lang_id',$data)) {$this->assign('lang_id',$data['lang_id']);}else{$this->assign('lang_id','');}

        $status['status']=array('neq',-1);
        $styles=model('Style')->all($status);$this->assign('styles',$styles);
        $places=model('Place')->all($status);$this->assign('places',$places);
        $langs=model('Lang')->all($status);$this->assign('langs',$langs);

        $sounds=model('Sound')->getAllSound(config('setting.page_count'),$data);
        $this->assign('sounds',$sounds);
        $this->assign('nav','sound');
        return $this->fetch();
    }
    public function add(){
        $status['status']=array('eq',1);
        $styles=model('Style')->all($status);$this->assign('styles',$styles);
        $places=model('Place')->all($status);$this->assign('places',$places);
        $langs=model('Lang')->all($status);$this->assign('langs',$langs);

        $sound='';$style_id='';$place_id='';$lang_id='';
        if(!is_array(validate('Sound')->goCheck('id'))){
            $sound=model('Sound')->find(input('id'));
            $style_id=$sound['style_id'];$place_id=$sound['place_id'];$lang_id=$sound['lang_id'];
        }
        $this->assign('style_id',$style_id);
        $this->assign('place_id',$place_id);
        $this->assign('lang_id',$lang_id);
        $this->assign('sound',$sound);
        $this->assign('nav','addsound');
        return $this->fetch();
    }
    public function save(){
        if(input('id')){
            $data=validate('Sound')->goCheck('edit');
            if(!is_array($data)){
                $sound=model('Sound')->isUpdate(true)->save(request()->param());
                if($sound){
                    return json(['status'=>1,'message'=>'修改成功']);
                }else{
                    return json(['status'=>0,'message'=>'修改失败']);
                }
            }else{
                return json($data);
            }
        }else{
            $data=validate('Sound')->goCheck('add');
            if(!is_array($data)){
                $sound=model('Sound')->create(request()->param());
                if($sound){
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
        $data=validate('Sound')->goCheck('status');
        if(!is_array($data)){
            $style=model('Sound')->isUpdate(true)->save(request()->param());
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