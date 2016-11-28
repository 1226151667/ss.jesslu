<?php
class RewardModel extends Model{
    public function dataPage(){
        $obj =M("reward");
        $p = isset($_GET['p'])?$_GET['p']:1;
        $data = array();
        $data['list'] = $obj->alias("t0")->field("t0.*,u.nickName,
                    IFNULL((case t0.type when 0 then (select q.title from answer a left join question q on q.id=a.questionId where a.id=t0.targetId) 
                        when 1 then (select a.title from article a where a.id=t0.targetId) else '未知类型' end),'你所要的内容可能已被删除') as targetName
                    ,IFNULL((case t0.type when 0 then (select u.nickName from answer a left join user u on u.id=a.userId where a.id=t0.targetId) 
                        when 1 then (select u.nickName from article a left join user u on u.id=a.userId where a.id=t0.targetId) else '未知类型' end),'你所要的内容可能已被删除') as toNickName
                    ")->join("user u on u.id=t0.userId")->order('t0.tm desc')->page($p.',20')->select();
        import("ORG.Util.Page");// 导入分页类
        $count      = $obj->count();// 查询满足要求的总记录数
        $Page       = new Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        $data['show']       = $Page->show();// 分页显示输出
        return $data;
    }
}
?>