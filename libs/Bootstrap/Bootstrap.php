<?php

class Bootstrap{
	
	//contructor of bootstrap
function __construct(){
	
	
	
	//database
	$this->db= new database();
			 	
				
				
	//-------------------------------------------------For url of site
	
	
	$url="";
	if(isset($_GET['url'])){
		$url=htmlspecialchars($_GET['url']);
	}
	
	
	
	
   Session::init();
   $logged=Session::get('loggedin');
   $url= rtrim($url,'/');
   
   $url=filter_var($url,FILTER_SANITIZE_URL);
   $url2=explode('/',$url);//exploding '/'

   $file= 'vaarta_main/'.$url2[0].'.php';//get the file name
   //If $url2[0] is a file the file var will hold it
   
   

   
    
	//$url2[0] is parameter one to our web url
   
   
    //if url is empty

   if(empty($url2[0])||strtolower($url2[0])=='index' && empty($url2[1])){ 
     
	  //If url has nothing 
	   
	   if($logged==false){
		   //if not logged in
		   require 'vaarta_main/index.php';
		   $controller=new index();
		   $controller->Index();
		   $controller->load_model('index');
		   return false;
       }
	   else{
		   //if logged in
		   require 'vaarta_main/gallery_area.php'; 
		   $controller=new gallery_area();
		   $controller->index();
		   $token_value=csrf::get_token_csrf();
		   $_POST['csrf_val']=$token_value;
		   $controller->load_model('gallery_area');
		   return false;
	   }
	   
   }




//--------------------------------------------------------check if profile exist----------------------------//
        //echo $url2[0];
	$check=$this->db->select("*","post_data","p_id='$url2[0]'");
	$count=$check->rowCount();
	$data=$check->fetch();
	
	//if $url2[0] is a username then count=1
	
	
//if the url name exist
    if(file_exists($file)){
		// echo $file;
		require "$file";
	}elseif($count>=1){
		if(sizeof($url2)>1){
			$this->error();
			return false;
		}
		
		require  "vaarta_main/profile.php";
		$controller= new profile($data);
		$token_value=csrf::get_token_csrf();
		$_POST['csrf_val']=$token_value;
		$controller->Index($data);
		$controller->load_model("profile");
		return false;
    }
	else{
		//error showing
		$this->error();
		return false;
	}

    if(class_exists ( $url2[0])){  //if any class exist that shows if any controller exist
	
		$controller= new $url2[0];  //Create object of the class
		$controller->load_model($url2[0]);//load model of url 
		if(isset($url2[2])){ //If there is a function call
			if(method_exists($controller,$url2[1])){ //Call the function with parameter
				$controller->{$url2[1]}($url2[2]);
				
			}else{
				$this->error();
				return false;
			}
		}elseif($url2[0]=='profile'&&sizeof($url2)<=1){
			$this->error();
			return false;
		}elseif(isset($url2[1])){
			//echo $url2[1];exit();
			if(method_exists($controller,$url2[1])){
				$controller->{$url2[1]}();
				}else{
					$this->error();
					return false;
				}
		}else{
			$token_value=csrf::get_token_csrf();
			$_POST['csrf_val']=$token_value;
			$controller->index();
		}
	}
}


//For Error page not found
function error(){
	require "vaarta_main/errorFile.php";
	$controller= new errorFile();
	$controller->Index();
	return false;
	}
}

?>