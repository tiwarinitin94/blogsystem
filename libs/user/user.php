<?php 
 class user extends Models{
	 public function __construct(){
		 
	 }
// for userprofile data-------------------------------------------------------------------		
public function data(){
	$user=Session::get('user');
}



public static function get_user_info($user_pr_id=false){
	$db= new database();
	$user=Session::get('user');
	$id=Session::get('id');
	if($user_pr_id){
		  $check=$db->select("*",'info_users',"user_id='$user_pr_id' ");
	}else{
		  $check=$db->select("*", "info_users","user_id='$id' ");
	}
	
	 $check->setFetchMode(PDO::FETCH_ASSOC);
	   $check->execute();
	   $count=$check->rowCount();
	   if($count==0){
		   echo $count;
	   }else{
	 $data= $check->fetchAll();
	echo json_encode($data);
	   }
}
public static function get_user_firstname(){
	if(isset($_POST['data_val'])){
		
	 $db= new database();
	 $user=Session::get('user');
	 $user_pr="";
	 if(isset($_POST['other_u'])){
		 $user_pr =$_POST['other_u'];
	 }
	 if($user_pr){
		// echo $user_pr;
		 $check=$db->select("username,first_name,last_name,profile_pic,country,bio","myusers","username='$user_pr' ");
	 }else{
	 $check=$db->select("first_name,last_name,profile_pic","myusers","username='$user' ");
	 }	 $check->setFetchMode(PDO::FETCH_ASSOC);
	   $check->execute();
	  // $count=$check->rowCount();
	   $data= $check->fetchAll();
	   	echo json_encode($data);
	}else{
		echo "You should not be here";
	}   
}



//------------------------------------------------------------profile data end
//---------------------------------------------------------news data
public static function get_user_news($get_check){
//	echo $get_check;
    
	if($get_check == "helloalkddaklfjakldjaksdjaakdjdakljdkjdksjkjakjdksjdakjssjdksdjsa"){
	if(isset($_POST['last_id'])){
		$last_id=$_POST['last_id'];
	}else{
		$last_id="nothing";
	}
	 $db= new database();
	 $user=Session::get('user');
	 $friend_data=self::get_user_friends();
	 $new=implode(",",$friend_data);
	 $new=explode(",",$new);
	 $p=0;
	 foreach($new as $value){
			if($p==0){
				$jai[$p]="'".$value."'";
			}else{
			$jai[$p] =",'".$value."'";
			}
			$p++;
		}
		
		  $jai2=implode($jai);

		  if($last_id=="nothing"){
			  $check=$db->select("*","posts","added_by IN ($jai2)
			 or added_by='$user' or user_posted_to='$user'
			 ORDER BY id DESC LIMIT 5")or die(mysqli_error());
		  }else{
			   $check=$db->select("*","posts ",
			   " id<'$last_id' AND (added_by IN ($jai2) OR added_by='$user' OR user_posted_to='$user')
				ORDER BY id DESC LIMIT 10")or die(mysqli_error());
		  }
			
	 $check->setFetchMode(PDO::FETCH_ASSOC);
	  $check->execute();
	  $data= $check->fetchAll();
	  echo json_encode($data);
	
	
	}else{
		echo "If you are bad then I am your dad, Go to Hell";
	}
	
}
//--------------------------------------------news data end---------------------------------------
//-------------------------------------------Friends data for news and show----------------
private static function get_user_friends($user_pro=false){

	$db= new database();
	 $user=Session::get('user');
	 if(!$user_pro){
	  $check=$db->select("friend_array","myusers","username='$user'") or die(mysqli_error());
	 }else{
		 $check=$db->select("friend_array","myusers","username='$user_pro'") or die(mysqli_error());
	 }
	 $check->setFetchMode(PDO::FETCH_ASSOC);
	   $check->execute();
	 $data= $check->fetch();
	return $data;
	
	
	
}
public static function get_user_friends_data(){
	  if(isset($_POST['added_by'])){
	 $db= new database();
	 
	 $name=$_POST['added_by'];
	// if(isset($_POST['this_check'])){	$if_all=$_POST['this_check'];}else{$if_all="";}
  
	  $check=$db->select("profile_pic","myusers","username='$name' ");
	 $check->setFetchMode(PDO::FETCH_ASSOC);
	   $check->execute();
	 $data= $check->fetch();
	 $value=$data['profile_pic'];
	 echo $value;
	  }else{
		  echo "Do not mess with me . ";
	  }
	 
}

public static function image_data($name){

    $db= new database();
	if(isset($_POST['data'])){
		$check=$db->select( "post_image","posts","added_by='$name' && post_image!='Nothing' ORDER BY id DESC");
	}else{
	$check=$db->select( "post_image","posts","added_by='$name' && post_image!='Nothing' ORDER BY id DESC LIMIT 15");
	}
	$check->setFetchMode(PDO::FETCH_ASSOC);
	   $check->execute();
	 $data= $check->fetchAll();
	 echo json_encode($data);
	  
}

public static function get_album(){
	 $db= new database();
	$id=$_POST['id'];
	//echo $id;
	$check=$db->select( "img,uid","photo_album","uid='$id'");
	
	$my_count=$check->rowCount();
	if($my_count>=1){
	$check->setFetchMode(PDO::FETCH_ASSOC);
	   $check->execute();
	 $data= $check->fetchAll();
	 echo json_encode($data);
	}
	 
}
//----------------------friends data for profile
public function friends_of_pro($user_pro){
	  $friend_data=self::get_user_friends($user_pro); 
	    $new=implode(",",$friend_data);
	 $new=explode(",",$new);
        echo json_encode($new);
		
}

public static function followers_of_pro($user){
	$db= new database();
	$check=$db->select("followed_by","follow","followed_to='$user'");
	if($check->rowCount()>=1){
		$data=$check->fetchAll();
		 echo json_encode($data);
	}
	//$followers_user=mysqli_query($connection,"SELECT *FROM follow WHERE followed_to='$username1'");
		
}
//-----------------------------------------Freinds data end---------------------------------------
// -----------------------------For check file------------------------------------------for home
public static function get_file_existance(){
	 $db= new database();
	  $file=$_POST['file'];
	  $max_width=$_POST['max_width'];
	 // echo $max_width;
	 if(file_exists("./public/userdata/cover_pics/$file")){
		 //if image in profile
		 list($width,$height)=getimagesize("./public/userdata/cover_pics/$file");
		   if($width>$max_width){
         $wdth=$max_width;
        $height1=($height/$width)*$wdth;
}else{
  $wdth=$max_width;
 $height1=($height/$width)*$wdth;

}      $new_arr="cover,$height1,$wdth";
      echo json_encode($new_arr);
	
		}elseif(file_exists("./public/userdata/data_pics/$file")){
		 
		 //if image in data
		 list($width,$height)=getimagesize("./public/userdata/data_pics/$file");
		   if($width>$max_width){
         $wdth=$max_width;
        $height1=($height/$width)*$wdth;
}else{
   $wdth=$max_width;
  $height1=($height/$width)*$wdth;

}      $new_arr="data,$height1,$wdth";
      echo json_encode($new_arr);
 //$value_array=array('dic'=>"profile",'height'=>"$height1",'width'=>"$wdth");
         // echo json_encode($value_array);
		
	 }elseif(file_exists("./public/userdata/profile_pics/$file")){
		 
		 //if image in profile
		 list($width,$height)=getimagesize("./public/userdata/profile_pics/$file");
		   if($width>$max_width){
         $wdth=$max_width;
        $height1=($height/$width)*$wdth;
}else{
   $wdth=$max_width;
   $height1=($height/$width)*$wdth;

}      $new_arr="profile,$height1,$wdth";
      echo json_encode($new_arr);
 //$value_array=array('dic'=>"profile",'height'=>"$height1",'width'=>"$wdth");
         // echo json_encode($value_array);
		
	 }else{
		 //If Image is broken
		 echo "noImage";
	 }
   
}



// -----------------------------For check file------------------------------------------for profile
public static function check_file(){
	
		 $db= new database();
	  $file=$_POST['file'];
	 if(file_exists("./public/userdata/cover_pics/$file")){
		 echo "cover";
		}elseif(file_exists("./public/userdata/data_pics/$file")){
		 echo "data";
		
	 }elseif(file_exists("./public/userdata/profile_pics/$file")){
		echo "profile";	 }else{
		 //If Image is broken
		 echo "noImage";
	 }
	 
}

//----------------------------------------------Check File end-------------------------------------
//----------------------------------System works------------------------------------
public static function fetch_like(){
	if(isset($_POST['uid'])){
	$db= new database();
	 $user=Session::get('user');
	 $uid=md5($_POST['uid']);
	$check1=$db->select("*","likes","uid='$uid' && username='$user'");
	 $check1->execute();
	  if($check1->rowCount()==1){
		  echo "yes";
	  }else{
		  echo "no";
	  }
	}else{
		echo "You should not be here .";
	}
	 
}
	  public static function fetch_like_all(){
		 
		  if(isset($_POST['uid'])){
	$db= new database();
	 $user=Session::get('user');
	 $uid=md5($_POST['uid']);
	$check1=$db->select("total_likes","user_likes","uid='$uid'");
	 $check1->execute();
	  if($check1->rowCount()==1){
		  $get=$check1->fetch();
		  echo $get['total_likes'];
	  }else{
		  echo 0;
	  }
		
		
}
	  }

public static function like(){
	$db= new database();
	 $user=Session::get('user');
	$uid=md5($_POST['uid']);
	
	 $check=$db->select("*","user_likes","uid='$uid' ");
	  $check->execute();
	if($check->rowCount()>=1){
		$check1=$db->select("*","likes","uid='$uid' && username='$user'");
	  $check1->execute();
	  if($check1->rowCount()==1){
		  $check1->setFetchMode(PDO::FETCH_ASSOC);
		  $check1->execute();
			 $get=$check1->fetch();
			 $total_l=$get['total_likes'];
	  }else{
		  $check2=$db->select("*","user_likes","uid='$uid'");
	  $check2->execute();
		  $check2->setFetchMode(PDO::FETCH_ASSOC);
		  $check2->execute();
			 $get=$check2->fetch();
			 $total_l=$get['total_likes'];
			 $total_l++;
			 
           $update=$db->update("user_likes","total_likes='$total_l'","uid='$uid'");
		   
	        $insert=$db->insert("likes","('','$user','$uid')");
	 	
       echo "Lifted up";	  
	  }
		
	}else{
		 $insert1=$db->insert("user_likes","('','1','$uid')");
		 
		 $insert2=$db->insert("likes","('','$user','$uid')");		
		
		   echo "Lifted up";
	}
	
}




public static function like_remove(){
	$db = new database();
	 $user=Session::get('user');
	$uid=md5($_POST['uid']);
	$check1=$db->select("*","likes","uid='$uid' && username='$user'");
	  $check1->execute();
	   if($check1->rowCount()==1){
		    $check2=$db->select("*","user_likes", "uid='$uid'");
	  $check2->execute();
		  $check2->setFetchMode(PDO::FETCH_ASSOC);
		  $check2->execute();
			 $get=$check2->fetch();
			 $total_l=$get['total_likes'];
			 $total_l=$total_l-1;
			  $insert2=$db->delete("likes","username='$user' && uid='$uid'");		
		
		 $update=$db->update("user_likes","total_likes='$total_l'","uid='$uid'");
	 
	   }
	 
	
}
//dislikes--------------------system work---------------------------------///
public static function fetch_dislike(){
	$db= new database();
	 $user=Session::get('user');
	 $uid=md5($_POST['uid']);
	$check1=$db->select("*","dislikes","uid='$uid' && username='$user'");
	  if($check1->rowCount()==1){
		  echo "yes";
	  }else{
		  echo "no";
	  }
	 
}


public static function fetch_dislike_all(){
	$db= new database();
	 $user=Session::get('user');
	 $uid=md5($_POST['uid']);
	$check1=$db->select("total_dislikes","user_dislikes","uid='$uid'");
	 $check1->execute();
	  if($check1->rowCount()==1){
		  $get=$check1->fetch();
		  echo $get['total_dislikes'];
	  }else{
		  echo 0;
	  }
	  
}

public static function dislike(){
	$db= new database();
	 $user=Session::get('user');
	$uid=md5($_POST['uid']);
	
	 $check=$db->select("*","user_dislikes","uid='$uid' ");
	 	if($check->rowCount()>=1){
		$check1=$db->select("*","dislikes","uid='$uid' && username='$user'");
	   if($check1->rowCount()==1){
		  $check1->setFetchMode(PDO::FETCH_ASSOC);
		  $check1->execute();
			 $get=$check1->fetch();
			 $total_disl=$get['total_dislikes'];
	  }else{
		  $check2=$db->select("*","user_dislikes","uid='$uid'");
	  	  $check2->setFetchMode(PDO::FETCH_ASSOC);
		  $check2->execute();
			 $get=$check2->fetch();
			 $total_disl=$get['total_dislikes'];
			 $total_disl++;
           $update=$db->update("user_dislikes", "total_dislikes='$total_disl'","uid='$uid'");
	  	  $insert=$db->insert("dislikes","('','$user','$uid')");
	  	
       echo "Lifted Down";	  
	  }
		
	}else{
		 $insert1=$db->insert("user_dislikes","('','1','$uid')");
		  
		 $insert2=$db->insert("dislikes","('','$user','$uid')");		
		
		   echo "Lifted Down";
	}
	
	 
}




public static function dislike_remove(){
	$db = new database();
	 $user=Session::get('user');
	$uid=md5($_POST['uid']);
	$check1=$db->select("*","dislikes","uid='$uid' && username='$user'");
	   if($check1->rowCount()==1){
		    $check2=$db->select("*","user_dislikes","uid='$uid'");
	  	  $check2->setFetchMode(PDO::FETCH_ASSOC);
		  $check2->execute();
			 $get=$check2->fetch();
			 $total_disl=$get['total_dislikes'];
			 echo "previous->".$total_disl;
			 $total_disl=$total_disl-1;
			 echo "after->".$total_disl;
			  $insert2=$db->delete("dislikes","username='$user' && uid='$uid'");		
		
		 $update=$db->update("user_dislikes","total_dislikes='$total_disl'","uid='$uid'");
			 
	   }
	
}
//del sys
public static function delete_post(){
	$db = new database();
	if(isset($_POST['id'])){
	$del_id=$_POST['id'];
	echo "
	<center><br>
	<label style='font-family:helvetica;font-size:15px; color:#777;word-wrap:break-word;'>Are you sure want to delete this ? Deleting a post cannot be reverse? </label><br><br><input type='button'  onclick='yes(".$del_id.",".'""'.")' id='yeah' style='margin-left:2px;'value='Yes'/> <input type='button' onclick='no()' id='nope'style='margin-left:2px;'value='No'/	></center>";
	}elseif(isset($_POST['del_id'])){
		$del_id_del=$_POST['del_id'];
	//	mysqli_query($connection,"DELETE FROM posts WHERE id='$del_id_del'");
		$check=$db->delete("posts","id='$del_id_del'");
		
		echo "<br><center><label style='font-family:helvetica;font-size:15px; color:#777;'>You post deleted</label></center>";
	}else{
		echo "Get lost";
	}
	
	}

	//share sys
public static function share_post(){
	$db = new database();
	if(isset($_POST['id'])){
	$share_id=$_POST['id'];
	$share="Share";
	echo "
	<center><br>
	<label style='font-family:helvetica;font-size:15px; color:#777;'>Click on yes to share this on your post stream. </label><br><br><input type='button'onclick='yes(".$share_id.",".'"'.$share.'"'.")' id='yeah' style='margin-left:2px;'value='Yes'/> <input type='button' onclick='no()' id='nope'style='margin-left:2px;'value='No'/	></center>";
	}elseif(isset($_POST['del_id'])){
		echo "Post Successfully shared on your stream.";
	}else{
		echo "Get lost";
	}
	
	}

//----------------------------------------------Stick it///////////////////

public function stick_it(){ 
    $db = new database();
	 $user=Session::get('user');
	 $last_id="";
	 $date_added =  date('l\, F jS\, Y ');// Date on added
    $added_by = $user;   // added By
    $user_posted_to = $user;  // added to
	$time=time();
	
	if(isset($_POST['post'])){
		$post=$_POST['post'];
	}else{
		$post="";
	}
	// die;
	
	$file=count($_FILES)-1;
	if($file>0){  
        	// If there is an Image
	for($i=0;$i<count($_FILES)-1;$i++){
	   if (((@$_FILES["pic".$i]["type"]=="image/jpeg") || (@$_FILES["pic".$i]["type"]=="image/png") || (@$_FILES["pic".$i]["type"]=="image/gif")||(@$_FILES["pic".$i]["type"]=="image/jpg")||(@$_FILES["pic".$i]["type"]=="image/png"))&&(@$_FILES["pic".$i]["size"] < 4048576)){

		   $chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			  $rand_dir_name = substr(str_shuffle($chars), 0, 30);
			  if(!mkdir('./public/userdata/data_pics/'.$rand_dir_name)){
			     echo "Cannot make directory";
			  } 
			   if (file_exists('./public/userdata/data_pics/'.$rand_dir_name.'/'.@$_FILES["pic".$i]["name"])){
                 echo @$_FILES["pic".$i]["name"]." Already exists";
                }  else{// if Directory exists
                       $temp = explode(".", $_FILES["pic".$i]["name"]);
                       $newfilename = round(microtime(true)) . '.' . end($temp);
                      move_uploaded_file(@$_FILES["pic".$i]["tmp_name"],'./public/userdata/data_pics/'.$rand_dir_name.'/'.$newfilename);
                   $post_pic = @$newfilename;
			  
			 
			  
			  if ($post_pic!=""){	 
    if($file>1){//if there are more that 1 file
		if($i>=1){
			if($last_id!=""){
			 $insert1=$db->insert("photo_album","('','Enter your description','$rand_dir_name/$post_pic','$last_id','$added_by')");
			}else{
				echo "Last ID is null";
			}
		}else{
   $insert1=$db->insert("posts (body,date_added,added_by,user_posted_to,post_image)","('$post','$date_added','$added_by','$user_posted_to','$rand_dir_name/$post_pic')");
	$last_id = $db->lastInsertId();
	
	}

	}else{
   $insert1=$db->insert("posts (body,date_added,added_by,user_posted_to,post_image)","('$post','$date_added','$added_by','$user_posted_to','$rand_dir_name/$post_pic')");
	  
	
	}
	echo "Successfully posted on your timeline";
	
	}  //If there is a pic this will be executed
		 
		
        }//End of directory else
		  
 }else{  
 // if File type is not valid
	 echo "Invalid File->";
 }
	}// For loop Ended
		
	}else{// Check IF there is Image File If not then this else will execute
		if($post==""){  // If the Post field is empty even when there is no image
			echo "You havent edited anything, Please, be carefull while Posting ;) ";
		}
		else{
	       $insert2=$db->insert("posts (body,date_added,added_by,user_posted_to,post_image)","('$post','$date_added','$added_by','$user_posted_to','Nothing')");
		   Echo "Successfully posted on your Timeline";
		}
		
	
	}
	
}// Function Ended


public static function get_active_user(){
	self::update_time();
	if(isset($_POST['data'])){
		$db = new database();
	 $user=$_POST['data'];
	 $time=time();
	
			$select=$db->select("followers_count","myusers","username='$user'");
		 if($select->rowCount()>=1){
			 $get= $select->fetch();
			 $lastSeen=$get['followers_count'];
		//	echo  exit();
		//$time=time();
		 //echo date('Y-m-d h:i:s', $lastSeen
		
		 if( time()-$lastSeen>=8){
				 echo "offline";
			 }else{
				 echo "online";
			 }
		 }
		}
		
	 
	
}



private static function update_time(){
	
	$db = new database();
	$user=Session::get('user');
	$time=time();
	$query=$db->update("myusers","followers_count='$time'","username='$user'");
	 
}
	
	

	}// Class Ended
   

?>