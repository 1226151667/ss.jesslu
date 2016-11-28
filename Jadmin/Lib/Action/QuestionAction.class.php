<?php
// 本类由系统自动生成，仅供测试用途
class QuestionAction extends Action {
    public function index(){
        $obj = D("Question");
        $data = $obj->dataPage();
        $this->assign("data",$data);
        $this->display();
    }
}