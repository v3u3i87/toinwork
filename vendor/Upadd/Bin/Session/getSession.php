<?php

namespace Upadd\Bin\Session;

use Upadd\Bin\UpaddException;

class getSession
{

    private static $_instanceof = null;

    //存放数据
    public $_data = array();

    protected static function getInstanceof()
    {
        if (!(self::$_instanceof instanceof self))
        {
            self::$_instanceof = new self();
        }
        return self::$_instanceof;
    }

    //私有克隆
    final protected function __clone() {}

//    //私有构造
    final protected function __construct(){}

    /**
     *
     * @return null|getSession
     */
    public static function init()
    {
        if(!isset($_SESSION['data']))
        {
            $_SESSION['data'] = self::getInstanceof();
        }
        return $_SESSION['data'];
    }


    /**
     * 获取
     * @param string $key
     * @return null|array
     */
    public function get($key=null)
    {
        if($this->is_key($key))
        {
            return $this->_data[$key];
        }
        return null;
    }

    /**
     * 返回所有
     * @return array
     */
    public function all()
    {
        return $this->_data;
    }

    /**
     * 设置参数
     * @param string $key
     * @param string|array $value
     * @return bool
     */
    public function set($key=null,$value=null)
    {
        if($key && $value)
        {
            if($this->_data[$key] = $value)
            {
                return true;
            }
        }
        return false;
    }

    /**
     * 新增数据
     * @param $key
     * @param $value
     * @return bool
     */
    public function add($key,$value)
    {
        if($this->is_key($key))
        {
            if(is_array($this->_data[$key]))
            {
                $this->_data[$key] = array_merge($this->_data[$key],$value);

            }else{
                throw new UpaddException('参数必须为数组类型,才可以使用add()方法');
            }
            return $this->_data[$key];
        }
        return false;
    }


    /**
     * 删除或是全部删除
     * @param string $key
     * @return bool
     */
    public function del($key = null)
    {
        if(empty($key))
        {
            return (session_destroy());
        }elseif(isset($this->_data[$key]))
        {
            unset($this->_data[$key]);
            return true;
        }
    }

    /**
     * 判断key是否存在
     * @param $key
     * @return bool
     */
    private function is_key($key)
    {
        return array_key_exists($key, $this->_data);
    }

}