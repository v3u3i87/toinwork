<?php
/**
 * User: Richard.Z
 * Email: v3u3i87@gmail.com 
 * Date: 2015/9/6
 * Time: 13:16
 */

namespace works\action;

use Upadd\Frame\Action;

class BaseAction extends Action{

    /**
     * 返回信息
     * @param int $code
     * @param string $msg
     * @param array $data
     */
    public function msg($code=204,$msg='默认错误',$data=array())
    {
        header('Content-type: application/json');
        exit(json(array('code'=>$code,'msg'=>$msg,'data'=>$data)));
    }



}