<?php

namespace Addons\Chat\Model;

use Home\Model\WeixinModel;

class WeixinAddonModel extends WeixinModel {
	var $config = array ();
	function reply($dataArr, $keywordArr = array()) {
		$this->config = getAddonConfig ( 'Chat' ); // 获取后台插件的配置参数
		
		$content = $this->_tuling ( $dataArr ['Content'] );
		if ($content) {
			exit ();
		}
		
		// 先尝试小九机器人 目前已不可用
		if (empty ( $content )) {
			// $content = $this->_xiaojo ( $dataArr ['Content'] );
		}
		
		// 再尝试小黄鸡
		if (empty ( $content )) {
			$content = $this->_simsim ( $dataArr ['Content'] );
		}
		
		// TODO 此处可继续增加其它API接口
		
		// 最后只能随机回复了
		if (empty ( $content )) {
			$content = $this->_rand ();
		}
		
		// 增加积分,每隔5分钟才加一次，5分钟内只记一次积分
		add_credit ( 'chat', 300 );
		
		$res = $this->replyText ( $content );
		return $res;
	}
	
	// 随机回复
	private function _rand() {
		$this->config ['rand_reply'] = array_map ( 'trim', explode ( "\n", $this->config ['rand_reply'] ) );
		$key = array_rand ( $this->config ['rand_reply'] );
		
		return $this->config ['rand_reply'] [$key];
	}
	
	// 小黄鸡
	private function _simsim($keyword) {
		$api_url = $this->config ['simsim_url'] . "?key=" . $this->config ['simsim_key'] . "&lc=ch&ft=0.0&text=" . $keyword;
		
		$result = file_get_contents ( $api_url );
		$result = json_decode ( $result, true );
		
		return $result ['response'];
	}
	
	// 小九机器人
	private function _xiaojo($keyword) {
		$curlPost ['chat'] = $keyword;
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $this->config ['i9_url'] );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $curlPost );
		$data = curl_exec ( $ch );
		curl_close ( $ch );
		
		return $data;
	}
	
	// 图灵机器人
	private function _tuling($keyword) {
		$api_url = $this->config ['tuling_url'] . "?key=" . $this->config ['tuling_key'] . "&info=" . $keyword;
		
		//$result = $this->httpGetRequest( $api_url );//可以先尝试此方法，看是否可以正常访问，若微信下可以正常回复可将本行取消注释，改为注释下行
		$result = $this->httpGetRequest( $api_url );//5iymt修复换成了curl函数访问。保证了微信环境下正常回复
		$result = json_decode ( $result, true );
		if ($_GET ['format'] == 'test') {
			dump ( '图灵机器人结果：' );
			dump ( $result );
		}
		if ($result ['code'] < 40008) {
			if ($result ['code'] > 40000 && ! empty ( $result ['text'] )) {
				$this->replyText ( '图灵机器人请你注意：' . $result ['text'] );
			} else {
				return false;
			}
		}
		switch ($result ['code']) {
			case '200000' :
				$text = $result ['text'] . ',<a href="' . $result ['url'] . '">点击进入</a>';
				$this->replyText ( $text );
				break;
			case '301000' :
				foreach ( $result ['list'] as $info ) {
					$articles [] = array (
							'Title' => $info ['name'],
							'Description' => $info ['author'],
							'PicUrl' => $info ['icon'],
							'Url' => $info ['detailurl'] 
					);
				}
				$this->replyNews ( $articles );
				break;
			case '302000' :
				foreach ( $result ['list'] as $info ) {
					$articles [] = array (
							'Title' => $info ['article'],
							'Description' => $info ['source'],
							'PicUrl' => $info ['icon'],
							'Url' => $info ['detailurl'] 
					);
				}
				$this->replyNews ( $articles );
				break;
			case '304000' :
				foreach ( $result ['list'] as $info ) {
					$articles [] = array (
							'Title' => $info ['name'],
							'Description' => $info ['count'],
							'PicUrl' => $info ['icon'],
							'Url' => $info ['detailurl'] 
					);
				}
				$this->replyNews ( $articles );
				break;
			case '305000' :
				foreach ( $result ['list'] as $info ) {
					$articles [] = array (
							'Title' => $info ['start'] . '--' . $info ['terminal'],
							'Description' => $info ['starttime'] . '--' . $info ['endtime'],
							'PicUrl' => $info ['icon'],
							'Url' => $info ['detailurl'] 
					);
				}
				$this->replyNews ( $articles );
				break;
			case '306000' :
				foreach ( $result ['list'] as $info ) {
					$articles [] = array (
							'Title' => $info ['flight'] . '--' . $info ['route'],
							'Description' => $info ['starttime'] . '--' . $info ['endtime'],
							'PicUrl' => $info ['icon'],
							'Url' => $info ['detailurl'] 
					);
				}
				$this->replyNews ( $articles );
				break;
			case '307000' :
				foreach ( $result ['list'] as $info ) {
					$articles [] = array (
							'Title' => $info ['name'],
							'Description' => $info ['info'],
							'PicUrl' => $info ['icon'],
							'Url' => $info ['detailurl'] 
					);
				}
				$this->replyNews ( $articles );
				break;
			case '308000' :
				foreach ( $result ['list'] as $info ) {
					$articles [] = array (
							'Title' => $info ['name'],
							'Description' => $info ['info'],
							'PicUrl' => $info ['icon'],
							'Url' => $info ['detailurl'] 
					);
				}
				$this->replyNews ( $articles );
				break;
			case '309000' :
				foreach ( $result ['list'] as $info ) {
					$articles [] = array (
							'Title' => $info ['name'],
							'Description' => '价格 : ' . $info ['price'] . ' 满意度 : ' . $info ['satisfaction'],
							'PicUrl' => $info ['icon'],
							'Url' => $info ['detailurl'] 
					);
				}
				$this->replyNews ( $articles );
				break;
			case '310000' :
				foreach ( $result ['list'] as $info ) {
					$articles [] = array (
							'Title' => $info ['number'],
							'Description' => $info ['info'],
							'PicUrl' => $info ['icon'],
							'Url' => $info ['detailurl'] 
					);
				}
				$this->replyNews ( $articles );
				break;
			case '311000' :
				foreach ( $result ['list'] as $info ) {
					$articles [] = array (
							'Title' => $info ['name'],
							'Description' => '价格 : ' . $info ['price'],
							'PicUrl' => $info ['icon'],
							'Url' => $info ['detailurl'] 
					);
				}
				$this->replyNews ( $articles );
				break;
			case '312000' :
				foreach ( $result ['list'] as $info ) {
					$articles [] = array (
							'Title' => $info ['name'],
							'Description' => '价格 : ' . $info ['price'],
							'PicUrl' => $info ['icon'],
							'Url' => $info ['detailurl'] 
					);
				}
				$this->replyNews ( $articles );
				break;
			default :
				if (empty ( $result ['text'] )) {
					return false;
				} else {
					$this->replyText ( $result ['text'] );
				}
		}
		
		return true;
	}
	private function httpGetRequest($url)
    {
        $headers = array(
            "User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1",
            "Content-type: text/html; charset=utf-8;"
        );
        $ch      = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $output = curl_exec($ch);
        curl_close($ch);
        if ($output === FALSE) {
            return "cURL Error: " . curl_error($ch);
        }
        return $output;
    }
}
