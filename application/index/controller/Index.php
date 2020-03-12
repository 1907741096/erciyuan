<?php
namespace app\index\controller;

class Index extends Common
{
    public function index()
    {
        $data['status']=self::$status;
        $data['position_id']=1;
        $banners=model('content')->all($data);
        $this->assign('banners',$banners);

        $n['status']=self::$status;
        $news=model('news')->getAllNews(2,$n);
        $this->assign('news',$news);
        return $this->fetch();
    }
}
