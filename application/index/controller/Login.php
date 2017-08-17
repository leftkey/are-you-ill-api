<?php
namespace app\index\controller;
use think\Db;
class Login{	
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
            $pwd=input('post.pwd');
            $model=db('user',[],false);    //实例化list表
            $res=$model->where("user_phone",$phone)->where("user_pwd",$pwd)->find();

            if($res!=null){
                //登录成功
                //更新登录时间
                $time=time();
                $updatetime=$model->where('user_id',$res['user_id'])->setField('user_logintime',$time);
                if($updatetime){
                    //返回去除密码的信息
                    unset($res["user_pwd"]);
                    $event->sendMsg(1,$res);
                }else{
                    $event->sendMsg(3,"服务器异常!");
                }
            }else{
                $event->sendMsg(4,"用户名或密码错误");
            }      
        }else{
            $event->sendMsg(2,"请使用正确的请求类型");
        } 
    }
    public function login(){
        return 'Login';
    }
}
