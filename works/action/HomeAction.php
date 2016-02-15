<?php

namespace works\action;

use Data;

class HomeAction extends BaseAction{


    /**
     * 主页
     */
    public function main()
    {
        $this->val('name','欢迎您使用 - toinwork');
        $this->view('main.html');
    }


    /**
     *设计工作区
     * @throws \Upadd\Bin\UpaddException
     */
    public function design()
    {
        $this->val('name','设计工作区 - toinwork');
        $this->view('design.html');
    }





}