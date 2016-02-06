<?php
/**
 * About:Richard.z
 * Email:v3u3i87@gmail.com
 * Blog:https://www.zmq.cc
 * Date: 16/1/5
 * Time: 13:39
 * Name:
 */

namespace works\action;

use Config;
use Data;

class MainAction extends BaseAction{


    /**
     * 登陆
     */
    public function login()
    {
        echo '随便看看';
        echo '<br />';
        echo '你好,朋友..';
        echo '测试压压';
        echo '<br />';
        echo '在看看哈';
        $this->view('login.html');
    }



    public function test()
    {
        $keytitle = Data::get('in',null);
        if($keytitle)
        {
            $key = base64_decode($keytitle);
            p(json($key));
        }
        $this->view('test.html');
    }




}