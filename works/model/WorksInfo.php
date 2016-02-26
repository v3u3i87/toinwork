<?php
namespace works\model;


use works\model\BaseModel;

class WorksInfo extends BaseModel{

    protected $_table = 'works_info';

    protected $_primaryKey = 'id';


    /**
     * 根据works_id查询列表
     * @param null $so
     * @return mixed
     */
    public static function get_in_works_id_list($so=null)
    {
        return self::in_where('works_id',$so)->get();
    }



}