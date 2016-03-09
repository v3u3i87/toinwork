<?php

//判断登陆
Routes::filters('login',function() {

   if(!isset($_COOKIE['token']))
   {
       jump('/');
   }
});