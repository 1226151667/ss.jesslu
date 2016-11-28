<?php
// 本类由系统自动生成，仅供测试用途
class TypeAction extends Action {
    public function index(){
        $obj = D("Type");
        $data = $obj->dataPage();
        $this->assign("data",$data);
        $mainData = $obj->mainType();
        $this->assign("mainData",$mainData);
        $this->display();
    }
    public function add(){
    	$obj = D("Type");
    	$data['name'] = trim($this->_post("ne"));
    	$data['description'] = trim($this->_post("de"));
    	$data['pId'] = trim($this->_post("pd"));
    	$data['state'] = trim($this->_post("st"));
    	if($obj->create($data)){
    		if($obj->add()){
    			$msg = array(0,"添加成功");
    		}else{
    			$msg = array(1,"添加失败");
    		}
    	}else{
    		$msg = array(1,$obj->getError());
    	}
    	exit(printf(json_encode($msg)));
    }
}