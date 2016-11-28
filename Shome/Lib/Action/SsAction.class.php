<?php
class SsAction extends Action {
    public function index(){
        $key = $this->_get("key");
    	$bObj = D("Blog");
        $qObj = D("Question");
    	$data['b'] = $bObj->ssData($key);
        $data['q'] = $qObj->ssData($key);
        $lg['is'] = session('?userId')?session('userId'):"no";
        if($lg['is']!="no"){
            $userInfo = D("User")->alias("t0")->field("p.path,p.name")->where("t0.id={$lg['is']}")->join(array("pic p on p.id=t0.picId"))->find();
            $lg['iconPath'] = $userInfo['path'];
            $lg['iconName'] = $userInfo['name'];
        }
        $this->assign("lg",$lg);
    	$this->assign("data",$data);
        // var_dump($data['b']);exit;
        // var_dump($data['b']);exit;
		$this->display();
    }
}