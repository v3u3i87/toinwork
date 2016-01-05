<?php
namespace works\action\api;

use Data;
use works\action\BaseAction;
use works\logic\UserLogic;
use works\model\Project;

class ProjectAction extends BaseAction{

    /**
     * 编辑项目
     */
    public function edit()
    {
        $accInfo = Data::get('token',null,function($val)
        {
            if(empty($val))
            {
                $this->msg(205,'抱歉,token不能为空');
            }
            $val = UserLogic::verifyTokenExpired($val);
            if($val){
                return $val;
            }
            $this->msg(205,'过期或是不存在');
        });
        $uid = $accInfo['uid'];
        $_data = array(
            'name'=>Data::get('name',null,function($val){
                        if(empty($val))
                        {
                            $this->msg(205,'抱歉,name不能为空');
                        }
                return $val;
            }),
            'info'=>Data::get('info',false),
            'icon'=>Data::get('icon',false)
        );

        $project_id = (int) Data::get('project_id',0);
        $req = Project::edit(array_filter($_data),$uid,$project_id);
        if($req)
        {
            if($req > 1)
            {
                $this->msg(200, '新增成功', array('project_id' => $req));
            }else{
                $this->msg(200, '编辑成功');
            }
        }else{
            $this->msg(206,'编辑失败');
        }

    }








}