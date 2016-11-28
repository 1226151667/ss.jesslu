<?php 
class VoteModel extends Model{
	protected $_validate = array(
			array('userId,targetId,type','checkOnly','不能重复投票',1,'callback',1)
		);
	protected $_auto = array(
			array('tm','getTm',1,'callback'),
			array('userId','getUid',1,'callback')
		);
	public function checkOnly($data){
		$map = array();
		$map['userId'] = array('eq',$_SESSION['uId']);
		$map['type'] = array('eq',$data['type']);
		$map['targetId'] = array('eq',$data['targetId']);
		if($this->where($map)->find()){
			return false;
		}else{
			return true;
		}
	}
	public function getUid(){
		$uId = empty($_SESSION['uId'])?0:$_SESSION['uId'];
		return $uId;
	}
	public function getTm(){
		return date('Y-m-d H:i:s');
	}
}