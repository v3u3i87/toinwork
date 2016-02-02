<?php

Routes::get('/', 'works\action\MainAction@login');

//组
Routes::group(array('prefix' => '/api'),function() {

    //上传图片
    Routes::get('/load','works\action\api\LoadAction@main');
    //登陆验证
    Routes::get('/user/login','works\action\api\UserAction@login');
    //新增账号
    Routes::get('/user/new','works\action\api\UserAction@add');
    //修改密码
    Routes::get('/user/edit/passwd','works\action\api\UserAction@editPasswd');
    //个人修改
    Routes::get('/user/personal/edit','works\action\api\UserAction@editInfo');
    //获取个人资料
    Routes::get('/user/personal/info','works\action\api\UserAction@getInfo');

    //编辑标签
    Routes::get('/tag/edit','works\action\api\TagAction@edit');
    //标签工作字段
    Routes::get('/tag/sys/field','works\action\api\TagAction@sysWorksList');

    ///////项目相关

    //编辑项目
    Routes::get('/project/edit','works\action\api\ProjectAction@edit');

    ///////设计工作相关

    //新增设计工作
    Routes::get('/design/add','works\action\api\DesignAction@add');
    //获取设计结构
    Routes::get('/design/get/table','works\action\api\DesignAction@table');

    ///工作区相关

    //编辑工作
    Routes::get('/works/edit','works\action\api\worksAction@edit');

});

