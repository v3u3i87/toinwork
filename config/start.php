<?php

return array(

    'environment'=>array(
        'local'=>array('RR-ZMQ','demo','Mac-zmq.local','Mac-zmq.lan','PC-PC'),
        'dev'=>array('xcvu')
    ),

    'is_autoload'=>false,

    //命名空间辐射关系
    'autoload'=>array(
        //控制器
        "Up\\Action\\"=>'works/action/',
        "Up\\Logic\\"=>'works/logic/',

    ),

    //CLI模式下命名空间
    'cli_action_autoload'=>'works\\action\\',

    /**
     * 自定义设置别名
     */
//    'alias'=>array('Info'=>'works\Package\Info'),

    //开启 session
    'is_session'=>true,






);