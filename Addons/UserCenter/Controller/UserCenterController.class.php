<?php

namespace Addons\UserCenter\Controller;

use Home\Controller\AddonsController;
use User\Api\UserApi;

class UserCenterController extends AddonsController {

	var $config;
	function _initialize() {
		parent::_initialize();
		
		$controller = strtolower ( _CONTROLLER );
		$action=strtolower(_ACTION);
		
		$res ['title'] = '功能配置';
		$res ['url'] = addons_url ( 'UserCenter://UserCenter/config' );
		$res ['class'] = $controller == 'usercenter' && $action=='config' ? 'current' : '';
		$nav [] = $res;
		
		$res ['title'] = '用户管理';
		$res ['url'] = addons_url ( 'UserCenter://UserCenter/lists' );
		$res ['class'] = $controller == 'usercenter' && $action=='lists'? 'current' : '';
		$nav [] = $res;
		
		
		
		$this->assign ( 'nav', $nav );
		
		$this->assign ( 'config', $config );
		// dump ( $config );
		// dump(get_token());
	}
	
	/**
	 * 显示微信用户列表数据
	 */
	public function lists() {
		$this->assign ( 'add_button', false );
		$this->assign ( 'del_button', false );
		$this->assign ( 'check_all', false );
		
		$model = $this->getModel ( 'follow' );
		
		parent::common_lists ( $model );
	}
	// 用户绑定
	public function edit() {
		$is_admin_edit = false;
		if(!empty($_REQUEST['id'])){
			$map['id'] = intval($_REQUEST['id']);
			$is_admin_edit = true;
			$msg = '编辑';
			$html = 'edit';
		}else{
			$msg = '绑定';
		    $openid = $map ['openid'] = get_openid ();
			$html = 'moblieForm';
		}
		$token = $map ['token'] = get_token ();
		$model = $this->getModel ( 'follow' );
		
		if (IS_POST) {
			$is_admin_edit && $_POST['status'] = 2;
			$Model = D ( parse_name ( get_table_name ( $model ['id'] ), 1 ) );
			// 获取模型的字段信息
			$Model = $this->checkAttr ( $Model, $model ['id'] );
			if ($Model->create () && $Model->where ( $map )->save ()) {
				//lastsql();exit;
				$url = '';				
				$bind_backurl = cookie('__forward__');
				$config = getAddonConfig ( 'UserCenter' );
				$jumpurl = $config['jumpurl'];
				
				if(!empty($bind_backurl)){
					$url = $bind_backurl;
					cookie('__forward__', NULL);
				}elseif(!empty($jumpurl)){
					$url = $jumpurl;
				}elseif(!$is_admin_edit){
					$url = addons_url ( 'WeiSite://WeiSite/index', $map );
				}

				$this->success ( $msg.'成功！',  $url); 
			} else {
				//lastsql();
				//dump($map);exit;
				$this->error ( $Model->getError () );
			}
		} else {
			$fields = get_model_attribute ( $model ['id'] );
			if(!$is_admin_edit){
				$fieldArr = array('nickname','sex','mobile'); //headimgurl
				foreach($fields[1] as $k=>$vo){
					if(!in_array($vo['name'], $fieldArr))
					   unset($fields[1][$k]);
				}
			}
			
			// 获取数据
			$data = M ( get_table_name ( $model ['id'] ) )->where ( $map )->find ();
			
		$token = get_token ();
		if (isset ( $data ['token'] ) && $token != $data ['token'] && defined ( 'ADDON_PUBLIC_PATH' )) {
			$this->error ( '非法访问！' );
		}			
			
			// 自动从微信接口获取用户信息
			empty($openid) || $info = getWeixinUserInfo ( $openid, $token );
			if (is_array ( $info )) {
				if (empty ( $data ['headimgurl'] ) && ! empty ( $info ['headimgurl'] )) {
					// 把微信头像转到WeiPHP的通用图片ID保存 TODO
					$data ['headimgurl'] = $info ['headimgurl'];
				}
				$data = array_merge ( $info, $data );
			}

			$this->assign ( 'fields', $fields );
			$this->assign ( 'data', $data );
			$this->meta_title = $msg.'用户消息';
			
			$this->assign('post_url', U('edit'));

			$this->display ($html);
		}
	
		
	}
	public function index() {
		$this->display('');
	}

	public function my() {

		// 输出用户基本信息
		$followInfo=M('follow')->where(array('token'=>get_token(),'openid'=>get_openid()))->find();
		//var_dump($followInfo);
		if(!$followInfo['headimgurl']){
			$followInfo['headimgurl']='http://idouly.com/wechat/Uploads/Headimgs/oOWE4tzFL9UjMBTiV2Wgmbaon390/1436673771.png';
		}
		if(!$followInfo['nickname']){
			$followInfo['nickname']='未填写昵称';
		}
		$followInfo['uid']=get_mid();
		$this->assign('followInfo',$followInfo);

		// 输出用户积分记录
		$creditData=M('credit_data')->where(array('token'=>get_token(),'uid'=>get_mid()))->select();
		foreach($creditData as $k=>&$v){
			$v['title']=M('credit_config')->where(array('name'=>$v['credit_name']))->getField('title');
		}
		$this->assign('creditData',$creditData);

		$this->display('userCenter');
	}

	// 用户绑定页
	public function userCenter() {
		// $signPackage=getSignPackage(get_token());
		// //var_dump($signPackage);die;
		// $this->assign('signPackage',$signPackage);
		// $this->assign('access_token',get_access_token());

		if(IS_POST){

			$picTypeArr=array('image/jpeg','image/png','image/gif');  // 允许上传的图片类型

			$fileArr=@$_FILES['myfile'];    // 上传的图片信息

			$picSize=1000000;          // 图片大小

			$upPath='./Uploads/Headimgs/'.get_openid();       // 图片上传路径

			if($_SERVER['REQUEST_METHOD'] == 'POST'){

			  if(!is_uploaded_file($fileArr['tmp_name'])){

			    echo "文件不存在";
			    exit;

			  }

			}

			if($fileArr['size'] > $picSize){

			  echo "上传图片超过了允许上传的图片大小";
			  exit;

			}

			if(!in_array($fileArr['type'], $picTypeArr)){

			  echo "上传类型不对";
			  exit;

			}

			if(!file_exists($upPath)){

			  mkdir($upPath, 0777, true);

			}

			$imageSize=getimagesize($fileArr['tmp_name']);    // 获取上传图片像素大小
			$pxSize=$imageSize[0].'*'.$imageSize[1];

			$picNameArr=explode('.', $fileArr['name']);
			$picName=$upPath.'/'.time().'.'.$picNameArr[1];

			if(file_exists($picName)){

			  echo "上传图片已经存在，请重新上传";
			  exit;

			}

			if(!move_uploaded_file($fileArr['tmp_name'], $picName)){

			  echo "上传图片失败";
			  exit;

			}else{

			 // echo "上传图片成功";
			  //echo "<img src='".$picName."'>";
			 // echo "图片的大小是".$pxSize;
			  // echo "<script>

			  // 	var add=document.getElementById('add');
			  // 	add.src='".$picName."';

			  // </script>";

			}

			//var_dump($signPackage);
			$followInfo=M('follow')->where(array('token'=>get_token(),'openid'=>get_openid()))->find();
			//var_dump($followInfo);
			$this->assign('followInfo',$followInfo);
			$this->assign('picName',$picName);
			$this->display('user_bind');
		}else{
			//var_dump($signPackage);
			$followInfo=M('follow')->where(array('token'=>get_token(),'openid'=>get_openid()))->find();
			//var_dump($followInfo);
			$this->assign('followInfo',$followInfo);
			if($followInfo['headimgurl']){
				$this->assign('picName',$followInfo['headimgurl']);
			}else{
				$this->assign('picName','http://idouly.com/wechat/Uploads/Headimgs/oOWE4tzFL9UjMBTiV2Wgmbaon390/1436673771.png');
			}
			$this->display('user_bind');
		}
		
	}

	// 保存用户信息
	public function saveUserInfo(){

		$config=getAddonConfig('UserCenter');


		$data['headimgurl']=I('headimgurl');
		$data['nickname']=I('nickname');
		$data['mobile']=I('mobile');
		//$data['sex']=I('sex');
		$data['mydesc']=I('mydesc');
		$data['status']=2;

		$res=M('follow')->where(array('token'=>get_token(),'openid'=>get_openid()))->save($data);
		if($res){
			$data['msg']="保存用户信息成功";
			if($config['jumpurl']){
				$data['jumpurl']=$config['jumpurl'];
			}else{
				$data['jumpurl']=U('my');
			}
			
		}else{
			$data['msg']="用户信息没有更改";
		}

		

		echo json_encode($data);
	}

	public function add_userinfo() {
		$this->display();
	}
	function config(){
		// 使用提示
		$normal_tips = '如需用户关注时提示先绑定，请进入‘欢迎语’插件按提示进行配置提示语';
		$this->assign ( 'normal_tips', $normal_tips );
		
		parent::config();
	}
}


