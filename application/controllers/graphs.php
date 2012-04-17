<?php

class Graphs extends CI_Controller
{
	public function index(){
		$this->load->Model('UsersModel');
		$this->UsersModel->getLog();
		
		$data['seriesdata']=json_encode($this->UsersModel->accessArray);
	
		$this->load->view('graphs',$data);
		
	}
	
	
	
}


?>