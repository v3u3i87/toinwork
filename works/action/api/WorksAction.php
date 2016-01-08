<?php
/**
 * About:Richard.z
 * Email:v3u3i87@gmail.com
 * Blog:https://www.zmq.cc
 * Date: 16/1/7
 * Time: 17:37
 * Name:
 */

namespace works\action\api;

use Config;
use Data;
use works\action\BaseAction;

use works\logic\WorksLogic;

class WorksAction extends BaseAction{

    //新增
    public function edit()
    {
        if($accInfo = $this->is_token())
        {
            //数据解析
            $data = Data::get('data',null,function($val)
            {
                if(empty($val))
                {
                    $this->msg(205,'抱歉,data参数不能为空');
                }
                //base64解密
                if($val = base64_decode($val))
                {
                    //json解码
                    if($val = json_decode($val,true))
                    {
                        if(WorksLogic::VerifyField($val))
                        {
                            return $val;
                        }else{
                            $this->msg(205,'data数组参数缺少.');
                        }
                    }
                    $this->msg(205,'抱歉,data参数json错误.');
                }
                $this->msg(205,'抱歉,data参数base64错误.');
            });

            if($req = WorksLogic::process_data($data,$accInfo['uid']))
            {
                $this->msg(200,'执行成功');
            }
            $this->msg(206,'数据处理失败');
        }
    }





}