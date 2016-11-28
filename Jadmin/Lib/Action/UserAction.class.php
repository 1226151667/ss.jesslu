<?php
// 本类由系统自动生成，仅供测试用途
class UserAction extends Action {
    public function index(){
        $obj = D("User");
        $data = $obj->dataPage();
    	$this->assign("data",$data);
        $this->display();
    }
}