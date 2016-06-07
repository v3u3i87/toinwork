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