<?php
// 本类由系统自动生成，仅供测试用途
class CountAction extends Action {
    public function mouth(){
    	$obj = D("Count");
    	$data = $obj->dataPage();
    	$this->assign("data",$data);
        $this->display();
    }
    public function halfMouth(){
    	$obj = D("Count");
    	$Data = $obj->Data();
    	// var_dump($Data);EXIT;
    	$this->assign("Data",$Data);
        $this->display();
    }
}