<?php

namespace Addons\Jianzhi;
use Common\Controller\Addon;

/**
 * 兼职插件
 * @author 艾逗笔
 */

    class JianzhiAddon extends Addon{

        public $info = array(
            'name'=>'Jianzhi',
            'title'=>'兼职',
            'description'=>'微信兼职信息平台',
            'status'=>1,
            'author'=>'艾逗笔',
            'version'=>'1.0',
            'has_adminlist'=>1,
            'type'=>1         
        );

	public function install() {
		$install_sql = './Addons/Jianzhi/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/Jianzhi/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }