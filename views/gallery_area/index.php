<style>
#postWrapper{
	padding:15px;
	width:100%;
	border-bottom:.1px solid #dfdfdf;
	clear:both;
}
.bottomLink{
	color:#bfbfbf;
	padding:5px;
	
}
</style>
<div class="content">

<div id="wrapper" style="width:100%;margin-top:100px; padding-bottom:10%;">

<div class="row" style="background:#fff;border:.1px solid #efefef;">
<!---------Left Side content --->
  
  
  <div class="col-sm-2" style="padding:10px;">
   <ul class="nav nav-pills nav-stacked">
  <li class="active" id="all_post"><a href="?check=all_post">All Post</a></li>
 
  <li id="drafts"><a href="?check=drafts">Drafts</a></li>
  <li id="published"><a href="?check=published">Published</a></li>
 
</ul>


  <!---Left Side content Ended --->
  </div>
  
  
  <div class="col-sm-10" style="padding:10px;border-left:.1px solid #efefef;">

  <!---RightSide content --->
  
    <div id="showPost"></div>
  
     <script>
	     
	     function loadPosts(valCheck){

			  document.getElementById('showPost').innerHTML="";			 
			 $.get(url_vrt+'gallery_area/posts_of_user/'+valCheck,function(o){			 
			 
			// console.log(o);
			 
			if(o!=""){
				
				
			  for(var i=0; i<o.length;i++){
               
			     document.getElementById('showPost').innerHTML+=`<div id='postWrapper'>
				 <a href='#' style='padding:10px;'>`+o[i].title+`</a><br>
				 <a href='`+url_vrt+`write?id_val=`+o[i].p_id +`' class="bottomLink" >Edit /</a>
				 <a  class="bottomLink" onclick='del(`+o[i].id +`)' href='#'>Delete /</a>
				 <a class="bottomLink"	href='`+url_vrt+o[i].p_id+`' target="_blank">View /</a>
				 
				 <div></div>
				 
				 </div>`;
			   
			  }
			  
			  
			}else{
				
			}
			
		   },'json');
			 
		 }


		 function del(idVal){
			 console.log(idVal);
			 
			
			var formData = new FormData();
			formData.append('postId',idVal);

			
			
			$.ajax({
				url:url_vrt+"gallery_area/delPost",
				type:"POST",
				data:formData,
				contentType: false,
				cache: false,
				processData:false,
				success:function(data){
                     location.reload();
				}
			});

		 }
		
	 


         window.addEventListener("load",function(){
			 <?php

			 if(isset($_GET['check'])){
				 $page_val=$_GET['check'];

				 if($page_val=="all_post"){
					 echo "

					 $('.active').removeClass('active');

					 $('#all_post').addClass('active');

					      loadPosts(0);
					 ";
				 }elseif($page_val=="drafts"){

					echo "
					loadPosts(1)

					$('.active').removeClass('active');

					$('#drafts').addClass('active');


					";

				 }elseif($page_val=="published"){

					echo "

					$('.active').removeClass('active');

					$('#published').addClass('active');

					loadPosts(2);
					
					
					";

				 }
			 }else{
				 echo 'loadPosts();';
			 }

			 ?>
			 
		 },false);
      
      </script>	 
     
      
  
  <!---Right Side content ended--->
  
  </div>

</div>
</div>
</div>
<div style="display:none;">
