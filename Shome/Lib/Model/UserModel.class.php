<?php
class UserModel extends Model{
	protected $_validate = array(
			array("email","email","邮箱格式不正确"),
			array('email','','邮箱已经注册了！',1,'unique',1),
			array('pwd','6,15','密码长度:[6,15]',1,'length',3)
		);
	protected $_auto = array(
		array('state','2'),
		array('tm','getTm',3,'callback'),
    	array('pwd','md5',1,'function'),
	);
	public function getTm(){
		return date('Y-m-d H:i:s');
	}
}