<?php

namespace works\logic;

use works\model\UserAccount;

use works\model\Tag;
use works\model\WorkDesign;
use works\model\WorkTemplate;

class DesignLogic{


    public static function add($name,$template,$uid,$project_id)
    {
        //数据验证
        $is_tag = self::getTagCheckList();
        $templateNum = count($template);
        if($templateNum > 0 )
        {
            //验证数据
            $is_check_edit = self::is_check_edit($template,$is_tag);
            if($is_check_edit === true)
            {
               $WorkDesignModel = new WorkDesign();
                //开启事务
                $WorkDesignModel->begin();
                $_workdesignData['type'] = 2;
                $_workdesignData['name'] = $name;
                $_workdesignData['uid'] = $uid;
                $_workdesignData['project_id'] = $project_id;
                $_workdesignData['is_status'] = 1;
                $_workdesignData['update_time'] = time();
                $_workdesignData['create_time'] = time();
                //新增数据
                $_workdesignID = $WorkDesignModel->add($_workdesignData);
                if($_workdesignID)
                {
                    $tmpNum = 0;
                    $WorkTemplateModel = new WorkTemplate();
                    $WorkTemplateData = array();
                    foreach($template as $k=>$v)
                    {
                        unset($v['template_id']);
                        $v['work_design_id'] = $_workdesignID;
                        $v['is_status'] = 1;
                        $v['update_time'] = time();
                        $v['create_time'] = time();
                        $WorkTemplateData[] = $v;
                    }

                    foreach($WorkTemplateData as $k=>$v)
                    {

                        if($WorkTemplateModel->add($v))
                        {
                            $tmpNum+=1;
                        }
                    }
                    //判断执行是否对等
                    if($templateNum===$tmpNum){
                        $WorkDesignModel->commit();
                        return true;
                    }else{
                        $WorkDesignModel->rollback();
                        return false;
                    }
                }else{
                    $WorkDesignModel->rollback();
                    return false;
                }
                
            }else{
                //返回验证失败的状态码
                return $is_check_edit;
            }


        }

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
    private static function is_tag_data($data,$list){
        if($data && $list){
            foreach($list as $k=>$v){
                if($v['id']==$data['tag_id'] && $v['data']==$data['tag_data']){
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


}