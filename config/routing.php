<?php

Routes::get('/', 'works\action\DemoAction@home');


Routes::group(array('prefix' => '/api'),function() {

    //新增账号
    Routes::get('/user/new','works\action\api\UserAction@add');
    //登陆
    Routes::get('/user/login','works\action\api\UserAction@login');
    //修改密码
    Routes::get('/user/edit/passwd','works\action\api\UserAction@editPasswd');

});
