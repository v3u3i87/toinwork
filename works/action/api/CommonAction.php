<?php
/**
 * About:Richard.z
 * Email:v3u3i87@gmail.com
 * Blog:https://www.zmq.cc
 * Date: 16/5/29
 * Time: 13:17
 * Name:
 */
namespace works\action\api;

use works\action\BaseAction;

use Config;
use Data;
use Session;
use works\logic\UserLogic;

use works\model\UserAccount;
use works\model\UserInfo;


class CommonAction extends BaseAction
{

    /**
     * 退出
     */
    public function quit()
    {
        $client = $this->getClientType();
        $user = $this->is_token();
        if($client == 'web')
        {
            $token = Session::get('token');
            if ($user['access_token'] == $token)
            {
                Session::del('token');
                setcookie('token','');
            }
        }
        if(UserLogic::quit($user))
        {
            $this->msg(200,'退出成功');
        }
        $this->msg(201,'退出失败');
    }

    /**
     * 登陆
     */
    public function login()
    {
        $client = $this->getClientType();
        $email = Data::get('email',null,function($val)
        {
            if(empty($val))
            {
                $this->msg(205,'抱歉,邮箱不能为空');
            }

            if(!UserAccount::findEmail($val))
            {
                $this->msg(205,'抱歉,邮箱不存在');
            }

            return $val;
        });

        $passwd = Data::get('passwd',null,function($val)
        {
            if(empty($val))
            {
                $this->msg(205,'抱歉,确认密码不能为空');
            }
            return $val;
        });

        if($client)
        {
            if($loginInfo = UserLogic::login($email,$passwd))
            {
                //部分有待加密或是验证机制
                if($client == 'web')
                {
                    Session::set('token',$loginInfo['token']);
//                    setcookie("token", $loginInfo['token'], time()+3600);
//                    return jump('/main/home');
                }
                $this->msg(200,'登陆成功',$loginInfo);
            }
            $this->msg(206,'邮箱或是密码错误');
        }
        $this->msg(206,'非法请求');
    }






}