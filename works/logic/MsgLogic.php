<?php
namespace works\logic;

use works\model\Msg;
use works\model\MsgReply;

class MsgLogic
{


    /**
     * 新增消息
     * @param null $uid
     * @param null $works_id
     * @param null $info
     * @param int $type
     * @return bool
     */
    public static function addMsg($uid=null,$works_id=null,$info=null,$type=2)
    {
        if(!$uid && !$info || $type > 3)
        {
            return false;
        }
        $data['uid'] = $uid;
        $data['info'] = $info;
        $data['type'] = $type;
        $data['task_id'] = $works_id;
        $data['is_status'] = 1;
        $data['update_time'] = time();
        $data['create_time'] = time();
        return Msg::add($data);
    }


    /**
     * 查询一条消息
     * @param null $msg_id
     * @return mixed
     */
    public static function findMsg($msg_id=null)
    {
        return Msg::where(array('id'=>$msg_id,'is_status'=>1))->find();
    }

    /**
     *
     * @param $uid
     * @param $msg_id
     * @param $info
     * @param int $a_tail
     */
    public static function addMsgReply($uid,$msg_id,$info)
    {
        if(!$uid && !$info && !$msg_id)
        {
            return false;
        }
        $data['uid'] = $uid;
        $data['info'] = $info;
        $data['msg_id'] = $msg_id;
        $data['update_time'] = time();
        $data['create_time'] = time();
        return MsgReply::add($data);
    }


    /**
     * 查询工作评论和回复
     * @param int $works_id
     * @return bool
     */
    public static function byWorksId($works_id=0)
    {
        if($works_id)
        {
           $msgData = Msg::where(array('type'=>2,'task_id'=>$works_id,'is_status'=>1))->sort('id',false)->get('id as msg_id,uid,info,create_time');
           if($msgData)
           {
               foreach($msgData as $k=>$v)
               {
                   $msgData[$k]['reply'] = [];
                   $tmp = MsgReply::where(['msg_id'=>$v['msg_id']])->sort('id',false)->get('id as msg_reply_id,uid,info,create_time');
                   if($tmp)
                   {
                       $msgData[$k]['reply'] = $tmp;
                   }
               }
               return $msgData;
           }
            return false;
        }
        return false;
    }

}