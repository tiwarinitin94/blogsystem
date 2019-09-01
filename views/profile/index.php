<?php 
    $title="";
    if(isset($this->data_profile)){
		 //print_r($this->data_profile['title']);
		if($this->data_profile['title'] ==""){
			  echo "No title  found";		 
			 
			 
		}else{
			  
               $title=$this->data_profile['title'];
			   $htmlData=$this->data_profile['html_val'];
		}	
				  
	}else{
		echo "<script>alert('Something went terribly wrong');</script>";
	  die();
	}
	
    	
?>




<div class="content">
<div id="wrapper" style="margin-top:90px; padding-bottom:10%;">
  <div class="row">
  
  
   <div class="col-sm-8">
   
  <!----left row begin ------>
  
  <strong style="font-size:30px;padding:10px;"><?php echo $title;?></strong>
  <div id="Post" style="padding:10px;">
    <?php echo html_entity_decode($htmlData); ?>
  </div>
  

<!----left row ended ------>


</div>


 <div class="col-sm-4">
 <!----right row begin------>
 

<!----right row ended------>
</div>

</div>
</div>
</div>
<div style="display:none;">