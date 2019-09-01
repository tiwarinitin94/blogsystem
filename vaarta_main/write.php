<?php

class write extends Controller{
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
		    $this->view->js=array('write/default.js');
}
function Index(){
	 	 $this->view->render('write/index');
}



public function addImage_media(){
		$this->model->addImage_media();
}

public function publishVal(){
	    $this->model->publishVal();
}

public function updatePost(){
	$this->model->updatePost();
}

public function lastId(){
	    $this->model->lastId();
}

public function checkUrl($url){
	    $this->model->checkUrl($url);
}

public function check_edit($url){
	    $this->model->check_edit($url);
}

function addImage_mediaFromSRC(){
	$this->model->addImage_mediaFromSRC();
}

function updateTag(){
	$this->model->updateTag();
}

function revertdraft(){
	$this->model->revertdraft();
}

function updateDatePost(){
	$this->model->updateDatePost();
}

}




?>