<?php

namespace works\action;
set_time_limit(0);

use Data;
class MainAction extends BaseAction{


    /**
     * 登陆
     */
    public function login()
    {
        $this->val('name','登陆 - toinwork');
        $this->view('login.html');
    }

    public function test()
    {
        $keytitle = Data::get('in',null);
        if($keytitle)
        {
            $key = base64_decode($keytitle);
            p(json($key));
        }
        $this->view('test.html');
    }

    public function abc()
    {

        //ob_implicit_flush();
        $address = '127.0.0.1';
        $port = 10005;
        //创建端口
        if( ($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false)
        {
            echo "socket_create() failed :reason:" . socket_strerror(socket_last_error()) . "\n";
        }

        //绑定
        if (socket_bind($sock, $address, $port) === false)
        {
            echo "socket_bind() failed :reason:" . socket_strerror(socket_last_error($sock)) . "\n";
        }

        //监听
        if (socket_listen($sock, 5) === false)
        {
            echo "socket_bind() failed :reason:" . socket_strerror(socket_last_error($sock)) . "\n";
        }

        do {
            //得到一个链接
            if (($msgsock = socket_accept($sock)) === false)
            {
                echo "socket_accepty() failed :reason:".socket_strerror(socket_last_error($sock)) . "\n";
                break;
            }

            //welcome  发送到客户端
            $msg = "server send:zmq-mac";
            socket_write($msgsock, $msg, strlen($msg));
            echo 'read client message\n';
            $buf = socket_read($msgsock, 8192);
            $talkback = "received message:$buf\n";
            echo $talkback;
            if (false === socket_write($msgsock, $talkback, strlen($talkback)))
            {
                echo "socket_write() failed reason:" . socket_strerror(socket_last_error($sock)) ."\n";
            } else {
                echo 'send success';
            }
            socket_close($msgsock);
        } while(true);
        //关闭socket
        socket_close($sock);
    }



}