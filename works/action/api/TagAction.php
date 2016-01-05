<?php
namespace works\action\api;

use Data;
use works\action\BaseAction;
use works\logic\UserLogic;
use works\model\Tag;

class TagAction extends BaseAction{

    /**
     * 编辑标签
     */
    public function edit()
    {
        $accInfo = Data::get('token',null,function($val)
        {
            if(empty($val))
            {
                $this->msg(205,'抱歉,token不能为空');
            }
            $val = UserLogic::verifyTokenExpired($val);
            if($val){
                return $val;
            }
            $this->msg(205,'过期或是不存在');
        });

        $_data = array(
            'name'=>Data::get('name',null,function($val){
                if(empty($val))
                {
                    $this->msg(205,'抱歉,name不能为空');
                }
                return $val;
            }),
            'data'=>Data::get('data',null,function($val){
                if(empty($val))
                {
                    $this->msg(205,'抱歉,data不能为空');
                }
                return $val;
            }),
            'info'=>Data::get('info',false),
        );

        //标签类型ID不能为空
        $type_id = (int) Data::get('type_id',0,function($val) use ($accInfo) {
            if(empty($val))
            {
                $this->msg(205,'抱歉,type_id不能为空');
            }
            if($val==1) {
                if ($accInfo['uid'] != 1) {
                    $this->msg(205, '抱歉,只有最高权限才可以使用哦');
                }
            }
            return $val;
        });


        $tag_id = (int) Data::get('tag_id',0);

        $req = Tag::edit(array_filter($_data),$type_id,$tag_id);
        if($req)
        {
            if($req > 1)
            {
                $this->msg(200, '新增成功', array('tag_id' => $req));
            }else{
                $this->msg(200, '编辑成功');
            }
        }else{
            $this->msg(206,'编辑失败');
        }

    }


    /**
     * 系统标签字段
     */
    public function sysWorksList(){
        $list = Tag::where(array('type'=>1,'is_status'=>1))->get('id as tag_id,name,data,info');
        foreach($list as $k=>$v){
            $list[$k]['sole'] = array(array('name'=>'否','val'=>1),array('name'=>'是','val'=>2));
        }
        $this->msg(200,'ok',$list);
    }








}