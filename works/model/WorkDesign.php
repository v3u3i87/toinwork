<?php
namespace works\model;


class WorkDesign extends \works\model\BaseModel{

    //设置数据库名称
    protected $_table = 'work_design';

    protected $_primaryKey = 'id';


    /**
     * 根据ID获取一条
     * @param null $design_id
     * @return mixed
     */
    public static function pkId($design_id=null)
    {
        return self::where(['id'=>$design_id,'is_status'=>1])->find();
    }


    /**
     * @param $projectId
     * @return mixed
     */
    public static function projectIdByCount($projectId)
    {
        return self::where(array('project_id'=>$projectId,'is_status'=>1))->getTotal();
    }
    


}