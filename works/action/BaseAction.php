<?php
/**
 * User: Richard.Z
 * Email: v3u3i87@gmail.com 
 * Date: 2015/9/6
 * Time: 13:16
 */

namespace works\action;

use Upadd\Frame\Action;

use Data;
use Config;
use works\logic\UserLogic;
use works\logic\ProjectLogic;

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


    /**
     * 判断token
     * @return mixed
     */
    public function is_token(){
        return Data::get('token',null,function($val)
        {
            if(empty($val))
            {
                $this->msg(205,'抱歉,token不能为空');
            }
            $val = UserLogic::verifyTokenExpired($val);
            if($val)
            {
                return $val;
            }
            $this->msg(208,'过期或是不存在');
        });
    }


    /**
     * 判断会员是否属于项目区,并返回项目资料
     * @param $uid
     * @return mixed
     */
    public function is_user_get_project($uid)
    {
        return Data::get('project_id',null,function($project_id) use ($uid)
        {
            if(empty($project_id))
            {
                $this->msg(205,'抱歉,project_id参数不能为空');
            }

            if($project_id = ProjectLogic::is_user_project_find($uid,$project_id))
            {
                return $project_id;
            }

            $this->msg(205,'抱歉,您不是该项目区的.');

        });
    }


    /**
     * 获取客户端类型
     * @return mixed
     */
    public function getClientType()
    {
        return Data::get('client',null,function($val)
        {
              if(empty($val))
              {
                  $this->msg(205,'client not null.');
              }

              if(!in_array($val,Config::get('tag@client_type')))
              {
                  $this->msg(205,'The client type error.');
              }
            return $val;
        });
    }



}