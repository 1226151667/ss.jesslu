<?php
class ArticleModel extends Model{
    public function dataPage(){
        $obj =M("article");
        $p = isset($_GET['p'])?$_GET['p']:1;
        $data = array();
        $data['list'] = $obj->alias("t0")->field("t0.*,u.nickName,t.name as typeName,
                    (select count(*) from comment c where c.type=1 and c.targetId=t0.id) as cCnt,
                    (select count(*) from vote v where v.type=1 and v.targetId=t0.id and v.oper=1) as upCnt,
                    (select count(*) from vote v where v.type=1 and v.targetId=t0.id and v.oper=2) as downCnt,
                    IFNULL((select sum(r.jbi) from reward r where r.type=1 and r.targetId=t0.id),0) as jbiCnt
                    ")->join(array("user u on u.id=t0.userId","type t on t.id=t0.typeId"))->order('t0.tm desc')->page($p.',20')->select();
        import("ORG.Util.Page");// 导入分页类
        $count      = $obj->count();// 查询满足要求的总记录数
        $Page       = new Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        $data['show']       = $Page->show();// 分页显示输出
        return $data;
    }
}
?>