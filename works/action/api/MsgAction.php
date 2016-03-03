<?php
namespace works\action\api;

use Data;
use works\action\BaseAction;
use works\model\Msg;
use works\model\Works;
use works\logic\MsgLogic;

class MsgAction extends BaseAction{

    /**
     * 工作评论
     */
    public function works()
    {
        $accInfo = $this->is_token();

        $works_id = (int) Data::get('works_id',0,function($val)
        {
            if(empty($val))
            {
                $this->msg(205,'抱歉,works_id不能为空');
            }

            if(Works::first($val))
            {
                return $val;
            }
            $this->msg(205,'违法的参数');
        });

        $info = Data::get('info',null,function($val)
        {
            if(empty($val))
            {
                $this->msg(205,'抱歉,info参数不能为空');
            }
            return $val;
        });

        /**
         * 新增信息
         */
        if($msgId = MsgLogic::addMsg($accInfo['uid'],$works_id,$info,2))
        {
            $this->msg(200,'ok',array('msg_id'=>$msgId));
        }

        $this->msg(201,'服务失败');
    }


    //工作评论回复
    public function works_reply()
    {
        $accInfo = $this->is_token();

        $msg_id = (int) Data::get('msg_id',0,function($val)
        {
            if(empty($val))
            {
                $this->msg(205,'抱歉,msg_id不能为空');
            }

            if(MsgLogic::findMsg($val))
            {
                return $val;
            }
            $this->msg(205,'回复对象不存在或违法的参数');
        });

        $info = Data::get('info',null,function($val)
        {
            if(empty($val))
            {
                $this->msg(205,'抱歉,info参数不能为空');
            }
            return $val;
        });

        if($msg_reply_id = MsgLogic::addMsgReply($accInfo['uid'],$msg_id,$info))
        {
            return $this->msg(200,'ok',['msg_reply_id'=>$msg_reply_id]);
        }

        $this->msg(201,'回复失败');
    }







}