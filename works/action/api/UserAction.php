<?php
namespace works\action\api;

use Config;
use Data;
use works\action\BaseAction;
use works\logic\UserLogic;
use works\model\UserAccount;

class UserAction extends BaseAction{

    public $_userMo = null;

    public function __construct()
    {
        parent::__construct();
        $this->_userMo = new UserAccount();
    }


    public function add()
    {
        $email = Data::get('email',null,function($val)
        {
            if(empty($val))
            {
                $this->msg(205,'抱歉,邮箱不能为空');
            }

            if($this->_userMo->findEmail($val))
            {
                $this->msg(205,'抱歉,邮箱已存在');
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

        $notPasswd = Data::get('not_passwd',null,function($val)
        {
            if(empty($val))
            {
                $this->msg(205,'抱歉,确认密码不能为空');
            }
            return $val;
        });

        if($passwd !== $notPasswd)
        {
            $this->msg(205,'抱歉,密码不相同');
        }

        $uname = Data::get('uname',0);
        $moblie = Data::get('moblie',0);

        $uid = $this->_userMo->addUser($email,$passwd,$uname,$moblie);
        if($uid)
        {
            $this->msg(200,'新增用户成功',array('uid'=>$uid));
        }
        $this->msg(206,'新增失败');
    }




}