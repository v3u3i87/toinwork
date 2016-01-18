<?php

//Routes::get('/', 'works\action\MainAction@login');

Routes::get('/', function(){

    $test = new  \works\model\Test();

//    p($test->findByPk(3),1);
//
////    $test->where(array('type'=>2))->count_distinct('id');
//
//    p($test->where(' id=2 ')->find(),1);
//
//    p($test->where(array('id'=>10))->find(),1);
//
//    p($test->where('type=2')->limit(3)->get('id,name'),1);
//
////    $get = $test->where('type=2')->limit(3)->sort('id',false)->get();
//    p($test->where('type=3')->like('name','嘻')->limit(10)->sort('id',false)->get(array('id','type','name')));


//    $test->where(array('id'=>15));
//    $test->type = 5;
//    $test->info = '我只是...';
//    $test->name = '什么呢1';
//    $tmp = $test->save(array('type'=>6,'info'=>'哈哈','name'=>1212),array('id'=>16));
//    echo $tmp;

});

//登陆
Routes::get('/api/user/login','works\action\api\UserAction@login');

Routes::group(array('prefix' => '/api'),function() {

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

    //新增工作
    Routes::get('/works/edit','works\action\api\worksAction@edit');

});

