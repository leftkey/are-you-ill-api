<?php
namespace app\index\controller;
// use think\Db;
// use think\Loader;

class Regist{	
    /**********
    post请求
        @param phone 电话号码
        @param pwd 密码
    返回值
        @data msg
    **********/
	public function index(){	
        $event=controller('Common','controller');   //引入公共控制器
        // 设定默认值
   
        if (request()->isPost()){
   			$phone=input('post.phone');
   			$pwd=MD5(input('post.pwd'));
   			$time=time();
            $model=db('user',[],false);    //实例化list表
            $res=$model->where("user_phone",$phone)->find();
            if($res==null){
            	$result=db('user')->insert(["user_phone"=>$phone,"user_pwd"=>$pwd,"user_logintime"=>$time,"user_name"=>"用户".$phone]);
            	if($result){
            		$event->sendMsg(1,"注册成功!");
            	}else{
            		$event->sendMsg(4,"注册失败!");
            	}
            }else{
            	$event->sendMsg(3,"该手机号已经注册!");
            }      
        }else{
            $event->sendMsg(2,"请使用正确的请求类型");
        } 	
    }
}
