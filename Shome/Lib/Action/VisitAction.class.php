<?php
class VisitAction extends Action{
	public function add(){
		$data['fPage'] = trim($this->_post("fg"));
		$data['vPage'] = trim($this->_post("vg"));
		$data['form'] = trim($this->_post("f"));
		$data['keyword'] = trim($this->_post("k"));
		$data['ip'] = $this->getIp();
		$data['ipArea'] = $this->ipArea();
		$data['tm'] = date("Y-m-d H:i:s");
		M("visit")->add($data);
	}
}