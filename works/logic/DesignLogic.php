<?php

namespace works\logic;

use works\model\UserAccount;

use works\model\Tag;
use works\model\WorkDesign;
use works\model\WorkTemplate;

class DesignLogic{


    /**
     * 编辑设计工作
     * @param $name
     * @param $template
     * @param $uid
     * @param $project_id
     * @param  $design_id = 0
     * @return array|bool
     */
    public static function edit($name,$template,$uid,$project_id,$design_id=0)
    {
        //数据验证
        $is_tag = self::getTagCheckList();
        $templateNum = count($template);
        if($templateNum < 1 )
        {
            return false;
        }
        //验证数据
        $is_check_edit = self::is_check_edit($template,$is_tag);
        if($is_check_edit === false)
        {
            return $is_check_edit;
        }

        $tmpNum = 0;
        $designModel = new WorkDesign();
        //开启事务
        $designModel->begin();
        //模板对象
        $templateModel = new WorkTemplate();
        if($design_id >= 1)
        {
            $isUp = $designModel->update(array('name'=>$name,'update_time'=>time()),array('id'=>$design_id,'uid'=>$uid,'is_status'=>1,'type'=>2,'project_id'=>$project_id));
            if($isUp){
                $tmpNum = self::update($template,$templateModel,$design_id);
            }
        }
        else
        {
            $tmpNum = self::add($uid,$name,$project_id,$designModel,$template,$templateModel);
        }

        //判断执行是否对等
        if($templateNum === $tmpNum)
        {
            return ($designModel->commit());
        }else{
            $designModel->rollback();
            return false;
        }

    }

    /**
     * 新增
     * @param $uid
     * @param $name
     * @param $project_id
     * @param $designModel
     * @param $template
     * @param $templateModel
     * @return int
     */
    public static function add($uid,$name,$project_id,$designModel,$template,$templateModel)
    {
        $_designData = [];
        //新增
        $_designData['type'] = 2;
        $_designData['name'] = $name;
        $_designData['uid'] = $uid;
        $_designData['project_id'] = $project_id;
        $_designData['is_status'] = 1;
        $_designData['update_time'] = time();
        $_designData['create_time'] = time();
        $_workdesignID = $designModel->add($_designData);
        //如果添加失败,回顾事务
        if(!$_workdesignID)
        {
            return $designModel->rollback();
        }

        $_templateData = array();

        foreach($template as $k=>$v)
        {
            unset($v['work_template_id']);
            $v['work_design_id'] = $_workdesignID;
            $v['is_status'] = 1;
            $v['update_time'] = time();
            $v['create_time'] = time();
            $_templateData[] = $v;
        }

        return (count($templateModel->addAll($_templateData)));
    }


    /**
     * 修改数据
     * @param $template
     * @param $templateModel
     * @param $design_id
     * @return int
     */
    public static function update($template,$templateModel,$design_id)
    {
        $time = time();
        $num = 0;
        foreach($template as $k=>$v)
        {
            $tmp = array();
            $tmp['works_name'] = $v['works_name'];
            $tmp['tag_id'] = $v['tag_id'];
            $tmp['tag_data'] = $v['tag_data'];
            $tmp['set_default'] = $v['set_default'];
            $tmp['relate_id'] = $v['relate_id'];
            $tmp['sole'] = $v['sole'];
            $tmp['sort'] = $v['sort'];
            $tmp['is_table_show'] = $v['is_table_show'];
            $tmp['update_time'] = $time;
            if(!empty($v['work_template_id']))
            {
                if($templateModel->update($tmp,array('id'=>$v['work_template_id'],'is_status'=>1,'work_design_id'=>$design_id)))
                {
                    $num+=1;
                }

            }else{
                $tmp['work_design_id'] = $design_id;
                $tmp['is_status'] = 1;
                $tmp['create_time'] = $time;
                if($templateModel->add($tmp))
                {
                    $num+=1;
                }
            }
        }
        return $num;
    }





    /**
     * 获取标签列表
     * @return array
     */
    public static function getTagCheckList()
    {
        $list = Tag::where(array('type'=>1,'is_status'=>1))->get('id,data');
        $tmp = array();
        foreach($list as $k=>$v)
        {
            $tmp['id'][] = $v['id'];
            $tmp['data'][] = $v['data'];
        }
        $tmp['list'] = $list;
        return $tmp;
    }

    /**
     * 判断数据和标签是否一致
     * @param $data
     * @param $list
     * @return bool
     */
    private static function is_tag_data($data,$list)
    {
        if($data && $list){
            foreach($list as $k=>$v)
            {
                if($v['id']==$data['tag_id'] && $v['data']==$data['tag_data'])
                {
                    return true;
                }
            }
            return false;
        }
    }


    /**
     * 编辑设计工作模板的数据验证
     * @param $template
     * @param $tag
     * @return array|bool
     */
    private static function is_check_edit($template,$tag)
    {
        foreach($template as $k=>$v)
        {
            if(!in_array($v['tag_id'],$tag['id']))
            {
                //ID不合法
                return array('code'=>1);
            }

            if(!in_array($v['tag_data'],$tag['data']))
            {
                //数据不合法
                return array('code'=>2);
            }

            //判断一致性
            $is_tag_data  = self::is_tag_data($v,$tag['list']);

            if($is_tag_data === false)
            {
                return array('code'=>3);
            }
        }
        return true;
    }


    /**
     * 获取列表数据
     * @param $project_id
     * @param $design_id
     * @return array|bool
     */
    public static function getTable($project_id,$design_id)
    {
        $designData = WorkDesign::where(" project_id='{$project_id}' AND id='{$design_id}' ")->find();
        if($designData)
        {

           $template  = WorkTemplate::where(" work_design_id='{$designData['id']}' ")->sort('sort',false)->get(" id as template_id,work_design_id,tag_id,tag_data,works_name,set_default,sole,sort,relate_id,is_status as status");
           if($template){
               return array(
                   'design'=>array(
                       'design_id'=>$designData['id'],
                       'name'=>$designData['name'],
                       'icon'=>$designData['icon']
                   ),
                   'template'=>$template
               );
           }
        }
        return false;

    }

    /**
     * 根据项目ID查询
     * @param $project_id
     */
    public static function findProject_idList($project_id=null)
    {
        if($project_id)
        {
            return WorkDesign::where(array('project_id'=>$project_id,'is_status'=>1,'type'=>2))->sort('id')->get('id AS design_id,project_id,name,icon,update_time,create_time');
        }
        return false;
    }


    /**
     * 多条件查询一条详情
     * @param $design_id
     * @param $uid
     * @param $project_id
     * @return bool
     */
    public static function findIdUidProject_id($design_id,$uid,$project_id)
    {
        if($design_id && $uid  && $project_id)
        {
            return WorkDesign::where(array('id'=>$design_id,'uid'=>$uid,'project_id'=>$project_id))->find();
        }
        return false;
    }

}