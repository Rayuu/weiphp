<?php

namespace Addons\LostAndFound\Controller;

use Addons\LostAndFound\Controller\BaseController;

class ThingsController extends BaseController {
	var $model;
	function _initialize(){
		$this->model=$this->getModel('laf_things');
		parent::_initialize();
	}
	
	//通用插件的列表模型
	public function lists(){
		$map['token']=get_token();
		session('common_condition',$map);
		
		parent::common_lists($this->model);
	}
	
	//通用插件的编辑模型
	public function edit(){
		parent::common_edit($this->model);
	}
	
	//通用插件的增加模型
	public function add(){
		parent::common_add($this->model);
	}
	
	//通用插件的删除模型
	public function del(){
		parent::common_del($this->model);
	}
	//我丢东西了发布页面
	function lostThings(){
		$map['uid']=$this->mid;
		$user=M('laf_user')->where($map)->find();
		
		if(IS_POST){
			$data['title']=I('post.title');
			$data['type']='证件类型';
			$data['address']=I('post.address');
			$data['pic']='';
			$data['info']=I('post.info');
			$data['state']=I('post.state');
			
			$data['username']=I('post.username');
			$data['phone']=I('post.phone');
			
			if($user){
				$res=M('laf_user')->where($map)->save($data);
			}else{
				$data['token']=get_token();
				$data['uid']=$this->mid;
				$data['cTime']=time();
				$data['username']=I('post.username');
				$data['phone']=I('post.phone');
				$data['address']='武汉大学';
				$res=M('laf_user')->add($data);
			}
			
			$data['token']=get_token();
			$data['uid']=$this->mid;
			$data['cTime']=time();
			
			$res=M('laf_things')->add($data);
			redirect(addons_url('LostAndFound://LostAndFound/index'));
		}
		
		$this->assign('user',$user);
		$this->display();
	}
	
	//我捡到东西了发布页面
	function findThings(){
		$map['uid']=$this->mid;
		$user=M('laf_user')->where($map)->find();
		
		if(IS_POST){
			$data['title']=I('post.title');
			$data['type']='证件类型';
			$data['address']=I('post.address');
			$data['pic']='';
			$data['info']=I('post.info');
			$data['state']=I('post.state');
			
			$data['username']=I('post.username');
			$data['phone']=I('post.phone');
			
			if($user){
				$res=M('laf_user')->where($map)->save($data);
			}else{
				$data['token']=get_token();
				$data['uid']=$this->mid;
				$data['cTime']=time();
				$data['username']=I('post.username');
				$data['phone']=I('post.phone');
				$data['address']='武汉大学';
				$res=M('laf_user')->add($data);
			}
			
			$data['token']=get_token();
			$data['uid']=$this->mid;
			$data['cTime']=time();
			
			$res=M('laf_things')->add($data);
			redirect(addons_url('LostAndFound://LostAndFound/index'));
		}
		
		$this->assign('user',$user);
		$this->display();
	}
	
	//寻物信息展示页面
	function showLostThings(){
		$map['token']=get_token();
		$map['state']=0;
		$list=M('laf_things')->where($map)->order('id desc')->select();
		$this->assign('list',$list);
		$this->display();
	}
	
	//招领信息展示页面
	function showFoundThings(){
		$map['token']=get_token();
		$map['state']=1;
		$list=M('laf_things')->where($map)->order('id desc')->select();
		$this->assign('list',$list);
		$this->display();
	}
	
}
