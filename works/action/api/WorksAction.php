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
use works\model\WorkDesign;
use works\model\Works;

class WorksAction extends BaseAction{

    /**
     * 编辑/新增-修改
     */
    public function edit()
    {
        $accInfo = $this->is_token();
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
                    }
                    else
                    {
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


    /**
     * 获取列表
     */
    public function getList(){
        $accInfo = $this->is_token();
        $project = $this->is_user_get_project($accInfo['uid']);
        $design = Data::get('design_id',0,function($val)
        {
            if(empty($val))
            {
                $this->msg(205,'抱歉,design_id设计ID不能为空.');
            }
            $val = WorkDesign::pkId($val);
            if($val)
            {
                return $val;
            }
            $this->msg(205,'抱歉,您的设计工作系不存在..');
        });

        $list = WorksLogic::get_design_id_list($design['id']);
        p($list);


    }

    public function show()
    {

    }





}