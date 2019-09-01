<?php 

class gallery_area_model extends Models{
	
	public function __construct(){
		parent::__construct();
		
	}
	
	public function posts_of_user($valCheck){
		$username=Session::get('user');
		$id=Session::get('id');

		$username=trim($username);

		 
		if($valCheck==0){
			//Fetch All Post
			$check= $this->db->select("*","post_data","user_posted='$username'") ;

		}elseif($valCheck==1){

			//Fetch Drafts
			$check= $this->db->select("*","post_data","user_posted='$username' AND published='1'") ;

		}elseif($valCheck==2){

			//Fetch Published
			$check= $this->db->select("*","post_data","user_posted='$username' AND published!='1'") ;

		}

		
		$count=$check->rowCount();

			
		$check->setFetchMode(PDO::FETCH_ASSOC);
	   
	    $data= $check->fetchAll();
		
	
	
	 
        echo json_encode($data);
		
	}


	public function delPost(){
		if(isset($_POST['postId']) ){

			$valTagId=$_POST['postId'];


			
			$delete=$this->db->delete("post_data","id='$valTagId'");
			
				if($delete){
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