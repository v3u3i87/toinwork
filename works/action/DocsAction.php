<?php

namespace works\action;

use Data;

class DocsAction extends BaseAction{


    /**
     * 文档列表
     */
    public function all()
    {
        $this->val('name','文档 - toinwork');
        $this->view('all.html');
    }


    //详情
    public function show()
    {
        $this->val('name','文档详情 - toinwork');
        $this->view('show.html');
    }




}