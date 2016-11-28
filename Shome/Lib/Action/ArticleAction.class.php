<?php
class ArticleAction extends Action{
	public function index(){
		$obj = D("Article");
		$id = $_GET['id'];
		$obj->where("id={$id}")->setInc('clickCnt');
		$tId = $_GET['tId'];
		$data = $obj->dataShow($id,$tId);
    	$lg['is'] = session('?userId')?session('userId'):"no";
        if($lg['is']!="no"){
            $userInfo = D("User")->alias("t0")->field("p.path,p.name")->where("t0.id={$lg['is']}")->join(array("pic p on p.id=t0.picId"))->find();
            $lg['iconPath'] = $userInfo['path'];
            $lg['iconName'] = $userInfo['name'];
        }
        $this->assign("lg",$lg);
		$this->assign("data",$data);
		$this->display();
	}
}