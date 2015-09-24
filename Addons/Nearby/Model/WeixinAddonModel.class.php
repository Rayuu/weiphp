<?php
        	
namespace Addons\Nearby\Model;
use Home\Model\WeixinModel;
        	
/**
 * Nearby的微信模型
 */
class WeixinAddonModel extends WeixinModel{
	function reply($dataArr, $keywordArr = array()) {	

        $source=$this->http_get('http://api.pullword.com/get.php?source='.$keywordArr['suffix'].'&param1=1&param2=0');
        $source=trim($source);
        //获取图片
        $url='http://image.baidu.com/i?tn=baiduimagejson&ct=201326592&cl=2&lm=-1&st=-1&fm=result&fr=&sf=1&fmq=1349413075627_R&pv=&ic=0&nc=1&z=&se=1&showtab=0&fb=0&width=&height=&face=0&istype=2&word='.$source.'的美食&rn=2&pn=1';
        $imgs=$this->http_get($url);
        $imgs = mb_convert_encoding($imgs, "utf8", "gbk");
        $info=json_decode($imgs,true);
          $param ['keyword'] = $source;
          $url = addons_url ( 'Nearby://Nearby/index', $param );
          $articles [0] = array (
            'Title' => '附近的'.$source,
            'Description' => '请点击查看附近的'.$source,
            'PicUrl' => $info['data']['0']['objURL'],
            'Url' => $url
          );
         
          $res = $this->replyNews ( $articles );


	} 
	/**
	 * GET 请求
	 *
	 * @param string $url        	
	 */
	private function http_get($url) {
		$oCurl = curl_init ();
		if (stripos ( $url, "https://" ) !== FALSE) {
			curl_setopt ( $oCurl, CURLOPT_SSL_VERIFYPEER, FALSE );
			curl_setopt ( $oCurl, CURLOPT_SSL_VERIFYHOST, FALSE );
		}
		curl_setopt ( $oCurl, CURLOPT_URL, $url );
		curl_setopt ( $oCurl, CURLOPT_RETURNTRANSFER, 1 );
		$sContent = curl_exec ( $oCurl );
		$aStatus = curl_getinfo ( $oCurl );
		curl_close ( $oCurl );
		if (intval ( $aStatus ["http_code"] ) == 200) {
			return $sContent;
		} else {
			return false;
		}
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
        	