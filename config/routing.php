<?php

Routes::get('/', 'works\action\DemoAction@home');


Routes::group(array('prefix' => '/api'),function() {

    Routes::get('/user/new','works\action\api\UserAction@add');

    Routes::get('/user/login','works\action\api\UserAction@login');

});
