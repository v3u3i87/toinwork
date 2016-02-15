<?php

namespace works\action;

use Data;

class WorksAction extends BaseAction{

    //列表
    public function main()
    {
        $this->val('name','工作 - toinwork');
        $this->view('main.html');
    }

    //编辑
    public function edit()
    {
        $this->val('name','编辑 - toinwork');
        $this->view('edit.html');
    }

    //详情
    public function show()
    {
        $this->val('name','详情 - toinwork');
        $this->view('show.html');
    }




}