<?php Session::init();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US"><html><head><meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="Content-Language" content="english and hindi">
<meta name="rating" content="general"><title> Waayoo</title>
 <?PHP  
   $logged="";
 $logged=Session::get('loggedin'); 
 $user=Session::get('user');
 $user_id=Session::get('id');
?>

<link href="<?php echo URL;?>public/images/vaarta_ico.ico" rel="icon" type="image/x-icon" ></link>
<link rel="stylesheet" href="<?php echo URL;?>public/css/bootstrap.min.css"></link>
<link rel="stylesheet" href="<?php echo URL;?>public/css/style.css"></link>
<link rel="stylesheet" href="<?php echo URL;?>public/css/mobile.css"></link>

<script type="text/javascript" src="<?php echo URL;?>public/js/jquery-1.14.2.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>public/js/jquery.expandable.js"></script>
<?php  if($logged){
		?>
	
	<?php
}?>
<script type="text/javascript" src="<?php echo URL;?>public/js/default.js"></script>
<script type="text/javascript" src="<?php echo URL;?>public/js/encrypt.js"></script>
<script type="text/javascript" src="<?php echo URL;?>public/js/bootstrap.min.js"></script>

 
<?php
if(isset($this->js)){
	   foreach($this->js as $js){
	   echo '<script type="text/javascript" src="'.URL.'views/'.$js.'?hello"></script>';
   }
   }
   
   //&#8592;
?></head><body><div id="myModal2" class="modal2"> <div class="modal-content"><div style="clear:both; overflow:hidden;"><span  id="close2" style="cursor:pointer;float:left;font-weight:bold;"><img src="<?php echo URL;?>public/images/back.png" width="30"/></span></div><div id="mymodalc"></div></div></div>



<?php if(!isset($this->main)){ ?>
<div class="header20"style=" z-index:2;width:100%;">
<div id="wrapper">
 


 <div id="header_vrt"> 
			
	
<?php  if($logged==false){// If not Logged in 
	?> 
 <a href="<?php echo URL;?>gallery_area/" title="Home" /><img src="<?php echo URL;?>public/images/home_vrt.png" height="30" width="30"/></a>
 <a href="<?php echo URL;?>about" title="About Vaarta" >About</a>
 <a href="<?php echo URL;?>login">Login</a>
 <a href="" title="Games" ><img src="<?php echo URL;?>public/images/game_vrt.png" height="30" width="30"/></a><a href="" title="Videos" ><img src="<?php echo URL;?>public/images/video_vrt.png" height="30" width="30"/></a><?php 
 }
 else{




 // If Logged in 
?>  <a href="<?php echo URL;?>gallery_area/" title="Home" /><img src="<?php echo URL;?>public/images/home_vrt.png" height="30" width="30"/></a>
<a href="<?php echo URL."write";?>" title="Post"> <img src="<?php echo URL;?>public/images/msg.png" style="width:50px;padding:10px; "/></a>
		           

            <a href="<?php echo URL;?>gallery_area/logout"><img src="<?php echo URL;?>public/images/logout_vrt.png" height="30" width="30"/></a>
			<?php }?>
			
   </div>
  

   
   </div></div> <?php }?>
<?php  if($logged){?>
<script>var user_logged="<?php echo $user;?>"; </script>
<?php }?>