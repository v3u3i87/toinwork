<?php
namespace works\model;


class Works extends \works\model\BaseModel{

    //设置数据库名称
    protected $_table = 'works';

    protected $_primaryKey = 'id';

    /**
     * 获取工作列表,根据列表查询
     * @param $design_id
     * @return mixed
     */
    public static function get_is_list_ok($design_id)
    {
        return self::where(array('design_id'=>$design_id,'is_status'=>1))->sort('id')->page()->get();
    }




}