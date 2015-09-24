<?php

namespace Addons\Game;
use Common\Controller\Addon;

/**
 * 游戏插件
 * @author 艾逗笔
 */

    class GameAddon extends Addon{

        public $info = array(
            'name'=>'Game',
            'title'=>'游戏',
            'description'=>'微信小游戏插件，汇集各种好玩的小游戏，给你带来一段愉快的休闲娱乐时光~',
            'status'=>1,
            'author'=>'艾逗笔',
            'version'=>'1.0',
            'has_adminlist'=>1,
            'type'=>1         
        );

	public function install() {
		$install_sql = './Addons/Game/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/Game/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }