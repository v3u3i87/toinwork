<?php

Routes::get('/', 'works\action\MainAction@login');
//登陆
Routes::get('/api/user/login','works\action\api\UserAction@login');

Routes::group(array('prefix' => '/api','filters'=>'rbac'),function() {

    //新增账号
    Routes::get('/user/new','works\action\api\UserAction@add');
    //修改密码
    Routes::get('/user/edit/passwd','works\action\api\UserAction@editPasswd');
    //个人修改
    Routes::get('/user/personal/edit','works\action\api\UserAction@editInfo');
    //个人资料
    Routes::get('/user/personal/nickname','works\action\api\UserAction@nickname');
    //上传图片
    Routes::get('/load','works\action\api\LoadAction@main');

    //编辑项目
    Routes::get('/project/edit','works\action\api\ProjectAction@edit');

    //编辑标签
    Routes::get('/tag/edit','works\action\api\TagAction@edit');

    //标签工作字段
    Routes::get('/tag/work/field','works\action\api\TagAction@sysWorksList');

    //新增设计工作
    Routes::get('/design/add','works\action\api\DesignAction@add');

    //获取设计表结构
    Routes::get('/design/get/table','works\action\api\DesignAction@table');







});
