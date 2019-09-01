<?php
class errorFile Extends Controller{
function __construct(){
	parent::__construct();
	
}
function Index(){
		 $this->view->render('errorFile/index');
}
}
?>