<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/7/15
 * Time: 16:53
 */

namespace app\common\validate;


class News extends Base
{
    protected $rule=[
        'id'=>'require|isPositiveInteger',
        ['menu_id','require|isPositiveInteger','请选择文章分类|文章分类错误'],
        ['title','require|max:45','文章标题不能为空|文章标题过长'],
        ['thumb','require','请上传封面图'],
        ['content','require','请填写文章内容'],
        ['status','require|number|between:-1,1','状态错误|状态错误|状态错误']
    ];
    protected $scene=[
        'id'=>['id'],
        'add'=>['menu_id','title','thumb','content'],
        'edit'=>['id','menu_id','title','thumb','content'],
        'status'=>['id','status']
    ];
}