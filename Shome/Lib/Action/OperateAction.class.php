<?php
class OperateAction extends Action{
	public function checkS(){
		if(empty($_SESSION['uId'])){
			return 0;
		}else{
			return 1;
		}
	}
	//添加投票（赞同或反对）
	public function vote(){
		$uId = $this->checkS();
		if($uId==0){
			exit(printf(json_encode(array("登录后才能投票，请立即登录",1))));
		}else{
			$data['type'] = $this->_post("t")-1;
			$data['targetId'] = $this->_post("b");
			$data['oper'] = $this->_post("c");
			$obj = D("Vote");
			if($obj->create($data)){
				$rs = $obj->add();
				if($rs==false){
					exit(printf(json_encode(array("投票失败，请重新投票",1))));
				}else{
					exit(printf(json_encode(array("投票成功！",0))));
				}
			}else{
				exit(printf(json_encode(array($obj->getError(),1))));
			}
		}
	}
	//评论
	public function comment(){
		
	}
}