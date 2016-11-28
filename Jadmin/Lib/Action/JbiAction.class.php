<?php
// 本类由系统自动生成，仅供测试用途
class JbiAction extends Action {
    public function index(){
        $obj = D('Jbi');
        $data = $obj->dataPage();
    	$this->assign("data",$data);
        $this->display();
    }
}