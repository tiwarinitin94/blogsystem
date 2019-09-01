<?php
class gallery_area extends Controller{
	function __construct(){
		parent::__construct();
		Session::init();
		$logged=Session::get('loggedin');
		if($logged==false){
			Session::destroy();
			header('location:'.URL);
			exit();	
		}else{
			$this->user->data();
		}
		$this->view->js=array('gallery_area/default.js');
	}
	
	function Index(){
		$this->view->render('gallery_area/index');
	}
	
	function posts_of_user($valCheck){
		$this->model->posts_of_user($valCheck);
	}

	function delPost(){
		$this->model->delPost();
	}

	

}
?>