<?php
namespace works\action\api;

use Data;
use works\action\BaseAction;
use works\model\Tag;
use works\model\Project;
use works\model\ProjectUser;

use works\logic\DesignLogic;
use works\logic\ProjectLogic;

class DesignAction extends BaseAction{


    /**
     * 设计工作-编辑
     */
    public function add()
    {
        if($accInfo = $this->is_token())
        {

            $uid = $accInfo['uid'];

            //工作名称
            $name = Data::get('name', null, function ($val)
            {
                if (empty($val))
                {
                    $this->msg(205, '抱歉,name值不能为空');
                }
                return $val;
            });

            //项目ID
            $project_id = (int) Data::get('project_id', 0, function ($val) use ($uid)
            {
                if (empty($val))
                {
                    $this->msg(205, '抱歉,project_id参数不能为空');
                }

                if (!Project::where(array('id' => $val))->find())
                {
                    $this->msg(205, '抱歉,您的上级项目不存在');
                }

                //判断是否为项目创建人
                if (!Project::where(array('id' => $val, 'uid' => $uid))->find())
                {
                    /**
                     * 判断项目成员是否存在
                     */
                    if (!ProjectUser::where(array('project_id' => $val, 'uid' => $uid))->find())
                    {
                        $this->msg(205, '严重警告,请勿非法提交数据');
                    }
                }
                return $val;
            });

            //模板数据
            $template = Data::get('template', null, function ($val)
            {
                if (empty($val))
                {
                    $this->msg(205, '抱歉,template不能为空');
                }

                $json = base64_decode($val);

                if ($json)
                {

                    if ($data = json_decode($json, true))
                    {
                        return $data;
                    }

                    $this->msg(205, '抱歉,template参数json格式错误');
                } else {
                    $this->msg(205, '抱歉,template的数据不是base64');
                }
            });

            $logic = DesignLogic::add($name, $template, $uid, $project_id);

            if (is_array($logic))
            {
                $this->msg(205, 'template的数据不合法');
            } elseif ($logic === true){
                $this->msg(200, '添加成功');
            } else {
                $this->msg(206, '服务器繁忙,请稍等.');
            }
        }
    }


    /**
     * 获取工作表格
     */
    public function table()
    {

        if($accInfo = $this->is_token())
        {
            $uid = $accInfo['uid'];
            //获取项目资料
            $projectData = $this->is_user_get_project($uid);
            //设置返回数据
            $data = array(
                'project'=>array(
                    'name'=>$projectData['name'],
                    'info'=>$projectData['info'],
                    'icon'=>$projectData['icon']
                )
            );
            $design = Data::get('design_id',null,function($val) use ($projectData)
            {
                if(empty($val))
                {
                    $this->msg(205,'抱歉,design_id参数不能为空');
                }

                if($val = DesignLogic::getTable($projectData['id'],$val))
                {
                    return $val;
                }
                $this->msg(205,'抱歉,该工作表格不存');
            });

            //合并数据 返回json
            if($data = array_merge($data,$design))
            {
                $this->msg(200,'ok',$data);
            }
            $this->msg(206,'服务器开小差了..');

        }


    }

    /**
     * 根据会员
     */
    public function getUserProjectList()
    {
        $acc = $this->is_token();
        //获取项目资料
        $projectData = $this->is_user_get_project($acc['uid']);
        $data = DesignLogic::findProject_idList($projectData['id']);
        if($data)
        {
            $this->msg(200,'ok',$data);
        }
        $this->msg(201,'not data');
    }


}