<?php
require_once("./Resources/phpMailer/function.php");
class EmailAction extends Action{
	public function index(){
		$message = "你是不是走错了，<br>请进入<a href='http://www.jesslu'>捷搜索首页</a>";
		if(!empty($_GET['state'])){
			$obj = D("User");
			$id = trim($this->_get("jssid"));
			$falseTm = date("Y-m-d H:i:s",strtotime("- 2 hours"));
			$rs = $obj->where("state=2 and id={$id} and tm>'{$falseTm}'")->find();
			if($rs){
				if($this->_get("state")==md5("ok")){
					$message = "发送邮件成功，注意查收，<br>请尽快在2个小时内激活账号。";
				}else{
					$message = "发送邮件失败,<a href='http://www.jsosuo.com'>请重试</a>";
				}	
			}
		}
		$this->assign("message",$message);
		$this->display();
	}
	//激活账户
	public function vcode(){
		$message = "你是不是走错了，请进入<a href='http://www.jesslu'>捷搜索首页</a>";
		if(!empty($_GET['token'])){
			$obj = D("User");
			$token = trim($this->_get("token"));
			$nickName = trim($this->_get("jsniam"));
			$rs = $obj->field("nickName,tm,id,email,state")->where("token='{$token}'")->find();
			if($rs && md5($rs['nickName'])==$nickName){
				if($rs['state']==2){
					$falseTm = date("Y-m-d H:i:s",strtotime("- 2 hours"));
					if($rs['tm']>$falseTm){
						$rs2 = $obj->where("id={$rs['id']}")->save(array("state"=>0));
						if($rs2){
							$this->success("激活成功，请<a href='http://www.jesslu.com'>登录</a>",U("Login/index"),5);
							// $message = "激活成功，请<a href=''>登录</a>";
						}else{
							$message = "激活失败，<br>请重新点击激活链接";	
						}
					}else{
						$message = "激活链接已经失效，<br><a href='http://localhost/ss.jesslu/index.php/Email/send/email/{$rs['email']}'>请重新发送邮件激活</a>";
					}
				}else{
					$this->success("账号已经激活，请<a href='http://www.jesslu.com'>登录</a>",U("Login/index"),5);
				}
			}
		}
		$this->assign("message",$message);
		$this->display();	
	}
	//发送邮件
	public function send(){
		$message = "你是不是走错了，<br>请进入<a href='http://www.jesslu'>捷搜索首页</a>";
		if(!empty($_GET['email'])){
			$obj = D("User");
			$email = trim($this->_get("email"));
			$falseTm = date("Y-m-d H:i:s",strtotime("- 2 hours"));
			$rs = $obj->field("state,tm,nickName,id")->where("email='{$email}'")->find();
			if($rs){
				if($rs['state']==2){
					$n = md5(rand(1000,9999).time());
					$name = md5($rs["nickName"]);
					$token = md5(rand(1000,9999).time().rand(1000,9999));
					$token = $this->tokenOnly($obj,$token);
					$title = "请立即激活您的捷搜索账号完成注册";
					$body = "<h4>尊敬的&nbsp;{$email}:</h4><p>您已经在捷搜索申请注册，登录邮箱为：{$email}，
					为了确认您的电子邮件地址并激活您的帐号，请立即<a href='http://www.jesslu.com?token={$token}&jsniam={$name}&jscode={$n}'>点击这里激活账户</a>。如果以上链接不能打开，请将下面地址复制到您的浏览器(如IE)的地址栏，
					</p>
					<p>
						<a href='http://www.jesslu.com?token={$token}&jsniam={$name}&jscode={$n}'>http://www.jesslu.com?token={$token}&jsniam={$name}&jscode={$n}</a>
					</p>
					<p>
						打开页面后同样可以完成帐户激活。（该链接在 2小时 内有效， 如超时请进入<a href='http://www.jesslu.com'>捷搜索</a>重新发送验证邮件）
						您在注册捷搜索时，填写了此电子邮箱作为账户名，我们发送这封邮件，以确认您是邮箱的主人。
						如果您没有注册捷搜索，请忽略此邮件。
					</p>";
					$result = postmail($email,$title,$body,$info=' 	');
					if($result=="ok"){
						$now = date("Y-m-d H:i:s");
						$obj->where("id={$rs['id']}")->save(array("token"=>$token,"tm"=>$now));
						$message = "发送邮件成功，注意查收，<br>请尽快在2个小时内激活账号。";	
					}else{
						$message = "发送邮件失败,<a href='http://www.jsosuo.com'>请重试</a>";
					}
				}else{
					$this->success("账号已经激活，请<a href='http://www.jesslu.com'>登录</a>",U("Login/index"),5);
				}
			}	
		}
		$this->assign("message",$message);
		$this->display();	
	}
	//验证token的唯一性
	public function tokenOnly($obj,$token){
		if($obj->where("token='{$token}'")->find()){
			$token = md5(rand(1000,9999).time().rand(1000,9999));
			$this->only($token);
		}else{
			return $token;
		}
	}	
}