<?php
namespace app\index\controller;
// use think\Db;
// use think\Loader;

class Drugs{	
    /**********
    post请求
        @param start 起始数
        @param num 每页条数
        @param class 科目
        @param keyword 关键字 

    返回值
        @data list_class 科目
        @data list_des 描述
        @data list_id id
        @data list_img 图片路径
        @data list_name 名称
        @data list_oldprice 原价
        @data list_price 现价
    **********/
	public function index(){	
        $event=controller('Common','controller');   //引入公共控制器
        // 设定默认值
        $start=0;   //从第0开始
        $num=0;    //每次0条
        if (request()->isPost()){
            // var_dump(input('post.'));
            $start=input('post.start');
            $num=input('post.num');
            $class=input('post.class');
            $keyword=input('post.keyword');
            $model=db('list',[],false);    //实例化list表
            $arr=[];
            //是否分类查询
            $list_class=$class!=""?"list_class='".$class."'":"list_class=list_class";
            //综合查询
            $arr=$model->limit($start,$num)->where('list_name','like','%'.$keyword.'%')->where($list_class)->select();
        
            
            $event->sendMsg(1,$arr);
        }else{
            $event->sendMsg(2,"请使用正确的请求类型");
        } 	
    }
    public function detail(){
        $event=controller('Common','controller');   //引入公共控制器
        // 设定默认值
        if (request()->isPost() && isset($_POST['drug_id'])){
            // var_dump(input('post.'));
            $drug_id=input('post.drug_id');
          
            $model=db('detail',[],false);    //实例化detail表
            $modelList=db('list',[],false);    //实例化list表
            $arr=[];
          
            //综合查询
            $arr1=$model->where("list_id",$drug_id)->select();        
            $arr2=$modelList->where("list_id",$drug_id)->select();        
            $event->sendMsg(1,array_merge($arr1[0],$arr2[0]));
        }else{
            $event->sendMsg(2,"请使用正确的请求类型");
        }
    }

    // public function home(){
    //     $event=controller('Common','controller');   //引入公共控制器
    //     if(isset($_GET['classname'])){
    //         $classname=input("get.classname");
    //         $model=db('list',[],false);    //实例化list表
    //         $arr=[];
    //         $arr=$model->limit($start,$num)->where($list_class)->select();
    //         $event->sendMsg(1,$arr);
    //     }else{
    //         $event->sendMsg(2,"查无此科目!");
    //     }
    // }
}
