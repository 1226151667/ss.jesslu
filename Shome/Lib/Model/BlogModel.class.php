<?php
class BlogModel extends Model {
    public function dataPage(){
        $obj = M("article");
        $p = isset($_GET['p'])?$_GET['p']:1;
        $where = isset($_GET['tId'])?"typeId=".$_GET['tId']:"";
        $data = array();
        $data['list'] = $obj->where($where)->order("tm desc")->alias("t0")->field("p.path iconPath,p.name iconName,t0.*,t.name typeName,(select count(*) from comment c where c.targetId=t0.id and c.type=1) cCnt,IFNULL((select sum(r.jbi) from reward r where r.type=1 and r.targetId=t0.id),0) jCnt")
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
        $aObj = M("article");
        $data = array();
        $data['tt']['ar'] = $aObj->count();
        $data['ar']['up'] = $aObj->field("t0.*,(select count(*) from vote v where v.targetId=t0.id and v.type=1 and v.oper=1) cnt")->alias("t0")->order("cnt desc")->limit("10")->select();
        $data['ar']['hot'] = $aObj->order("clickCnt desc")->limit("10")->select();
        return $data;
    }
    //搜索页
    public function ssData($key){
        $obj = M("Article");
        $where = "";
        if($key!=""){
            $where = "t0.title like '%{$key}%'";
        }
        $data['list'] = $obj->where($where)->order("t0.tm desc,t0.id desc")->alias("t0")->field("p.path iconPath,p.name iconName,t0.*,t.name typeName,(select count(*) from comment c where c.targetId=t0.id and c.type=1) cCnt,IFNULL((select sum(r.jbi) from reward r where r.type=1 and r.targetId=t0.id),0) jCnt")
        ->join(array("type t on t.id=t0.typeId","user u on u.id=t0.userId","pic p on p.id=u.picId"))->select();
        $info = $obj->alias("t0")->where($where)->count();
        $data['tt'] = $info['tp_count '];
        return $data;
    }
}