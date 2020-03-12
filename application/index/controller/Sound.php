<?php
/**
 * Created by PhpStorm.
 * user: 王振远
 * Date: 2017/7/25
 * Time: 9:56
 */

namespace app\index\controller;


class Sound
{
    public function getSound(){
        $place_id=input('place_id');
        $data['status']=1;
        $data['place_id']=$place_id;
        $data['style_id']=config('setting.default_style');
        $data['lang_id']=config('setting.default_lang');
        if(session('style_id')&&session('style_id')!=null){
            $data['style_id']=session('style_id');
        }
        if(session('user')&&session('user')!=null){
            $user=model('user')->find(session('user')['id']);
            $data['style_id']=$user['style_id'];
        }
        $sounds=model('sound')->all($data);
        if($sounds->isEmpty()){
            return '';
        }
        $count=count($sounds);
        $num=rand(0,$count-1);
        return $sounds[$num]['address'];
    }
    public function updateStyle(){
        $msg=validate('style')->gocheck('id');
        if(is_array($msg)){
            return json($msg);
        }else{
            $id=input('id');
            if(session('user')&&session('user')!=null){
                $data['style_id']=$id;
                $data['id']=session('user')['id'];
                $res=model('user')->isUpdate(true)->save($data);
                $style=model('style')->find($id);
                if($res){
                    return json(['status'=>1,'address'=>$style['address'],'thumb'=>$style['thumb']]);
                }
            }else{
                session('style_id',$id);
                $style=model('style')->find($id);
                return json(['status'=>1,'address'=>$style['address'],'thumb'=>$style['thumb']]);
            }
            return json(['status'=>0,'message'=>'已切换至该主题']);
        }
    }
}