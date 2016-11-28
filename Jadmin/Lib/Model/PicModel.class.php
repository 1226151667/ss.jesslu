<?php
class PicModel extends Model{
	protected $_auto = array(
            array('tm','getTm',3,'callback')
        );

    public function getTm(){
        return date('Y-m-d H:i:s');
    }

    public function dataPage(){
        $obj = M('pic');
        $p = isset($_GET['p'])?$_GET['p']:1;
        $data = array();
        $data['list'] = $obj->order('tm desc')->page($p.',10')->select();
        import("ORG.Util.Page");// 导入分页类
        $count      = $obj->count();// 查询满足要求的总记录数
        $Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $data['show']       = $Page->show();// 分页显示输出
        return $data;
    }
}
?>