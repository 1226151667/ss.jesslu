<?php
class QuestionModel extends Model{
	public function dataPage(){
        $obj =M("question");
        $p = isset($_GET['p'])?$_GET['p']:1;
        $data = array();
        $data['list'] = $obj->alias("t0")->field("t0.*,u.nickName,t.name as typeName,
    				(select count(*) from answer a where a.questionId=t0.id) as anCnt
    				")->join(array("user u on u.id=t0.userId","type t on t.id=t0.typeId"))->order('t0.tm desc')->page($p.',20')->select();
        import("ORG.Util.Page");// 导入分页类
        $count      = $obj->count();// 查询满足要求的总记录数
        $Page       = new Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        $data['show']       = $Page->show();// 分页显示输出
        return $data;
    }
}
?>