<?php
class TypeModel extends Model{
    protected $_validate = array(
            array("name","1,10","名称长度要在1-10个字符",1,"length",3),
            array("description","20,100","名称长度要在1-10个字符",1,"length",3),
            array("name,pId","checkOnly","此名称已添加过",1,"callback",3)
        );

    protected $_auto = array(
            array("userId","0"),
            array("tm","getTm",1,"callback")
        );
    public function getTm(){
        return date('Y-m-d H:i:s');
    }
    public function checkOnly($data){
        $map = array();
        $map['name'] = $data['name'];
        $map['pId'] = $data['pId'];
        if($this->where($map)->find()){
            return false;
        }else{
            return true;
        }
    }

    public function dataPage(){
        $obj =M("type");
        $p = isset($_GET['p'])?$_GET['p']:1;
        $data = array();
        $data['list'] = $obj->alias("t0")->field("t0.*,
                    IF(t0.pId=0,'顶级',(select t.name as pName from type t where t.id=t0.pId)) as pName,
                    (select count(*) from question q where q.typeId=t0.id) as qCnt,
                    (select count(*) from article a where a.typeId=t0.id) as aCnt,
                    IFNULL(u.nickName,'admin') as userName
                    ")->join("left join user u on u.id=t0.userId")->order('t0.tm desc')->page($p.',20')->select();
        import("ORG.Util.Page");// 导入分页类
        $count      = $obj->count();// 查询满足要求的总记录数
        $Page       = new Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        $data['show']       = $Page->show();// 分页显示输出
        return $data;
    }
    public function mainType(){
        $obj = M("type");
        $data = $obj->where("pId=0")->select();
        return $data;
    }
}
?>