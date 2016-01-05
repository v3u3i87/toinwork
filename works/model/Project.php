<?php
namespace works\model;


class Project extends \works\model\BaseModel{

    //设置数据库名称
    public $_table = 'project';


    /**
     * 编辑项目 - 新增,修改
     * @param $data
     * @param $uid
     * @param $project_id
     * @return bool
     */
    public static function edit($data,$uid,$project_id)
    {
        if($data && $uid)
        {
            if ($project_id)
            {
                $data['update_time'] = time();
                return self::save($data,array('id'=>$project_id,'uid'=>$uid));
            } else {
                $data['uid'] = $uid;
                $data['type'] = 2;
                $data['is_status'] = 1;
                $data['update_time'] = time();
                $data['create_time'] = time();
                return self::add($data);
            }
        }
        return false;
    }



}