<?php

namespace Addons\LostAndFound\Controller;
use Home\Controller\AddonsController;

class LostAndFoundController extends BaseController{
	//失物招领配置
	
	
	//失物招领展示首页(未绑定微信账号)
	function show(){
		$config=getAddonConfig('LostAndFound');
		$config['img']=get_cover_url($config['img']);
		$this->assign('config',$config);
		
		$tpl='show';
		$map['uid']=$this->mid;
		$info=M('laf_user')->where($map)->find();
		if($info){
			$tpl='index';
			$this->assign('info',$info);
		}
		$this->display($tpl);
	}
	
	//个人资料填写页面
	function myinfo(){
		$map['uid']=$this->mid;
		$info=M('laf_user')->where($map)->find();
		if(IS_POST){
			$data['username']=I('post.username');
			$data['phone']=I('post.phone');
			$data['address']=I('post.address');
			if($info){
				$res=M('laf_user')->where($map)->save($data);
			}else{
				$data['token']=get_token();
				$data['uid']=$this->mid;
				$data['cTime']=time();
				$res=M('laf_user')->add($data);
			}
			redirect(addons_url('LostAndFound://LostAndFound/index'));
		}
		$this->assign('info',$info);
		$this->display();
	}
	
	//失物招领展示首页（绑定了微信号）
	function index(){
		$map['uid']=$this->mid;
		$info=M('laf_user')->where($map)->find();
		$list=M('laf_things')->where($map)->order('id desc')->select();

		$this->assign('list',$list);
		$this->assign('info',$info);
		$this->display();
	}
	
	//失物招领信息发布说明
	function introduction(){
		$this->display();
	}
	
	//校园招领点
	function area(){
		$this->display();
	}
			

}
