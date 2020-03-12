<?php
/**
 * Created by PhpStorm.
 * user: 王振远
 * Date: 2017/7/19
 * Time: 8:42
 */

namespace app\admin\controller;
use think\Controller;

class Content extends Base
{
    public function index(){
        $data['status']=array('neq',-1);
        $position_id='';
        if(input('position_id')){
            $data['position_id']=input('position_id');
            $position_id=$data['position_id'];
        }
        $this->assign('position_id',$position_id);
        $contents=model('content')->getAllPosition(config('setting.page_count'),$data);

        $status['status']=array('eq',1);
        $positions=model('position')->all($status);
        $this->assign('positions',$positions);

        $this->assign('contents',$contents);
        $this->assign('nav','content');
        return $this->fetch();
    }
    public function status(){
        $data=validate('content')->goCheck('status');
        if(!is_array($data)){
            $news=model('content')->isUpdate(true)->save(request()->param());
            if($news){
                return json(['status'=>1,'message'=>'操作成功']);
            }else{
                return json(['status'=>0,'message'=>'操作失败']);
            }
        }else{
            return json($data);
        }
    }
    public function add(){
        $msg=validate('content')->goCheck('add');
        if(!is_array($msg)){
            $jumpUrl = $_SERVER['HTTP_REFERER'];
            $push=input();
            $position_id = intval($push['position_id']);
            $newsid = $push['push'];
            try {
                foreach ($newsid as $i=>$n) {
                    $data = array(
                        'position_id' => $position_id,
                        'news_id' => $newsid[$i]
                    );
                    $content = model('content')->create($data);
                }
            }catch(Exception $e) {
                return json(['status'=>0, 'message'=>$e->getMessage()]);
            }

            return json(['status'=>1, 'message'=>'推送成功','data'=>['jump_url'=>$jumpUrl]]);
        }else{
            return json($msg);
        }
    }
    public function listorder(){
        $msg=validate('content')->goCheck('listorder');
        if(!is_array($msg)){
            $jumpUrl = $_SERVER['HTTP_REFERER'];
            $listorders = input()['listorder'];
            try {
                foreach ($listorders as $i=>$n) {
                    $data = array(
                        'id' => $i,
                        'listorder' => $n
                    );
                    $content = model('content')->isUpdate(true)->save($data);
                }
            }catch(Exception $e) {
                return json(['status'=>0, 'message'=>$e->getMessage()]);
            }

            return json(['status'=>1, 'message'=>'排序成功','data'=>['jump_url'=>$jumpUrl]]);
        }else{
            return json($msg);
        }
    }
}