<?php
/**
 * Created by PhpStorm.
 * user: 王振远
 * Date: 2017/7/15
 * Time: 16:53
 */

namespace app\common\validate;


class Lang extends Base
{
    protected $rule=[
        'id'=>'require|isPositiveInteger',
        ['name','require|max:30','语言名称不能为空|语言名称过长'],
        ['status','require|number|between:-1,1','状态不合法']
    ];
    protected $scene=[
        'id'=>['id'],
        'add'=>['name'],
        'edit'=>['id','name'],
        'status'=>['id','status']
    ];
}