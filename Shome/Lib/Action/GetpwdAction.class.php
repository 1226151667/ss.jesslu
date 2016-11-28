<?php
class GetpwdAction extends Action{
	public function index(){

		$this->display();
	}
	public function setS(){
		$_SESSION['uId'] = 1;
		return 0;
	}
	public function checkLogin(){
		if(!isset($_SESSION['uId'])){
			$this->error("您还没有登录，现在去登录",U("Login/index"));
		}else{
			return $_SESSION['uId'];
		}
	}
}