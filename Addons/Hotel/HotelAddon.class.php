<?php



namespace Addons\Hotel;

use Common\Controller\Addon;



/**

 * 微酒店插件

 * @author 淡然

 */



    class HotelAddon extends Addon{



        public $info = array(

            'name'=>'Hotel',

            'title'=>'微酒店',

            'description'=>'酒店预定',

            'status'=>0,

            'author'=>'淡然',

            'version'=>'1',

            'has_adminlist'=>1,

            'type'=>1         

        );



	public function install() {

		$install_sql = './Addons/Hotel/install.sql';

		if (file_exists ( $install_sql )) {

			execute_sql_file ( $install_sql );

		}

		return true;

	}

	public function uninstall() {

		$uninstall_sql = './Addons/Hotel/uninstall.sql';

		if (file_exists ( $uninstall_sql )) {

			execute_sql_file ( $uninstall_sql );

		}

		return true;

	}



        //实现的weixin钩子方法

        public function weixin($param){



        }



    }