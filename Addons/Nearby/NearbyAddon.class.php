<?php

namespace Addons\Nearby;
use Common\Controller\Addon;

/**
 * 附近搜索插件
 * @author 无名
 */

    class NearbyAddon extends Addon{

        public $info = array(
            'name'=>'Nearby',
            'title'=>'附近搜索',
            'description'=>'搜索附近商家的插件，使用本插件需申请百度地图API的秘钥http://lbsyun.baidu.com/apiconsole/key',
            'status'=>1,
            'author'=>'zhoufan',
            'version'=>'0.1',
            'has_adminlist'=>0,
            'type'=>1         
        );

	public function install() {
		$install_sql = './Addons/Nearby/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/Nearby/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }