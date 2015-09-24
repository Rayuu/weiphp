<?php

namespace Addons\LostAndFound\Controller;

use Addons\LostAndFound\Controller\BaseController;

class UserController extends BaseController {
	var $model;
	function _initialize(){
		$this->model=$this->getModel('laf_user');
		parent::_initialize();
	}
	//通用插件列表模型
	public function lists(){
		$map['token']=get_token();
		session('common_condition',$map);
		parent::common_lists($this->model);
	}
	
	//通用插件编辑模型
	public function edit(){
		parent::common_edit($this->model);
	}
	
	//通用插件增加模型
	public function add(){
		parent::common_add($this->model);
	}
	
	//通用插件删除模型
	public function del(){
		parent::common_del($this->model);
	}
}
