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
        $this->val('name','登陆 - toinwork');
        $this->view('login.html');
    }

    public function test()
    {
        if(isset($_COOKIE['info']))
        {
            p($_COOKIE);
        }else{
            setcookie("info", 1212, time()+3600);
        }

        $keytitle = Data::get('in',null);
        if($keytitle)
        {
            $key = base64_decode($keytitle);
            p(json($key));
        }
        $this->view('test.html');
    }




}