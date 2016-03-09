<?php

namespace works\action;

use Data;

class HomeAction extends BaseAction{


    /**
     * 主页
     */
    public function main()
    {
        $this->val('name','项目区域 - toinwork');
        $this->view('main.html');
    }


    /**
     *设计工作区
     * @throws \Upadd\Bin\UpaddException
     */
    public function design()
    {
        $this->val('name','设计工作模板 - toinwork');
        $this->view('design.html');
    }




}