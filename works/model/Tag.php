<?php
namespace works\model;


class Tag extends \works\model\BaseModel{

    //设置数据库名称
    public $_table = 'tag';


    /**
     * 编辑标签 - 新增,修改
     * @param $data
     * @param $uid
     * @param $project_id
     * @return bool
     */
    public static function edit($data,$type_id,$tag_id)
    {
        if($data && $type_id)
        {
            if ($tag_id)
            {
                $data['update_time'] = time();
                return self::save($data,array('id'=>$tag_id,'type'=>$type_id));
            } else {
                $data['type'] = $type_id;
                $data['status'] = 1;
                $data['update_time'] = time();
                $data['create_time'] = time();
                return self::add($data);
            }
        }
        return false;
    }

    /**
     * 获取标签字段
     * @return mixed
     */
    public static function getSysField(){
        $data = self::where(array('type'=>1,'status'=>1))->get('data');
        if($data) {
            $tmp = [];
            foreach ($data as $k => $v) {
                $tmp[] = $v['data'];
            }
            return $tmp;
        }
        return false;
    }



}