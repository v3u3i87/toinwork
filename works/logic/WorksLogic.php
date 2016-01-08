<?php

namespace works\logic;

use works\model\Works;
use works\model\WorksInfo;
use works\model\Tag;

class WorksLogic{


    /**
     * 验证字段
     * @param $data
     * @return bool
     */
    public static function VerifyField($data)
    {
        if(is_array($data))
        {
            if(!isset($data['works_id']))
            {
                return false;
            }
            if(!isset($data['design_id']))
            {
                return false;
            }

            if(!isset($data['template_id']))
            {
                return false;
            }

            if(isset($data['push']))
            {
                $tag = Tag::getSysField();
                foreach($data['push'] as $k=>$v)
                {
                    if(!isset($v['works_info_id']))
                    {
                        return false;
                    }

                    if(!isset($v['key']))
                    {
                        return false;
                    }else{
                        if(!in_array($v['key'],$tag))
                        {
                            return false;
                        }
                    }

                    if(!isset($v['val']))
                    {
                        return false;
                    }
                }

            }else{
                return false;
            }
            return true;
        }
        return false;
    }


    public static function process_data($data,$uid)
    {

        $works_id = $data['works_id'];
        $design_id = $data['design_id'];
        $template_id = $data['template_id'];
        $getPush = $data['push'];
        $worksInfo = new WorksInfo();
        $worksInfo->begin();
        if(empty($works_id))
        {
            $works_id = Works::add(array(
                'uid'=>$uid,
                'design_id'=>$design_id,
                'is_status'=>1,
                'update_time'=>time(),
                'create_time'=>time(),
            ));
        }


        //works确认创建失败
        if(empty($works_id)){
            $worksInfo->rollback();
            return false;
        }

        //遍历创建工作信息
        foreach($getPush as $key=>$val)
        {
            $tmp = [];
            $tmp['works_id'] = $works_id;
            $tmp['design_id'] = $design_id;
            $tmp['template_id'] = $template_id;
            $tmp['tag'] = $val['key'];

            if($val['key'] === 'textarea'){
                //多行文本
                $tmp['doc'] = $val['val'];
            }elseif($val['key'] === 'editor'){
                //编辑器
                $tmp['editor'] = $val['val'];
            }else{
                //普通数据
                $tmp['val'] = $val['val'];
            }

            if(empty($val['works_info_id']))
            {
                $tmp['update_time'] = time();
                $tmp['create_time'] = time();
                $bool = $worksInfo->add($tmp);
            }else{
                $tmp['update_time'] = time();
                $bool = $worksInfo->save($tmp,array('id'=>$val['works_info_id']));
            }

            if(!$bool)
            {
                $worksInfo->rollback();
                return false;
            }
        }

        $worksInfo->commit();
        return true;
    }







}