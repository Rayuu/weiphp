<?php
        	
namespace Addons\LostAndFound\Model;
use Home\Model\WeixinModel;
        	
/**
 * LostAndFound的微信模型
 */
class WeixinAddonModel extends WeixinModel{
	function reply($dataArr, $keywordArr = array()) {
		$config = getAddonConfig ( 'LostAndFound' ); // 获取后台插件的配置参数	
		$param['token']=get_token();
		$param['openid']=get_openid();
		$url=addons_url("LostAndFound://LostAndFound/index",$param);
		$articles[0]=array(
			'Title'=>$config['title'],
			'Description'=>$config['desc'],
			'PicUrl'=>get_cover_url($config['img']),
			'Url'=>$url
		);
		$this->replyNews($articles);

	} 

	// 关注公众号事件
	public function subscribe() {
		return true;
	}
	
	// 取消关注公众号事件
	public function unsubscribe() {
		return true;
	}
	
	// 扫描带参数二维码事件
	public function scan() {
		return true;
	}
	
	// 上报地理位置事件
	public function location() {
		return true;
	}
	
	// 自定义菜单事件
	public function click() {
		return true;
	}	
}
        	