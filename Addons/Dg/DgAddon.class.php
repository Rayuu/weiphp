<?php

namespace Addons\Dg;
use Common\Controller\Addon;

/**
 * 点歌插件
 * @author NPC
 */

    class DgAddon extends Addon{

        public $info = array(
            'name'=>'Dg',
            'title'=>'点歌',
            'description'=>'如果音乐资源足够好，那将秒杀一切手机上在线听歌软件也不是没有可能的',
            'status'=>1,
            'author'=>'NPC',
            'version'=>'0.1',
            'has_adminlist'=>1,
            'type'=>1         
        );

	public function install() {
		$install_sql = './Addons/Dg/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/Dg/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }