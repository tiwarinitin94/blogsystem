<?php
if(class_exists ( "Controller" )){
	
 class Index extends Controller{
	  function __construct(){
		  parent::__construct();
		  $this->view->js=array('index/default.js');
	  }
function Index(){
	 $this->view->main="index";
		 $this->view->render('index/index');
}
function run(){
	$token_value=csrf::get_token_csrf();
	$_POST['csrf_val']=$token_value;
	$this->model->run();
}
function sign_check(){
	$token_value=csrf::get_token_csrf();
	$_POST['csrf_val']=$token_value;
	$this->model->sign_check();
}

function sign_up(){
	$token_value=csrf::get_token_csrf();
	$_POST['csrf_val']=$token_value;
	
	$this->model->sign_up();
	
	}
	
  }

  }else{
	  echo "You should not be here. ";
  }

?>