<?php
class QuestionModel extends Model{
	protected $_validate = array(
			array('title,userId,typeId','checkOnly','您已经发布过此问题了,请输入其它标题',1,'callback',3),
			array('title','5,40','标题长度:[5,40]',1,'length',3),
			array('typeId','require','请输入类型'),
			array('content','30,10000','正文长度:[30,10000]',1,'length',3)
		);
	protected $_auto = array(
			array('userId','getUid',1,'callback'),
			array('tm','getTm',3,'callback')
		);
	public function getUid(){
		$uId = empty($_SESSION['uId'])?0:$_SESSION['uId'];
		return $uId;
	}
	public function getTm(){
		return date('Y-m-d H:i:s');
	}
	public function checkOnly($data){
		$map = array();
		$map['userId'] = array('eq',$_SESSION['uId']);
		$map['title'] = array('eq',$data['title']);
		$map['typeId'] = array('eq',$data['typeId']);
		if($this->where($map)->find()){
			return false;
		}else{
			return true;
		}
	}

	public function dataPage(){
		$obj = M("question");
		$p = isset($_GET['p'])?$_GET['p']:1;
		$where = isset($_GET['tId'])?"typeId=".$_GET['tId']:"";
		$data = array();
		$data['list'] = $obj->where($where)->order("tm desc")->alias("t0")->field("p.path iconPath,p.name iconName,t0.*,t.name typeName,(select count(*) from answer an where an.questionId=t0.id) anCnt")
		->join(array("type t on t.id=t0.typeId","user u on u.id=t0.userId","pic p on p.id=u.picId"))->page($p.',20')->select();
		import("ORG.Util.Page");// 导入分页类
        $count      = $obj->where($where)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        $data['show']       = $Page->show();// 分页显示输出
		return $data;
	}
	public function typeData(){
		$obj = M("type");
		$data = array();
		$data['nowType'] = "";
		if(isset($_GET['tId'])){
			$data['nowType'] = $obj->field("name,id")->find($_GET['tId']);
		}
		$data['list'] = $obj->where("pId!=0")->select();
		return $data;
	}
	public function pkData(){
		$qObj = M("question");
		$aObj = M("answer");
		$uObj = M("user");
		$data = array();
		$data['tt']['q'] = $qObj->count();
		$data['tt']['a'] = $aObj->count();
		$data['tt']['ac'] = $aObj->where("isAccepted=1")->count();
		$data['u']['a'] = $uObj->field("p.path iconPath,p.name iconName,t0.*,(select count(*) from answer an where an.userId=t0.id) cnt")->alias("t0")->order("cnt desc")->join("pic p on p.id=t0.picId")->limit("3")->select();
		$data['u']['q'] = $uObj->field("p.path iconPath,p.name iconName,t0.*,(select count(*) from question q where q.userId=t0.id) cnt")->alias("t0")->order("cnt desc")->join("pic p on p.id=t0.picId")->limit("3")->select();
		$data['u']['ac'] = $uObj->field("p.path iconPath,p.name iconName,t0.*,(select count(*) from answer an where an.userId=t0.id and an.isAccepted=1) cnt")->alias("t0")->order("cnt desc")->join("pic p on p.id=t0.picId")->limit("3")->select();
		$data['q']['c'] = $qObj->order("clickCnt desc")->limit("3")->select();
		$data['q']['a'] = $qObj->alias("t0")->field("t0.*,(select count(*) from answer an where an.questionId=t0.id) cnt")->order("cnt desc")->limit("3")->select();
		return $data;
	}
	//搜索页
	public function ssData($key){
		$obj = M("question");
		$where = "title like '%{$key}%'";
		$data['list'] = $obj->where($where)->order("tm desc,id desc")->alias("t0")->field("p.path iconPath,p.name iconName,t0.*,t.name typeName,(select count(*) from answer an where an.questionId=t0.id) anCnt")
		->join(array("type t on t.id=t0.typeId","user u on u.id=t0.userId","pic p on p.id=u.picId"))->select();
		$data['tt'] = $obj->where($where)->count();
		return $data;
	}
}