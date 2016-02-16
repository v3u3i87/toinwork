<?php
namespace works\model;


class ProjectUser extends \works\model\BaseModel{

    //设置数据库名称
    protected $_table = 'project_user';

    protected $_primaryKey = 'id';

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

    /**
     * 根据会员获取项目
     * @param null $uid
     * @return mixed || array
     */
    public static function byUserList($uid=null)
    {
        return self::where(array('uid'=>$uid,'is_status'=>1))->get(array('project_id'));
    }



}