<?php
        	
namespace Addons\MoonEating\Model;
use Home\Model\WeixinModel;
        	
/**
 * MoonEating的微信模型
 */
class WeixinAddonModel extends WeixinModel{
	function reply($dataArr, $keywordArr = array()) {
		$config = getAddonConfig ( 'MoonEating' ); // 获取后台插件的配置参数	
		//dump($config);

		//$url = addons_url( 'Dreammore://Dreammore/index', array('openid'=>get_openid(), 'token'=>get_token()) );
		//$this->replyText( $config['title'] );
		$param['token'] = get_token();
		$param['openid'] = get_openid();
		$picurl = get_cover_url($config['cover']);
		$url = addons_url('MoonEating://MoonEating/index',$param);

		$articles[0] = $arrayName = array(
			'Title' =>$config['title'] ,
			'Description'=>$config['desc'],
			'PicUrl' => $picurl,
			'Url' =>$url
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
        	