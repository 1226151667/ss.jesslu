<?php
class BlogAction extends Action {
    public function index(){
    	$obj = D("Blog");
    	$data = $obj->dataPage();
    	$tData = $obj->typeData();
    	$pkData = $obj->pkData();
        $lg['is'] = session('?userId')?session('userId'):"no";
        if($lg['is']!="no"){
            $userInfo = D("User")->alias("t0")->field("p.path,p.name")->where("t0.id={$lg['is']}")->join(array("pic p on p.id=t0.picId"))->find();
            $lg['iconPath'] = $userInfo['path'];
            $lg['iconName'] = $userInfo['name'];
        }
        $this->assign("lg",$lg);
    	$this->assign("data",$data);
    	$this->assign("tData",$tData);
    	$this->assign("pkData",$pkData);
		$this->display();
    }
}