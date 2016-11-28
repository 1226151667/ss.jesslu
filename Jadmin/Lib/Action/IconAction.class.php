<?php
// 本类由系统自动生成，仅供测试用途
class IconAction extends Action {
    public function index(){
        $obj = D("Pic");
        $data = $obj->dataPage();
    	$this->assign("data",$data);
        $this->display();
    }
    public function add(){
    	$obj = D("Pic");
    	$info = $this->upload();
    	if($info[0]==1){
    		$this->error($info[1]);
    	}else{
    		$data['type'] = 1;
    		$data['path'] = $info[1][0]['savepath'];
    		$data['name'] = 'thumb_'.$info[1][0]['savename'];
   			if($obj->create($data)){
				$rs = $obj->add();
				if($rs){
					exit($this->redirect("Icon/index"));
				}else{
					exit($this->error('提交失败'));
				}
			}else{
				exit($this->error($obj->getError()));
			}
    	}
    }
    public function del(){
        $obj = D("Pic");
        $id = $this->_get("id");
        $rs = D("User")->where("picId={$id}")->find();
        if($rs){
            exit(printf(json_encode("有用户使用此头像，暂不能删除")));
        }else{
            $iconInfo = $obj->where("id={$id}")->find();
            $fileName = $iconInfo['path'].$iconInfo['name'];
            if(unlink($fileName)){
                $rs = $obj->where("id={$id}")->delete();
                if($rs){
                    exit(printf(json_encode("删除成功")));    
                }else{
                    exit(printf(json_encode("数据删除失败")));    
                }
            }else{
                exit(printf(json_encode("文件删除失败")));
            }
        }
    }
}