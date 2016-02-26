<?php

namespace works\logic;

use works\model\Works;
use works\model\WorksInfo;
use works\model\Tag;
use works\model\WorkTemplate;

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


    /**
     * 处理数据
     * @param $data
     * @param $uid
     * @return bool
     */
    public static function process_data($data,$uid)
    {

        $works_id = $data['works_id'];
        $design_id = $data['design_id'];
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
        if(empty($works_id) && $worksInfo->rollback())
        {
            return false;
        }

        //遍历创建工作信息
        foreach($getPush as $key=>$val)
        {
            $tmp = [];
            $tmp['works_id'] = $works_id;
            //设计ID
            $tmp['design_id'] = $design_id;
            //工作模板
            $tmp['template_id'] = $val['template_id'];
            $tmp['tag'] = $val['key'];
            //判断
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

            if(!$bool && $worksInfo->rollback())
            {
                return false;
            }

        }

        if($worksInfo->commit())
        {
            return true;
        }

        return false;
    }



    public static function get_design_id_list($design_id=null)
    {
        $list = Works::get_is_list_ok($design_id);
        $so = [];
        //遍历查询ID
        foreach($list['data'] as $k=>$v)
        {
            $so[] = $v['id'];
        }

        $data = WorksInfo::get_in_works_id_list($so);

        if($data)
        {
            $tmp = self::set_tag_val($data,$so);
            $templateSo = [];
            for($i=0;$i <=count($so);$i++)
            {
                $worksId = 'worksId_'.$so[$i];
                $worksInfo = $tmp[$worksId];
                foreach($worksInfo as $k=>$v)
                {
                    $templateSo[] = $v['template_id'];
                }
                //获取模板排序数据
                $templateData = WorkTemplate::in_where('id',$templateSo)->sort('sort',false)->get();
                p($templateData);


            }

        }

        return false;
    }

    /**
     * 设置标签数据
     * @param array $data
     * @return array
     */
    public static function set_tag_val($data=[],$so=[])
    {

        $setData = [];
        if(!empty($data))
        {
            foreach($so as $k=>$v)
            {
                $tmp = [];
                //归类
                foreach($data as $key=>$val)
                {
                    if($val['works_id'] == $v)
                    {
                        $tmp['works_info_id'] = $val['id'];
                        $tmp['template_id'] = $val['template_id'];
                        $tmp['tag'] = $val['tag'];
                        //判断k
                        if($val['tag'] === 'textarea')
                        {
                            //多行文本
                            $tmp['val'] = $val['textarea'];
                        }elseif($val['tag'] === 'editor'){
                            //编辑器
                            $tmp['val'] = $val['editor'];
                        }else{
                            //普通数据
                            $tmp['val'] = $val['val'];
                        }
                        $setData['worksId_'.$v][] = $tmp;
                    }

                }
            }

        }
        return $setData;
    }









}