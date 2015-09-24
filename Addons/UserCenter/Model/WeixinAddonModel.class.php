<?php

namespace Addons\UserCenter\Model;

use Home\Model\WeixinModel;

/**
 * UserCenter的微信模型
 */
class WeixinAddonModel extends WeixinModel {
	var $config = array ();
	function reply($dataArr, $keywordArr = array()) {

		$param['openid']=get_openid();
		$param['token']=get_token();
		$url=addons_url('UserCenter://UserCenter/my',$param);

		$articles[0]=array(
				'Title'=>'个人中心',
				'Description'=>'点此进入',
				'PicUrl'=>'http://ipic-ipic.stor.sinaapp.com/original/2ddfdc417b03d7f43bbcb32eba079db0.jpg',
				'Url'=>$url
			);
		$this->replyNews($articles);

	}
	// 关注时的操作
	function subscribe($dataArr) {
		$info = D ( 'Common/Follow' )->init_follow ( $dataArr ['FromUserName'] );
		
		// 增加积分
		session ( 'mid', $info ['id'] );
		add_credit ( 'subscribe' );
	}
	// 取消关注公众号事件
	public function unsubscribe() {
		// 增加积分
		add_credit ( 'unsubscribe' );
	}
}
        	