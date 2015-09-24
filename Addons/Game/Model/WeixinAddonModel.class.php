<?php
        	
namespace Addons\Game\Model;
use Home\Model\WeixinModel;
        	
/**
 * Game的微信模型
 */
class WeixinAddonModel extends WeixinModel{
	function reply($dataArr, $keywordArr = array()) {
		$config = getAddonConfig ( 'Game' ); // 获取后台插件的配置参数	
		//dump($config);
		//$map['token']=get_token();
		$list=M('game')->where($map)->order('id desc')->select();
		if(!$list){
			$this->replyText('还没有游戏哦~');
		}
		foreach($list as $k=>$vo){
			if($k>7)
				continue;
			$articles[]=array(
				'Title'=>$vo['title'],
				'Description'=>$vo['desc'],
				'PicUrl'=>get_cover_url($vo['cover']),
				'Url'=>$vo['url']
			);
		}
		$count=count($articles);
		$articles[$count]=array(
				'Title'=>'点此试玩更多微信小游戏',
				'Description'=>'',
				'PicUrl'=>'',
				'Url'=>'http://2014.demoidoubi.sinaapp.com/game/index.html'
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
        	