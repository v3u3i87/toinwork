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
use works\model\WorksInfo;
use works\logic\MsgLogic;

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
        $list['project'] = array('project_id'=>$project['id'],'name'=>$project['name']);
        $list['design'] = array('design_id'=>$design['id'],'name'=>$design['name']);
        if($list)
        {
            $this->msg(200,'ok',$list);
        }
        $this->msg(201,'抱歉,没有数据');
    }


    //工作详情
    public function show()
    {
        //返回用户信息
        $accInfo = $this->is_token();
        //返回项目信息
        $project = $this->is_user_get_project($accInfo['uid']);
        //返回设计信息
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

        $works_id = Data::get('works_id',0,function($val) use($design)
        {
            if(empty($val))
            {
                $this->msg(205,'抱歉,works_id参数不能为空');
            }

           return $val;
        });

        $worksInfo = WorksLogic::show($works_id,$design['id']);

        if($worksInfo)
        {
            $list['project'] = [
                'project_id'=>$project['id'],
                'name'=>$project['name'],
                'icon'=>$project['icon']
            ];
            $list['design'] = [
                'design_id'=>$design['id'],
                'name'=>$design['name'],
                'icon'=>$design['icon']
            ];

            $list['info'] = $worksInfo;
            $list['msg'] = [];
            $msg = MsgLogic::byWorksId($works_id);
            if($msg)
            {
                $list['msg'] = $msg;
            }
            $this->msg(200,'ok',$list);
        }

        $this->msg(201,'没有任何数据');

    }





}