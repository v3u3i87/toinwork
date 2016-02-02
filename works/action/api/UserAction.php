<?php
namespace works\action\api;

use Config;
use Data;
use works\action\BaseAction;
use works\logic\UserLogic;
use works\model\UserAccount;
use works\model\UserInfo;

class UserAction extends BaseAction{

    public $_userMo = null;

    public function __construct()
    {
        parent::__construct();
        $this->_userMo = new UserAccount();
    }

    /**
     * 新增账号
     */
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
                $this->msg(205,'抱歉,密码不能为空');
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
            UserInfo::add(array('uid'=>$uid,'create_time'=>time()));
            $this->msg(200,'新增用户成功',array('uid'=>$uid));
        }
        $this->msg(206,'新增失败');
    }

    /**
     * 登陆
     */
    public function login(){
        $email = Data::get('email',null,function($val)
        {
            if(empty($val))
            {
                $this->msg(205,'抱歉,邮箱不能为空');
            }

            if(!$this->_userMo->findEmail($val))
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

        if($loginInfo = UserLogic::login($email,$passwd))
        {
            $this->msg(200,'登陆成功',$loginInfo);
        }

        $this->msg(206,'邮箱或是密码错误');
    }

    /**
     * 修改密码
     */
    public function editPasswd(){

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

        $passwd = Data::get('passwd',null,function($val)
        {
            if(empty($val))
            {
                $this->msg(205,'抱歉,密码不能为空');
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

        if(UserAccount::editUserPasswd($accInfo['uid'],$passwd))
        {
            $this->msg(200,'密码修改成功');
        }
        $this->msg(206,'服务器有点繁忙,请稍后');

    }


    /**
     * 修改个人资料
     */
    public function editInfo()
    {

        $accInfo = Data::get('token',null,function($val)
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
            $this->msg(205,'过期或是不存在');
        });

        //昵称
        if($nickname = Data::get('nickname',false))
        {
            $_data['nickname'] = $nickname;
        }

        //真实姓名
        if($user_name = Data::get('user_name',false))
        {
            $_data['user_name'] = $user_name;
        }

        //身份证号码
        if($identity = Data::get('identity',false))
        {
            $_data['identity'] = $identity;
        }

        //头像
        if($icon = Data::get('icon',false))
        {
            $_data['icon'] = $icon;
        }

        //年龄
        if($age = Data::get('age',false))
        {
            $_data['age'] = $age;
        }

        //性别 1/女  2/男
        if($sex = Data::get('sex',false))
        {
            $_data['sex'] = $sex;
        }

        //职务
        if($position = Data::get('position',false))
        {
            $_data['position'] = $position;
        }

        if(UserInfo::UserEdit($accInfo['uid'],$_data))
        {
            $this->msg(200,'编辑成功');
        }

        $this->msg(206,'服务器有点繁忙,请稍后');

    }


    /**
     * 昵称资料
     */
    public function getInfo()
    {
        $accInfo = Data::get('token',null,function($val)
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
            $this->msg(205,'过期或是不存在');
        });

        $info = UserInfo::where(array('uid'=>$accInfo['uid']))->find('position,sex,icon,nickname');

        if($info){
            $this->msg(200,'ok',$info);
        }

        $this->msg(206,'没有任何资料');
    }






}