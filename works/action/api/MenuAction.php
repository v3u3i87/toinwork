<?php
namespace works\action\api;

use Data;
use works\action\BaseAction;
use works\model\Menu;
use works\logic\DocsLogic;

class MenuAction extends BaseAction{


    /**
     * 编辑
     */
    public function user_edit()
    {
        $acc = $this->is_token();
        $menu_id = Data::get('menu_id',0);
        $data['fid'] = (int) Data::get('fid',0,function($val)
        {
            if(!is_numeric($val))
            {
                $this->msg(205,'抱歉,fid只接受数值类型.');
            }
            if($val > 0)
            {
                if(!Menu::first($val))
                {
                    $this->msg(205,'抱歉,该fid值存在问题.');
                }
            }
            return $val;
        });

        $data['sort'] = (int) Data::get('sort',0);
        $data['name'] = Data::get('name',null,function($val)
        {
            if(empty($val))
            {
                $this->msg(205,'名称必须填写');
            }
            return $val;
        });
        $up = null;
        if($menu_id)
        {
            $up = Menu::update($data,array('uid'=>$acc['uid'],'id'=>$menu_id));
        }else{
            $data['type'] = 1;
            $data['uid'] = $acc['uid'];
            $data['is_status'] = 1;
            $up = Menu::add($data);
        }

        if($up)
        {
            $this->msg(200,'编辑成功');
        }

        $this->msg(201,'编辑失败');
    }


    /**
     * 菜单列表
     */
    public function user_list()
    {
        $acc = $this->is_token();
        $list = Menu::where(array('type'=>1,'uid'=>$acc['uid'],'is_status'=>1))->get('id as menu_id ,name,fid,sort');
        if($list)
        {
            $this->msg(200,'ok',DocsLogic::Menutree($list));
        }
        $this->msg(201,'not data');
    }



}