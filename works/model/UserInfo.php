<?php

namespace works\model;


class UserInfo extends BaseModel{

    //设置数据库名称
    public $_table = 'user_info';

    /**
     * 编辑用户信息
     * @param null $uid
     * @param array $data
     * @return bool
     */
    public static function UserEdit($uid=null,$data=array())
    {
        if(empty($data) || empty($uid))
        {
            return false;
        }

        if(isset($data['user_name']))
        {
            $_data['user_name'] = $data['user_name'];
        }

        if(isset($data['nickname']))
        {
            $_data['nickname'] = $data['nickname'];
        }

        if(isset($data['identity']))
        {
            $_data['identity'] = $data['identity'];
        }

        if(isset($data['icon']))
        {
            $_data['icon'] = $data['icon'];
        }

        if(isset($data['age']))
        {
            $_data['age'] = $data['age'];
        }

        if(isset($data['sex']))
        {
            $_data['sex'] = $data['sex'];
        }

        if(isset($data['position']))
        {
            $_data['position'] = $data['position'];
        }

        $_data['update_time'] = time();

        if(self::save($_data,array('uid'=>$uid)))
        {
            return true;
        }
        return false;
    }





}