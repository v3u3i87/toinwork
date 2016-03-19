<?php
/**
 * About:Richard.z
 * Email:v3u3i87@gmail.com
 * Blog:https://www.zmq.cc
 * Date: 16/1/7
 * Time: 15:56
 * Name: 项目逻辑
 */

namespace works\logic;

use works\model\Project;
use works\model\ProjectUser;
use works\model\WorkDesign;

class ProjectLogic{


    /**
     * 判断用户是否属于项目区,返回项目区资料
     * @param $uid
     * @param $project_id
     * @return bool | array
     */
    public static function is_user_project_find($uid,$project_id)
    {
        if($uid && $project_id)
        {

            if(ProjectUser::where(array('project_id'=>$project_id,'uid'=>$uid,'is_status'=>1))->find())
            {
                return Project::where(array('id'=>$project_id))->find();
            }

        }
        return false;
    }


    /**
     * 根据会员ID查询项目列表
     * @param null $uid
     * @return bool| array
     */
    public static function getUserList($uid=null)
    {
        if($uid)
        {
            $project_idList = ProjectUser::byUserList($uid);
            if($project_idList)
            {
                $data = [];
                foreach($project_idList as $k=>$v)
                {
                    $data[] = $v['project_id'];
                }
                $data = Project::byIdInList($data);
                foreach($data as $k=>$v)
                {
                    $data[$k]['design_count'] = 0;
                    $tmp = WorkDesign::projectIdByCount($v['project_id']);
                    if($tmp >= 1)
                    {
                        $data[$k]['design_count'] = $tmp;
                    }
                }
                return $data;
            }
        }
        return false;
    }



}