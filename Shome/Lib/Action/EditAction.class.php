<?php 
class EditAction extends Action{
	public function index(){
		$lObj = new LoginAction();
		$uId = $lObj->checkLogin();
		$tObj = D("Type");
		$tList = $tObj->show();
		if(!empty($_GET['type'])){
			$type = $_GET['type'];
			if(!in_array($type, array(1,2,3))){
				$type=1;
			}
		}
		if(!empty($_GET['q'])){
			$qId = $_GET['q'];
		}else{
			$qId = 0;
		}
		$this->assign("qId",$qId);
		$this->assign("type",$type);
		$this->assign("tList",$tList);
		$this->display();
	}
	public function add(){
		$type = $this->_post('type');
		if($type==1){
			$obj = D('Question');
			$data['title'] = $this->_post('tt');
			$data['typeId'] = $this->_post('t');
			$data['content'] = $this->_post('c');
			if($obj->create($data)){
				$rs = $obj->add();
				if($rs==false){
					exit(printf(json_encode(array('提交失败',1))));
				}else{
					exit(printf(json_encode(array('提交成功',0))));
				}
			}else{
				exit(printf(json_encode(array($obj->getError(),1))));
			}
		}
		if($type==2){
			$obj = D('Article');
			$data['title'] = $this->_post('tt');
			$data['typeId'] = $this->_post('t');
			$data['content'] = $this->_post('c');
			if($obj->create($data)){
				// var_dump($data);exit;
				$rs = $obj->add();
				if($rs==false){
					exit(printf(json_encode(array('提交失败',1))));
				}else{
					exit(printf(json_encode(array('提交成功',0))));
				}
			}else{
				exit(printf(json_encode(array($obj->getError(),1))));
			}
		}
		if($type==3){
			$obj = D('Answer');
			$data['questionId'] = $this->_post('q');
			$data['content'] = $this->_post('c');
			if($obj->create($data)){
				$rs = $obj->add();
				if($rs==false){
					exit(printf(json_encode(array('提交失败',1))));
				}else{
					exit(printf(json_encode(array('提交成功',0))));
				}
			}else{
				exit(printf(json_encode(array($obj->getError(),1))));
			}	
		}
	}
}