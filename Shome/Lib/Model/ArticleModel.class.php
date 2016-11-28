<?php
class ArticleModel extends Model{
	protected $_validate = array(
			array('title,userId,typeId','checkOnly','您已经有此文章,请输入其它标题',1,'callback',3),
			array('title','5,40','标题长度:[5,40]',1,'length',3),
			array('typeId','require','请输入类型'),
			array('content','500,10000','正文长度:[500,10000]',1,'length',3)
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

	public function dataShow($id,$tId){
		$obj = M("article");
		$tObj = M("type");
		$cObj = M("comment");
		$data=array();
		if($tId=="" || $tId==0){
			$data['nowType']['id'] = 0;
		}else{
			$data['nowType'] = $tObj->field("name,id")->find($tId);
		}
		$data['ar'] = $obj->alias("t0")->field("t0.*,u.nickName,t.name typeName,p.path iconPath,p.name iconName,
			(select count(*) from vote v where v.oper=1 and v.type=1 and v.targetId=t0.id) upCnt,
			(select count(*) from vote v where v.oper=2 and v.type=1 and v.targetId=t0.id) downCnt,
			IFNULL((select sum(jbi) from reward r where r.type=1 and r.targetId=t0.id),0) rCnt,
			(select count(*) from article ar where ar.userId=t0.userId) arCnt,
			(select count(*) from answer an where an.userId=t0.userId) anCnt,
			(select count(*) from question q where q.userId=t0.userId) qCnt,
			(select count(*) from comment c where c.type=1 and c.targetId=t0.id) cCnt
			")->join(array("user u on u.id=t0.userId","type t on t.id=t0.typeId","pic p on p.id=u.picId"))->where("t0.id={$id}")->find();
		$data['arL'] = $obj->field("t0.*,t.name typeName")->alias("t0")->join(array("article a on a.id={$id}","type t on t.id=t0.typeId"))->where("t0.userId=a.userId")->select();
		$data['cL'] = $cObj->field("t0.*,u.nickName,p.path iconPath,p.name iconName")->alias("t0")->join(array("user u on u.id=t0.userId","pic p on p.id=u.picId"))->where("t0.type=1 and t0.targetId={$id}")->order("t0.tm desc")->select();
		$data['rpL'] = $cObj->field("r.*,t0.id cId,u.nickName,ue.nickName toNickName,p.path iconPath,p.name iconName,i.path toIconPath,i.name toIconName")->alias("t0")
			->join(array("right join reply r on r.commentId=t0.id",
				"user u on r.userId=u.id","user ue on ue.id=r.toUserId","pic p on p.id=u.picId","pic i on i.id=ue.picId"))->where("t0.type=1 and t0.targetId={$id}")->order("r.tm")->select();
		return $data;
    }
}