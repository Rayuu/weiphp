<?php

namespace Addons\Game\Controller;
use Home\Controller\AddonsController;

class GameController extends AddonsController{

	public function lists(){

		$normal_tips="<a href='http://idouly.com/wenda/?/article/33' target='_blank'>插件更新说明</a>";
		$this->assign('normal_tips',$normal_tips);
		parent::lists();

	}

}
