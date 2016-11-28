<?php
class LoginAction extends Action{
	public function index(){
		if(session('?userId')){
			$this->success("您已经登录了，不能重复登录",U("Index/index"),5);
		}
		$this->display();
	}
	public function out(){
		session(null);
		$this->success("注销成功",U("Index/index"));
	}
	public function check(){
		$e = trim($this->_post("e"));
		$p = trim($this->_post("p"));
		// var_dump($e);
		if($e==""||$p==""){
			exit(printf(json_encode(array(1,"输入不能有空"))));
		}else{
			$obj = D("User");
			$rs = $obj->field("pwd,id")->where("email='{$e}'")->find();
			if($rs){
				if(md5($p)==$rs['pwd']){
					session("userId",$rs['id']);
					exit(printf(json_encode(array(0))));
				}else{
					exit(printf(json_encode(array(1,"密码错误"))));
				}
			}else{
				exit(printf(json_encode(array(1,"此邮箱还没注册呢"))));	
			}
		}
	}
	public function checkLogin(){
		if(!isset($_SESSION['userId'])){
			$this->error("您还没有登录，现在去登录",U("Login/index"));
		}else{
			return $_SESSION['uId'];
		}
	}
}