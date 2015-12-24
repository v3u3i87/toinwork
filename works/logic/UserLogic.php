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
                $token = get_hash($email . time());

                $save = array(
                    'access_token' => $token,
                    'login_count' => $accInfo['login_count'] + 1,
                    'last_ip' => getClient_id(),
                    'update_time' => time(),
                );

                $req = UserAccount::save($save, array('uid' => $accInfo['uid']));
                if ($req) {
                    return array('token' => $token, 'time' => (date('Y/m/d-H/i/s', time())));
                }
            }
        }

        return false;
    }





}