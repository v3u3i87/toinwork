<?php
namespace works\action\api;

use Data;
use works\action\BaseAction;
use works\model\Docs;
use works\model\Menu;

class DocsAction extends BaseAction{


    //获取
    public function getUserList()
    {
        if($acc = $this->is_token())
        {
            $menu_id = (int) Data::get('menu_id',0);
            $where['type'] = 1;
            $where['uid'] = $acc['uid'];
            $where['is_status'] = 1;
            $list = array();
            //临时查询的字段
            $tmpField = "id AS docs_id,menu_id,title,content,share,update_time,create_time";
            if($menu_id)
            {
                //查询是否该会员的
                $find = Menu::where(array('id'=>$menu_id,'uid'=>$acc['uid'],'type'=>1))->find();
                if(!$find)
                {
                    $this->msg(205,'该菜单没有创建..');
                }
                $tmp = $where;
                $tmp['menu_id'] = $menu_id;
                $list = Docs::where($tmp)->page()->sort('id')->get($tmpField);
                if(empty($list))
                {
                    $menuList = Menu::where(array('fid'=>$menu_id,'type'=>1,'uid'=>$acc['uid']))->get('id');
                    if($menuList)
                    {   $menuListTmp = [];
                        foreach($menuList as $k=>$v)
                        {
                            $menuListTmp[] = $v['id'];
                        }
                        $list = Docs::where($where)->in_where('menu_id',$menuListTmp)->page()->sort('id')->get($tmpField);
                    }
                }
            }else{
                $list = Docs::where($where)->page()->sort('id')->get($tmpField);
            }

            if($list)
            {
                $this->msg(200,'ok',$list);
            }
        }
        $this->msg(201,'not data');
    }


    //编辑内容
    public function userEdit()
    {
        if($acc = $this->is_token())
        {
            $docs_id = Data::get('docs_id',0);
            $data['menu_id'] = Data::get('menu_id',0);
            $data['title'] = Data::get('title',null,function($val)
            {
                if(empty($val))
                {
                    $this->msg(205,'标题必须填写');
                }
                return $val;
            });

            $data['content'] = Data::get('content',null,function($val)
            {
                if(empty($val))
                {
                    $this->msg(205,'内容必须填写');
                }
                return $val;
            });
            $data['update_time'] = time();
            $up = null;
            if($docs_id)
            {
                $up = Docs::update($data,array('uid'=>$acc['uid'],'id'=>$docs_id));
            }else{
                $data['type'] = 1;
                $data['uid'] = $acc['uid'];
                $data['share'] = 2;
                $data['is_status'] = 1;
                $data['create_time'] = time();
                $up = Docs::add($data);
            }

            if($up)
            {
                $this->msg(200,'编辑成功');
            }
        }
        $this->msg(201,'编辑失败');
    }


    //获取内容
    public function getUserContent()
    {
        if($acc = $this->is_token())
        {
            $docs_id = $this->getDocsId();
            $content = Docs::where(array('id'=>$docs_id,'uid'=>$acc['uid'],'type'=>1,'is_status'=>1))->find('id AS docs_id,menu_id,title,content,share,update_time,create_time');
            if($content)
            {
                $this->msg(200,'ok',$content);
            }
            $this->msg(201,'not data');
        }
        $this->msg(206,'Unusual request.');
    }

    //公共分享内容
    public function getShareContent()
    {
        $docs_id = $this->getDocsId();
        $content = Docs::where(array('id'=>$docs_id,'share'=>1,'type'=>1,'is_status'=>1))->find('title,content,update_time,create_time');
        if($content)
        {
            $this->msg(200,'ok',$content);
        }
        $this->msg(201,'not data');
    }



    /**
     * 获取文档ID
     * @return int
     */
    public function getDocsId()
    {
        return (int) Data::get('docs_id',0,function($val)
        {
            if(empty($val))
            {
                $this->msg(205,'docs_id,不能为空');
            }
            return $val;
        });
    }


    /**
     * 异步处理
     */
    public function asynchronous()
    {
        $acc = $this->is_token();
        $_docs = new Docs();
        $docs_id = $this->getDocsId();
        switch (Data::get('key', null))
        {
            //删除
            case 'del':
                if($_docs->update(array('is_status'=>2),array('uid'=>$acc['uid'],'id'=>$docs_id)))
                {
                    $this->msg(200,'删除成功');
                }
                break;

            //是否分享
            case 'share':
                $status = (int) Data::get('status',null,function($val)
                {
                    if(empty($val))
                    {
                        $this->msg('205','抱歉,如果是分享类型,状态必须带上');
                    }

                    if($val !=1 || $val !=2)
                    {
                        $this->msg('205','您的状态值非法');
                    }
                });

                if($_docs->update(array('share'=>$status),array('uid'=>$acc['uid'],'id'=>$docs_id)))
                {
                    $this->msg(200,'状态更新成功');
                }
            break;

            //直接返回请求异常
            default:
                $this->msg(206,'您是异常的请求');
                break;
        }
    }





}