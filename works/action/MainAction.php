<?php

namespace works\action;

use Data;
use Session;
class MainAction extends BaseAction{

    /**
     * 登陆
     */
    public function login()
    {
        if(Session::get('token'))
        {
            return jump('/main/home');
        }else{
            $this->val('name','登陆 - toinwork');
            $this->view('login.html');
        }
    }

    /**
     * 退出
     */
    public function quit()
    {
        $client = $this->getClientType();
        if($client == 'web')
        {
            $acc = $this->is_token();
            $token = Session::get('token');
            if ($acc['access_token'] == $token)
            {
                if (Session::del('token'))
                {
                    setcookie('token','');
                    $this->msg(200, '退出成功');
                } else {
                    $this->msg(204, '服务有点小问题,无法退出..');
                }
            }
        }else{
            $this->msg(201,'目前退出仅支持网页.');
        }
        $this->msg(206,'非法请求');
    }

    public function test()
    {
//        if(isset($_COOKIE['info']))
//        {
//            p($_COOKIE);
//        }else{
//            vd(setcookie("info", 1212, time()+3600));
//        }

        $keytitle = Data::get('in',null);
        if($keytitle)
        {
            $key = base64_decode($keytitle);
            p(json($key));
        }
        $this->view('test.html');
    }




}