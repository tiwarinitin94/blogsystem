<?php 
class write_model extends Models{
	public function __construct(){
		parent::__construct();
	}
	
	public function addImage_media(){
		$username=Session::get('user');
		$id=Session::get('id');
		
		if(isset($_FILES['image_f'])){
			if (((@$_FILES["image_f"]["type"]=="image/jpeg") || (@$_FILES["image_f"]["type"]=="image/png") || (@$_FILES["image_f"]["type"]=="image/gif")||(@$_FILES["image_f"]["type"]=="image/jpg")||(@$_FILES["image_f"]["type"]=="image/png"))&&(@$_FILES["image_f"]["size"] < 5048576)){
				$chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
				$rand_dir_name = substr(str_shuffle($chars), 0, 15);
				if(!mkdir("./public/userdata/media_blog/$rand_dir_name")){
					echo "Cannot make directory";
				}

				if (file_exists("./public/userdata/media_blog/$rand_dir_name/".@$_FILES["image_f"]["name"])){
					echo @$_FILES["image_f"]["name"]." Already exists";
				}
				else{
					$temp = explode(".", $_FILES["image_f"]["name"]);
					
					$newfilename = round(microtime(true)) . '.' . end($temp);
					
					move_uploaded_file(@$_FILES["image_f"]["tmp_name"],"./public/userdata/media_blog/$rand_dir_name/".$newfilename);
					$profile_pic_name = @$newfilename;
					
					$date_added =  date("Y-m-d H:i:s");  // Date on added
					
					
					$insert=$this->db->insert("media_src (src,user_added,add_date)","('$rand_dir_name/$profile_pic_name','$username','$date_added')");  
					
					echo $rand_dir_name.'/'.$profile_pic_name;
				}
			}
			else{
				echo "Invailid File! Your image must be no larger than 5MB and it must be either a .jpg, .jpeg, .png or .gif";
			}
		}else{
			echo "You should not be here";
		}
	}
	
	public function publishVal(){
		if(isset($_POST['val']) && isset($_POST['title']) && isset($_POST['url'])){
			if(Self::checkUrl($_POST['url'],1)==0){
				$username=Session::get('user');
				
				$id=Session::get('id');
				
				$htmlValue= $_POST['val'];
				$title=$_POST['title'];
				
				$url=$_POST['url'];
				$date_added =  date("Y-m-d H:i:s");
				
				$published=$_POST['published'];
				
				$insert=$this->db->insert("post_data (p_id,title,html_val,user_posted,date,published)","('$url','$title','$htmlValue','$username','$date_added','$published')");
				if($insert){
					echo "success".$this->db->lastInsertId();
				}else{
					echo "wrong";
				}
			}else{
				echo "Url";
			}
			
		}else{
			echo "You should not be here";
		}
		
	}
	
	public function lastId(){
		$username=Session::get('user');
		$id=Session::get('id');

		$check= $this->db->select("user_posted","post_data","user_posted='$username'") or die(mysql_error());
		$count=$check->rowCount();
		//$count=trim($count," ");
		echo $count+1;
	}
	
	
	public function checkUrl($url,$checkVal=false){
		$count=0;
		if($url!=""){
			$check= $this->db->select("p_id","post_data","p_id='$url'") or die(mysql_error());
			$count=$check->rowCount();
		   // $count=trim($count," ");

		   if(!$checkVal){
		    echo $count;
		   }
		}
		return $count;
	}
	
	public function check_edit($id_val){
		if($id_val!=""){
			if(Self::checkUrl($id_val,1)>0){
				$check= $this->db->select("*","post_data","p_id='$id_val'") or die(mysql_error());
				$data=$check->fetch();
				echo json_encode($data);
			}
		}
		
	}

	public function updatePost(){

		if(isset($_POST['val']) && isset($_POST['title']) && isset($_POST['url'])){
				$username=Session::get('user');
				
				$id=Session::get('id');
				
				$htmlValue= $_POST['val'];
				$title=$_POST['title'];
				
				$url=$_POST['url'];

				$u_id=$_POST['u_id'];


				$published=$_POST['published'];


				$date_added =  date("Y-m-d H:i:s"); 

				//print_r($_POST);


			
				
				$insert=$this->db->update("post_data","p_id='$url', title='$title', html_val='$htmlValue',published='$published'","id='$u_id'");
				if($insert){
					echo "success";
				}else{
					echo "wrong";
				}

				
			
			
		}else{
			echo "You should not be here";
		}

	}


	
	public function addImage_mediaFromSRC(){
		$username=Session::get('user');
		$id=Session::get('id');

		$username=trim($username);

		

		$check= $this->db->select("*","media_src","user_added='$username'") ;
		$count=$check->rowCount();

			
		$check->setFetchMode(PDO::FETCH_ASSOC);
	   
	    $data= $check->fetchAll();
		
	
	
	 
        echo json_encode($data);
	}


	public function updateTag(){

		if(isset($_POST['postId'])){

			$valTagId=$_POST['postId'];

			$val=$_POST['postdata'];

			$insert=$this->db->update("post_data","tags='$val'","id='$valTagId'");
				if($insert){
					echo "success";
				}else{
					echo "wrong";
				}



		}else{

			echo "You should not be here";

		}
		
	}


	public function revertdraft(){
		
		if(isset($_POST['postId'])){

			$valTagId=$_POST['postId'];

			
			$insert=$this->db->update("post_data","published='1'","id='$valTagId'");
				if($insert){
					echo "success";
				}else{
					echo "wrong";
				}



		}else{

			echo "You should not be here";

		}

	}

	public function updateDatePost(){
		if(isset($_POST['postId']) && isset($_POST['post_date'])){

			$valTagId=$_POST['postId'];

			$dateVal =$_POST['post_date'];

			
			$insert=$this->db->update("post_data","date='$dateVal'","id='$valTagId'");
			
				if($insert){
					echo "success";
				}else{
					echo "wrong";
				}



		}else{

			echo "You should not be here";

		}
	}
		
	
	  
}
?>


