<?php
namespace works\action\api;

use Config;
use Data;
use works\action\BaseAction;
use works\logic\UserLogic;
use works\model\UserInfo;

use Upadd\Bin\Tool\Upload;

class LoadAction extends BaseAction{


    /**
     * 上传主函数
     */
    public function main(){
        $accInfo = Data::get('token',null,function($val)
        {
            if(empty($val))
            {
                $this->msg(205,'抱歉,token不能为空');
            }
            $val = UserLogic::verifyTokenExpired($val);
            if($val){
                return $val;
            }
            $this->msg(205,'过期或是不存在');
        });

        $key = Data::get('key',null,function($val)
        {
            if(empty($val)){
                $this->msg(205,'缺少key参数');
            }
            if(!in_array($val,Config::get('tag@load_type')))
            {
                $this->msg(205,'key参数不正确');
            }
            return $val;
        });

        $file = Data::get('file',null,function($val) use ($key,$accInfo)
        {
            if(empty($val)){
                $this->msg(205,'上传文件参数为file');
            }
            //判断上传类型是否存在
            if(array_key_exists('type',$val))
            {
                $path = 'data/upload/'.$key;
                $upload = new Upload($val,6120,array('png','jpg','jpeg'),host().$path);
                return $path.'/'.$upload->getpath();
            }
            $this->msg(205,'上传失败,数据异常');
        });

        $this->msg(200,$file);
    }





}