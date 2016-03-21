<?php

//判断登陆
Routes::filters('login',function() {

   if(!Session::get('token'))
   {
       jump('/');
   }

});