<?php
class VisitModel extends Model{
    public function dataPage(){
        $obj =M("visit");
        $p = isset($_GET['p'])?$_GET['p']:1;
        $data = array();
        $data['list'] = $obj->alias("t0")->field("t0.*,
                    (select count(*) from visit v where v.vPage=t0.vPage) as vpCnt,
                    (select count(*) from visit v where v.fPage=t0.fPage) as fpCnt,
                    (select count(*) from visit v where v.keyword=t0.keyword) as kCnt,
                    (select count(*) from visit v where v.form=t0.form) as fCnt,
                    (select count(*) from visit v where v.ip=t0.ip) as ipCnt
                    ")->order('t0.tm desc')->page($p.',20')->select();
        import("ORG.Util.Page");// 导入分页类
        $count      = $obj->count();// 查询满足要求的总记录数
        $Page       = new Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        $data['show']       = $Page->show();// 分页显示输出
        return $data;
    }
}
?>