<?php

namespace Addons\MoonEating\Controller;
use Home\Controller\AddonsController;

class MoonEatingController extends AddonsController{
    public function _initialize(){

		$controller=strtolower(_CONTROLLER);
		$action=strtolower(_ACTION);

		$res['title']='插件配置';
		$res['url']=addons_url('MoonEating://MoonEating/config');
		$res['class']=$controller=='mooneating' && $action=='config'?'current':'';
		$nav[]=$res;

		parent::_initialize();
	}

    public function index(){
    	$this->display();
    }
}
