<?php
class UserModel extends Model{
	public function dataPage(){
        $obj = M('user');
        $p = isset($_GET['p'])?$_GET['p']:1;
        $data = array();
        $data['list'] = $obj->alias("t0")->field("t0.*,
            (select count(*) from question q where q.userId=t0.id) as qCnt,
            (select count(*) from answer an where an.userId=t0.id) as anCnt,
            (select count(*) from answer an where an.isAccepted=1 and an.userId=t0.id) as anACnt,
            (select count(*) from article ar where ar.userId=t0.id) as arCnt
            ")->order('t0.tm desc')->page($p.',20')->select();
        import("ORG.Util.Page");// 导入分页类
        $count      = $obj->count();// 查询满足要求的总记录数
        $Page       = new Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        $data['show']       = $Page->show();// 分页显示输出
        return $data;
    }
}
?>