<?php

namespace Addons\LostAndFound;
use Common\Controller\Addon;

/**
 * 失物招领插件
 * @author 艾逗笔
 */

    class LostAndFoundAddon extends Addon{

        public $info = array(
            'name'=>'LostAndFound',
            'title'=>'失物招领',
            'description'=>'微信失物招领插件',
            'status'=>1,
            'author'=>'艾逗笔',
            'version'=>'1.0',
            'has_adminlist'=>0,
            'type'=>1         
        );

	public function install() {
		$install_sql = './Addons/LostAndFound/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/LostAndFound/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }