<?php
require_once("./Resources/phpMailer/function.php");
class RegisterAction extends Action{
	public function index(){
		$this->display();
	}
	public function get(){
		$obj = D("User");
		$data['pwd'] = trim($this->_post("p1"));
		$p2 = trim($this->_post("p2"));
		$data['email'] = trim($this->_post("e"));
		if(in_array("",$data)){
			exit(printf(json_encode(array(1,"输入不能有空"))));
		}else if($p2!=$data['pwd']){
			exit(printf(json_encode(array(1,"两次密码输入不一致"))));
		}else{
			$token = md5(rand(1000,9999).time().rand(1000,9999));
			$nickName = "jss".rand(1000,9999);
			$data['token'] = $this->tokenOnly($obj,$token);
			$data['nickName'] = $this->nameOnly($obj,$nickName);
			if($obj->create($data)){
				$rs = $obj->add();
				if($rs==false){
					exit(printf(json_encode(array(1,"注册失败，请重试"))));
				}else{
					$n = md5(rand(1000,9999).time());
					$name = md5($data["nickName"]);
					$title = "请立即激活您的捷搜索账号完成注册";
					$body = "<h4>尊敬的&nbsp;{$data['email']}:</h4><p>您已经在捷搜索申请注册，登录邮箱为：{$data['email']}，
					为了确认您的电子邮件地址并激活您的帐号，请立即<a href='http://www.jesslu.com?token={$data['token']}&jsniam={$name}&jscode={$n}'>点击这里激活账户</a>。如果以上链接不能打开，请将下面地址复制到您的浏览器(如IE)的地址栏，
					</p>
					<p>
						<a href='http://www.jesslu.com?token={$data['token']}&jsniam={$name}&jsd={$rs}'>http://www.jesslu.com?token={$data['token']}&jsniam={$name}&jscode={$n}</a>
					</p>
					<p>
						打开页面后同样可以完成帐户激活。（该链接在 2小时 内有效， 如超时请进入<a href='http://www.jesslu.com'>捷搜索</a>重新发送验证邮件）
						您在注册捷搜索时，填写了此电子邮箱作为账户名，我们发送这封邮件，以确认您是邮箱的主人。
						如果您没有注册捷搜索，请忽略此邮件。
					</p>";
					$result = postmail($data['email'],$title,$body,$info=' 	');
					$result = md5($result);
					exit(printf(json_encode(array(0,$result,$rs))));
				}
			}else{
				exit(printf(json_encode(array(1,$obj->getError()))));
			}
		}
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
	//验证昵称的唯一性
	public function nameOnly($obj,$nickName){
		if($obj->where("nickName='{$nickName}'")->find()){
			$nickName = "jss".rand(1000,9999);
			$this->only($obj,$nickName);
		}else{
			return $nickName;
		}
	}
}