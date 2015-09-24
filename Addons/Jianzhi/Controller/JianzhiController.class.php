<?php

namespace Addons\Jianzhi\Controller;
use Home\Controller\AddonsController;

class JianzhiController extends AddonsController{

	public function lists(){
		$normal_tips="<a href='http://idouly.com/wenda/?/article/34' target='_blank'>插件更新说明</a>";
		$this->assign('normal_tips',$normal_tips);
		parent::lists();
	}

	function index(){
		$map['token']=get_token();
		$list=M('jianzhi')->where($map)->order('id desc')->select();
		foreach($list as $k=>$vo){
			$map_j['j_id']=$vo['id'];
			$map_j['token']=get_token();
			$list[$k]['comment_num']=M('jianzhi_comment')->where($map_j)->count();	
		}
		$this->assign('list',$list);
	
		$this->display();
	}
	
	function view(){
		$map_j['token']=$map['token']=get_token();
		$map_j['j_id']=$map['id']=I('id');
	//	$this->assign('j_id',I('id'));
		$j_info=M('jianzhi')->where($map)->find();
		$this->assign('j_info',$j_info);
		
		if(IS_POST){
			$data['comment']=I('comment');
			$data['token']=get_token();
			$data['openid']=get_openid();
			$data['cTime']=time();
			$data['j_id']=I('j_id');
			$res=M('jianzhi_comment')->add($data);
			if($res){
				redirect(addons_url('Jianzhi://Jianzhi/view',array('id'=>$data['j_id'])));
			}else{	
				$this->error('评论失败');
			}		
		}
		
		$comment=M('jianzhi_comment')->where($map_j)->order('id desc')->select();
		$comment_num=M('jianzhi_comment')->where($map_j)->count();
		$this->assign('comment_num',$comment_num);
		$this->assign('comment',$comment);
		$this->display();
	}

	function fabu(){
	//	$param['token']=$map['token']=get_token();
	//	$param['openid']=get_openid();
		$user=getWeixinUserInfo(get_openid(),get_token());
		//var_dump($user);
		$this->assign('user',$user);
		
		if(IS_POST){
			$data['title']=I('title');
			$data['content']=I('content');
			$data['contact']=I('contact');
			
			$data['cTime']=time();
			$data['token']=get_token();
			$data['openid']=get_openid();
			
			$res=M('Jianzhi')->add($data);
			
			if($res){
				$jump_url=addons_url('Jianzhi://Jianzhi/index');
				redirect($jump_url);
			}else{
				$this->error('发布失败');
			}
		}
		$this->display();
	}
}
