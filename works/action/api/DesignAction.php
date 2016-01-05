<?php
namespace works\action\api;

use Data;
use works\action\BaseAction;
use works\model\Tag;
use works\model\Project;
use works\model\ProjectUser;

use works\logic\UserLogic;
use works\logic\DesignLogic;

class DesignAction extends BaseAction{


    public function add(){
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
        //工作名称
        $name = Data::get('name',null,function($val)
        {
            if(empty($val))
            {
                $this->msg(205,'抱歉,name值不能为空');
            }
            return $val;
        });

        //项目ID
        $project_id = (int) Data::get('project_id',0,function($val) use ($uid)
        {
            if(empty($val)){
                $this->msg(205,'抱歉,project_id参数不能为空');
            }

            if(!Project::where(array('id'=>$val))->find())
            {
                $this->msg(205,'抱歉,您的上级项目不存在');
            }

            //判断是否为项目创建人
            if(!Project::where(array('id'=>$val,'uid'=>$uid))->find())
            {
                /**
                 * 判断项目成员是否存在
                 */
                if(!ProjectUser::where(array('project_id'=>$val,'uid'=>$uid))->find())
                {
                    $this->msg(205,'严重警告,请勿非法提交数据');
                }
            }
            return $val;
        });

        //模板数据
        $template = Data::get('template',null,function($val)
        {
            if(empty($val))
            {
                $this->msg(205,'抱歉,template不能为空');
            }

            if($val = base64_decode($val))
            {
                if($val = json_decode($val,true))
                {
                    return $val;
                }else{
                    $this->msg(205,'抱歉,template参数json格式错误');
                }
            }else{
                $this->msg(205,'抱歉,template的数据不是base64');
            }
        });

        $logic = DesignLogic::add($name,$template,$uid,$project_id);
        if(is_array($logic)){
            $this->msg(205,'template的数据不合法');
        }elseif($logic===true){
            $this->msg(200,'添加成功');
        }else{
            $this->msg(206,'服务器繁忙,请稍等.');
        }

    }




}