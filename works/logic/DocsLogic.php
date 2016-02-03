<?php
namespace works\logic;

class DocsLogic{


    /**
     * 菜单递归
     * @param $data
     * @param int $fid
     * @return array
     */
    public static function Menutree($data,$fid=0){
        if(empty($data))
        {
            return $data;
        }
        $tree = array();
        $data = self::two_array_sort($data,'sort');
        foreach ($data as $k => $v)
        {
            if ($v['fid'] == $fid)
            {
                $tree[] = $v;
            }
        }
        if (empty($tree)) return null;
        foreach ($tree as $k => $v)
        {
            $sub = self::Menutree($data, $v['menu_id']);
            $tree[$k]['sub'] = self::two_array_sort($sub,'sort');
            if(!isset($tree[$k]['sub']))
            {
                unset($tree[$k]['sub']);
            }
            unset($tree[$k]['fid']);
        }
        return $tree;
    }


    /**
     * 排序
     * @param $data
     * @param $key
     * @param string $type
     * @return array|null
     */
    public static function two_array_sort($data, $key, $type = 'asc')
    {
        if($data && $key)
        {
            $keysvalue = $new_array = array();
            foreach ($data as $k => $v)
            {
                $keysvalue[$k] = $v[$key];
            }
            if ($type == 'asc') {
                //对数组进行排序并保持索引关系
                asort($keysvalue);
            } else {
                //对数组进行逆向排序并保持索引关系
                arsort($keysvalue);
            }
            reset($keysvalue);
            foreach ($keysvalue as $k => $v) {
                $new_array[] = $data[$k];
            }

            return $new_array;
        }
        return null;
    }



}
