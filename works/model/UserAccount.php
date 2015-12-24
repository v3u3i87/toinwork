<?php

namespace works\model;

use Config;

class UserAccount extends BaseModel{

    //设置数据库名称
    public $_table = 'user_account';

    /**
     * 新增会员
     * @param null $email
     * @param null $passwd
     * @param null $uname
     * @param null $mobile
     * @param int $is_state
     * @return bool
     */
    public function addUser($email=null,$passwd=null,$uname=null,$mobile=null,$is_state=1){
        if(empty($email) || empty($passwd)){
            return false;
        }
        $_data = array(
            'email'=>$email,
            'passwd'=>md5($passwd.Config::get('tag@user_key')),
            'uname'=>$uname,
            'mobile'=>$mobile,
            'is_state'=>$is_state,
            'update_time'=>time(),
            'create_time'=>time(),
        );
        return $this->add($_data);
    }


    /**
     * 查询邮箱
     * @param $email
     * @return mixed
     */
    public static function findEmail($email){
        return self::where(" email='{$email}' ")->find();
    }


    /**
     * 查询用户名
     * @param $email
     * @return mixed
     */
    public static function findUname($uname){
        return self::where(array('uname'=>$uname))->find();
    }

    /**
     * 查询手机号
     * @param $email
     * @return mixed
     */
    public static function findMobile($mobile){
        return self::where(array('mobile'=>$mobile))->find();
    }


    /**
     * 查询手机号
     * @param $email
     * @return mixed
     */
    public static function loginCheck($email,$passwd){
        return self::where(array('email'=>$email,'passwd'=>md5($passwd.Config::get('tag@user_key'))))->find();
    }





}