<?php
namespace app\index\controller; //文件路径决定
use think\Db;
header("Content-type:text/html;charset=utf-8");
class Common{
	public function sendMsg($code,$data){	
    	header('Access-Control-Allow-Origin: *');
        $result['code'] = $code;
        $result['data'] = $data;
        // 可以统一添加跨域的头文件信息  不需要写多次
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }
}
