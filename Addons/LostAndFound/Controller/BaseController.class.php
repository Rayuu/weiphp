<?php

namespace Addons\LostAndFound\Controller;

use Home\Controller\AddonsController;

class BaseController extends AddonsController {
	function _initialize(){
		parent::_initialize();
		$controller=strtolower(_CONTROLLER);
		
		$res['title']='失物招领配置';
		$res['url']=addons_url('LostAndFound://LostAndFound/config');
		$res['class']=$controller=='lostandfound'?'current':'';
		$nav[]=$res;
		
		$res['title']='用户管理';
		$res['url']=addons_url('LostAndFound://user/lists');
		$res['class']=$controller=='user'?'current':'';
		$nav[]=$res;
		
		$res['title']='物品管理';
		$res['url']=addons_url('LostAndFound://Things/lists');
		$res['class']=$controller=='things'?'current':'';
		$nav[]=$res;
		
		$this->assign('nav',$nav);
		
		$config=getAddonConfig('LostAndFound');
		$config['img']=get_cover_url($config['img']);
		$this->assign('config',$config);
	}
}
