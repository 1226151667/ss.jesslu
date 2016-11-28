<?php
class AnswerModel extends Model{
	// protected $_validate = array(
	// 		array('questionId','isHave','您所回答的问题不存在,可能已删除',1,'callback',3)
	// 	);
	protected $_auto =array(
			array('userId','getUid',1,'callback'),
			array('tm','getTm',3,'callback'),
			array('state','0'),
			array('isAccepted','0')
		);
	public function getUid(){
		$uId = empty($_SESSION['uId'])?0:$_SESSION['uId'];
		return $uId;
	}
	public function getTm(){
		return date('Y-m-d H:i:s');
	}
	// public function isHave($data){
	// 	$qObj = M("question");
	// 	if($qObj->where("id={$data['questionId']}")->find()){
	// 		return true;
	// 	}else{
	// 		return false;
	// 	}
	// }

	public function dataShow($id,$tId){
		$obj = M("question");
		$anObj = M("answer");
		$tObj = M("type");
		$rObj = M("reply");
		$data=array();
		if($tId==""){
			$data['nowType']['id'] = 0;
		}else{
			$data['nowType'] = $tObj->field("name,id")->find($tId);
		}
		$data['q'] = $obj->alias("t0")->field("t0.*,t.name typeName,u.nickName,p.path iconPath,p.name iconName,
				(select count(*) from answer an where an.questionId=t0.id) anCnt
			")->join(array("type t on t.id=t0.typeId","user u on u.id=t0.userId","pic p on p.id=u.picId"))->where("t0.id={$id}")->find();
		$data['an'] = $anObj->field("t0.*,u.nickName,p.path iconPath,p.name iconName,
			(select count(*) from vote v where v.type=0 and v.targetId=t0.id and v.oper=1) upCnt,
			(select count(*) from vote v where v.type=0 and v.targetId=t0.id and v.oper=2) downCnt,
			IFNULL((select sum(jbi) from reward r where r.type=0 and r.targetId=t0.id),0) rCnt,
			(select count(*) from comment c where c.type=0 and c.targetId=t0.id) cCnt
			")->alias("t0")->where("t0.questionId={$id} and t0.state=0")->join(array("user u on u.id=t0.userId","pic p on p.id=u.picId"))->order("t0.tm desc")->select();
		$data['c'] = $anObj->alias("t0")->field("c.*,t0.id anId,u.nickName,p.path iconPath,p.name iconName")->join(array("comment c on c.targetId=t0.id","user u on u.id=c.userId","pic p on p.id=u.picId"))->where("c.type=0 and t0.questionId={$id} and t0.state=0")->select();
		$data['rp'] = $rObj->alias("t0")->field("t0.*,u.nickName,p.path iconPath,p.name iconName,e.nickName toNickName,i.path toIconPath,i.name toIconName")
		->join(array("comment c on c.id=t0.commentId","user e on e.id=t0.toUserId","pic i on i.id=e.picId","answer a on (a.id=c.targetId and c.type=0)","user u on u.id=t0.userId","pic p on p.id=u.picId"))
		->where("a.questionId={$id} and a.state=0")->select();
		return $data;
    }
}
?>