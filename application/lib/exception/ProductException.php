<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/7/9
 * Time: 16:17
 */

namespace app\lib\exception;


class ProductException extends BaseException {
    public $code=404;
    public $msg='指定商品不存在，请检查参数';
    public $errorCode=20000;
}