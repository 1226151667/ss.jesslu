<?php
class TypeModel extends Model{
	public function show(){
		$obj = M("type");
		$list = $obj->where("pId!=0 and state=1")->select();
		return $list;
	}
}