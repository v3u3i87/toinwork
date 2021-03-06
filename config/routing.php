<?php

Routes::get('/', 'works\action\MainAction@login');

Routes::get('/test', 'works\action\MainAction@test');

//API
Routes::group(array('prefix' => '/api/v1'),function()
{

    //上传图片
    Routes::get('/load','works\action\api\LoadAction@main');
    //登陆验证
    Routes::get('/user/login','works\action\api\CommonAction@login');
    //退出
    Routes::get('/user/quit','works\action\api\CommonAction@quit');
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
    Routes::get('/tag/sys/field','works\action\api\TagAction@webField');

    #项目相关

    //项目列表
    Routes::get('/project/list','works\action\api\ProjectAction@getUserList');
    //项目编辑
    Routes::get('/project/edit','works\action\api\ProjectAction@edit');

    #设计工作相关

    //新增设计工作
    Routes::get('/design/edit','works\action\api\DesignAction@edit');
    //设计列表
    Routes::get('/design/list','works\action\api\DesignAction@getUserProjectList');
    //获取设计结构
    Routes::get('/design/get/table','works\action\api\DesignAction@table');

    #工作区相关

    //工作列表
    Routes::get('/works/list','works\action\api\WorksAction@getList');
    //工作编辑
    Routes::get('/works/edit','works\action\api\WorksAction@edit');
    //工作详情
    Routes::get('/works/show','works\action\api\WorksAction@show');

    #评论

    //工作评论
    Routes::get('/msg/company/works','works\action\api\MsgAction@works');
    //工作回复
    Routes::get('/msg/company/works/reply','works\action\api\MsgAction@works_reply');

    #文档相关

    //编辑菜单
    Routes::get('/menu/user/edit','works\action\api\MenuAction@user_edit');
    //菜单列表
    Routes::get('/menu/user/list','works\action\api\MenuAction@user_list');
    //菜单异步处理
    Routes::get('/menu/user/asynchronous','works\action\api\MenuAction@asynchronous');

    //获取文档列表
    Routes::get('/docs/user/list','works\action\api\DocsAction@getUserList');
    //获取文档内容
    Routes::get('/docs/user/content','works\action\api\DocsAction@getUserContent');
    //编辑文档
    Routes::get('/docs/user/edit','works\action\api\DocsAction@userEdit');
    //分享文档
    Routes::get('/docs/share','works\action\api\DocsAction@getShareContent');
    //异步处理文档
    Routes::get('/docs/user/asynchronous','works\action\api\DocsAction@asynchronous');

    //升级
    Routes::get('/upgrade','works\action\api\UpgradeAction@main');

});


//web端
Routes::group(array('prefix'=>'/main','filters'=>'login'),function(){

    //项目区
    Routes::get('/home','works\action\HomeAction@main');

    /**
     * 设计
     */
    Routes::get('/design','works\action\HomeAction@design');

    /**
     * 工作区
     */
    Routes::get('/workspace','works\action\HomeAction@workspace');

    ###工作区
    Routes::get('/works','works\action\WorksAction@main');
    //编辑
    Routes::get('/works/edit','works\action\WorksAction@edit');
    //详情
    Routes::get('/works/show','works\action\WorksAction@show');

    ###文档

    //文档列表 /main/docs
    Routes::get('/docs','works\action\DocsAction@all');
    //文档详情 /main/docs/show
    Routes::get('/docs/show','works\action\DocsAction@show');


});