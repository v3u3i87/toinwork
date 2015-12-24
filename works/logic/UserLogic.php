<?php
/**
 * Created by PhpStorm.
 * User: zmq
 * Date: 2015/8/4
 * Time: 11:12
 */

namespace works\logic;

use works\model\UserAccount;
use Config;

class UserLogic{


    /**
     * 登陆逻辑
     * @param $email
     * @param $passwd
     * @return array|bool
     */
    public static function login($email,$passwd)
    {
        if($email && $passwd)
        {
            /**
             * 验证用户
             */
            if ($accInfo = UserAccount::loginCheck($email, $passwd))
            {
                $time = time();
                $token = get_hash($email . $time);

                $save = array(
                    'access_token' => $token,
                    'access_time'=>$time,
                    'login_count' => $accInfo['login_count'] + 1,
                    'last_ip' => getClient_id(),
                    'update_time' => $time,
                );

                $req = UserAccount::save($save, array('uid' => $accInfo['uid']));
                if ($req) {
                    return array('token' => $token, 'time' => (date('Y/m/d-H/i/s', $time)));
                }
            }
        }

        return false;
    }


    /**
     * 验证Token是否过期
     * @param null $token
     * @return bool
     */
    public static function verifyTokenExpired($token,$access_time = null)
    {
        if($token)
        {
            $accInfo = UserAccount::tokenCheck($token);
            if($accInfo) {
                $access_time = $accInfo['access_time'];
                //获取设置的时间
                $day = Config::get('tag@user_access_time_day');
                //获取时间公式
                $byDay = strtotime(date('Y-m-d', strtotime("+{$day} day")));
                //时间未超过
                if ($access_time <= $byDay) {
                    return $accInfo;
                }
            }
        }
        return false;
    }







}