<?php
namespace works\model;


class ProjectUser extends \works\model\BaseModel{

    //设置数据库名称
    public $_table = 'project_user';


    /**
     * 新增数据
     * @param $uid
     * @param $project_id
     * @return bool
     */
    public static function addData($uid,$project_id)
    {
        if($uid && $project_id)
        {
            $data['uid'] = $uid;
            $data['project_id'] = $project_id;
            $data['is_status'] = 1;
            $data['update_time'] = time();
            $data['create_time'] = time();
            return self::add($data);
        }
        return false;
    }




}