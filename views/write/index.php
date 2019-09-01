

<style>
.not_active_url{
	pointer-events:none;
	background:#afafaf;
}
#textEditor{
	
	margin:0 auto;
	width:80%;
	height:700px;
	
}
#theRibbon{
	
	border-bottom:none;
	padding:10px;
	color:#000000;
	border-radius:8px 8px 0px 0px;
	
}

#richTextArea{
	border:.1px solid #9f9f9f;
	height:70%;
	width:100%;
}

#theWYSIWYG{
	height:100%;
	width:100%;
	
}

#theRibbon button,#editURL{
	
	color:#9f9f9f;
	border:none;
	outline:none;
	background-color:transparent;
	cursor:pointer;
	
}
#theRibbon button:hover,#editURL:hover{
	background-color:#bfbfbf;
	transition:all .3 ease in out;
	color:#ffffff;
}

input[type="color"]{
	border:none;
	outline:none;
	background-color:transparent;
}
#fontChanger,#fontSizeChanger{
	width:auto;
}
</style>
<script>
  var getLastId="";  //Will fetch the last user post ID

  var editorTextSet;   //Main editor tool

  var titleTextSet;    //title Editor tool

  var urlTextSet;      //Url Editor Tool

  var urlCreate=0;      //Url creating flag

  var validUrl=0;      //Valid url flag

  var htmlValue="",visualValue="";   //HTML or Visual values

  var htmlMode=0;        //HTML mode flag

  var post_unique_id="";    //Posts unique id

  var savedPost=1;

  var currentUniquestId='';//unchangable Unique id for each post 
   
 

 
       window.addEventListener("load",	function () {
		   
			 var editor=theWYSIWYG.document;

			 editorTextSet=document.getElementById("theWYSIWYG");  //Editor

			 titleTextSet=document.getElementById("title");  //Title Editor

			 urlTextSet=document.getElementById("url");    //Url Editor



			 


			  <?php
			  
			  //echo $_GET['id_val'];
			  $url_val="";
			  
			  
			  if(isset($_GET['id_val'])){
				$url_val=$_GET['id_val'];
				  echo "
				  document.getElementById('publish_val').style.display='none';
				  document.getElementById('update_val').style.display='block';
				  $.ajax({
					   url:url_vrt+'write/check_edit/$url_val',
					   dataType:'json',
					   success:function(data){
						   //data=data.trim().replace(/[0-9]/g, '');
						   titleTextSet.value=data.title;
						   urlTextSet.value=data.p_id;

						   $('#tagValueOfPost').val(data.tags);

						   //console.log(data.date.split(' ')[0]);
						   $('#date_post').val(data.date.split(' ')[0]);
						   editorTextSet.contentWindow.document.body.innerHTML=htmlDecode(data.html_val);
						   visualValue=htmlDecode(data.html_val);
						   htmlValue=data.html_val;
						   post_unique_id=data.id;
						   currentUniquestId=post_unique_id;

						
						}
					  });  
					   ";
				}else{
					echo "document.getElementById('update_val').style.display='none';
					      document.getElementById('publish_val').style.display='block';
					";

				}
				

               ?>


             //For instant value of editor
			editorTextSet.contentWindow.document.body.onkeyup=function(event) {

				//console.log(event.target.innerHTML);

				$('.not_active_url').removeClass('not_active_url');
								
				//$('#saved').addClass('active');
				$('#valueSave').html("Save");

				savedPost=0;
				
				

			};

			var timer = null;

			editorTextSet.contentWindow.document.body.onkeydown=function(event) {
											
				clearTimeout(timer);
                timer = setTimeout(doStuff, 5000);
				  
				
				
			
			};




			
			 

			 $.ajax({
				 url:url_vrt+"write/lastId",
				 success:function(data){

					 document.getElementById("Iamhidden").innerHTML=data;
					 getLastId=data;

				 }
			 }).done(function(){
				 getLastIdValue();
			 })




			 editor.designMode="on";

			 boldButton.addEventListener("click",function(){
				   editor.execCommand("Bold",false,null);
			 },false);

			 italicButton.addEventListener("click",function(){
				 editor.execCommand("Italic",false,null);
			},false);

			supButton.addEventListener("click",function(){
				 editor.execCommand("Superscript",false,null);
			},false);

			subButton.addEventListener("click",function(){
				 editor.execCommand("Subscript",false,null);
			},false);

			strikeButton.addEventListener("click",function(){
				 editor.execCommand("Strikethrough",false,null);
			},false);

			orderedListButton.addEventListener("click",function(){
				editor.execCommand("InsertOrderedList",false,null); 
			},false);

			unorderedListButton.addEventListener("click",function(){
				editor.execCommand("InsertUnorderedList",false,null); 
			},false);

			fontColorButton.addEventListener("change",function(event){
				editor.execCommand("ForeColor",false,event.target.value); 
			},false);

			highlightButton.addEventListener("change",function(event){
				editor.execCommand("BackColor",false,event.target.value); 
			},false);

			fontChanger.addEventListener("change",function(event){
				 editor.execCommand("FontName",false,event.target.value);
			},false);

			fontSizeChanger.addEventListener("change",function(event){
				 editor.execCommand("FontSize",false,event.target.value);
			},false);


			linkButton.addEventListener("click",function(event){
				var url=prompt("Enter a Url","http://");
				 editor.execCommand("CreateLink",false,url);
			},false);

			unlinkButton.addEventListener("click",function(event){
				 editor.execCommand("UnLink",false,null);
			},false);

			undoButton.addEventListener("click",function(){
				editor.execCommand("undo",false,null);
			},false);

			redoButton.addEventListener("click",function(){
				editor.execCommand("redo",false,null);
			},false);


			image_file.addEventListener("change",function(event){
				if (this.files && this.files[0]) {
					 var img = document.querySelector('img');  // $('img')[0]
					 img.src = URL.createObjectURL(this.files[0]); // set src to file url
					 
					 var newImage = document.createElement("img");
					 newImage.src = img.src;
					 newImage.style.width="200px";
					 
					 uploadImage(newImage);

					 // img.onload = imageIsLoaded; // optional onload event listener
			    }

			},false);

			htmlVal.addEventListener("click",function(){

				var x=editorTextSet.contentWindow.document.body.innerHTML;
				

				if(htmlMode==0){

					htmlValue=htmlEndode(x);
					visualValue=x;


				}else{
					htmlValue=x;
					visualValue=htmlDecode(x);
				}

				htmlMode=1;

				//console.log(htmlValue);

				editorTextSet.contentWindow.document.body.innerHTML=htmlValue;


			},false);


			visualVal.addEventListener("click",function(){
				var x=document.getElementById("theWYSIWYG").contentWindow.document.body.innerHTML;
				
				if(htmlMode==0){
						htmlValue=htmlEndode(x);
						visualValue=x;
						
					}else{
						htmlValue=x;
						visualValue=htmlDecode(x);

					}

					htmlMode=0;

					editorTextSet.contentWindow.document.body.innerHTML=visualValue;

					//console.log(visualValue);
			 },false);


			 editURL.addEventListener("click",function(){
				   $("#url").toggle(300);
				   createUrl();
			 },false);


			 tags.addEventListener("click",function(){
				   $("#tags_view").toggle(300);
				   
			 },false);

			 dateAdd.addEventListener("click",function(){
				   $("#date_add").toggle(300);
				   
			 },false);

			 


	   },false);


function doStuff(){
	if(savedPost==0){
		$('#valueSave').html("Saved");
		$('#valueSave').addClass('not_active_url');

		publishPost(1);
	}


}

function createUrl(){

	currentTitle=titleTextSet.value;

	if(currentTitle!="" && urlCreate==0){

		currentUrl=currentTitle.split(" ").join("-");

        urlTextSet.innerHTML+=currentUrl;

		urlCreate=1;
	}

}


function checkUrl(UrlVal){
    // console.log(UrlVal);
	<?php 

	


		
		echo "
		     if(UrlVal!='$url_val'){
		
		";
	
     ?>
	$.ajax({
		url:url_vrt+"write/checkUrl/"+UrlVal+"/1",
		success:function(data){
			
			if(data.trim()>0){
				console.log(data);
				document.getElementById("error").innerHTML="Link ALready Exist";
				document.getElementById("error").style.display="block";
				//model("<center>Link Already Exist.</center>");
				validUrl=1;
			}else{
				validUrl=0;
				document.getElementById("error").innerHTML="";
				document.getElementById("error").style.display="none";
			}
		}
	});

	<?php
          echo "}";
	?>

}

function htmlEndode(value){
	val=$("<textarea/>").html(value).html(); 

	return val;
}

function htmlDecode(value){
	val=$("<textarea/>").html(value).val();

	return val;
}


function getLastIdValue(){
	
	document.getElementById('url').innerHTML=getLastId.trim();
}


function uploadImage(newImage){

	var file_image = $('#image_file').prop('files')[0];   
        var form_data = new FormData(); 
		form_data.append('image_f', file_image);
		

	$.ajax({
		url:url_vrt+"write/addImage_media",
		type:"POST",
		data:form_data,
		contentType: false,
        cache: false,
        processData:false,
		success:function(data){

			 newImage.src=url_vrt+"public/userdata/media_blog/"+data;
			 document.getElementById("theWYSIWYG").contentWindow.document.getElementsByTagName("body")[0].appendChild(newImage);
			
		}
	});
}

function updatePost(checkVal){
	var form_data = new FormData();
	     
		 if(titleTextSet.value.trim()!=""){
	
	       form_data.append('title', titleTextSet.value);
			
			form_data.append('url',urlTextSet.value);

			console.log("curr "+currentUniquestId);
            if(post_unique_id==""){
				post_unique_id=currentUniquestId;
			}
			form_data.append('u_id',post_unique_id);

			form_data.append('published',checkVal);
			
			if(htmlMode==1){
				form_data.append('val',editorTextSet.contentWindow.document.body.innerHTML);
			}else{
				form_data.append('val', htmlEndode(editorTextSet.contentWindow.document.body.innerHTML));
			}

			$.ajax({
					 url:url_vrt+"write/updatePost",
					 type:"POST",
					 data:form_data,
					 contentType: false,
					 cache: false,
					 processData:false,
					 success:function(data){
						 if(checkVal==0){
						 	if(data.trim().replace(/[0-9]/g, '')=="success"){
								 modal("<center>Your post is successfully Updated. </center>");
								}
						 }
					       }
					});

		 }else{
			 modal("<center>Please Enter a Title</center>")
		 }

}




function publishPost(checkVal){
	if(currentUniquestId==''){
	var form_data = new FormData();
	createUrl();
	
	sendurl=url_vrt+"write/publishVal";
	
	if(validUrl==0){
		if(titleTextSet.value.trim()!=""){

			form_data.append('title', titleTextSet.value);
			
			form_data.append('url',urlTextSet.value)

			form_data.append('published',checkVal);  // For check if publishing or saving as draft
			
			if(htmlMode==1){
				form_data.append('val',editorTextSet.contentWindow.document.body.innerHTML);
			}else{
				form_data.append('val', htmlEndode(editorTextSet.contentWindow.document.body.innerHTML));
			}
				//console.log(titleTextSet.value);
				//console.log(urlTextSet.value);
				//console.log(editorTextSet.contentWindow.document.body.innerHTML);
				 $.ajax({
					 url:sendurl,
					 type:"POST",
					 data:form_data,
					 contentType: false,
					 cache: false,
					 processData:false,
					 success:function(data){
						     if(checkVal==0){
						 	if(data.trim().replace(/[0-9]/g, '')=="success"){
								 modal("<center>Your post is successfully Published. </center>");
								}

							 }else{
								 //Get last ID here

								var num = data.match(/-?\d+\.?\d*/);
								currentUniquestId=num;

							 }
					       }
					});
		}else{
			if(checkVal==0){
			modal("<center>Please Enter a title. </center>");
			}
		}

	}else{
			modal("<center>Please Enter a Valid URL . </center>");
		}

	}else{
		//Write code for updating new ID
		console.log('update code Draft');

		<?php
        
		if(isset($_GET['id_val'])){
		echo 'checkVal=2';   //Updating post that is inserted
		  }
		
		  
		  ?>

		  updatePost(checkVal); 
	}
}




function loadMedia(){
	
	 
	imgHtml=''
	$.ajax({
		url:url_vrt+"write/addImage_mediaFromSRC",
		type:"POST",
		//data:form_data,
		contentType: false,
        cache: false,
        processData:false,
		success:function(data){


			var data = $.parseJSON(data);

			for (i=0;i<data.length;i++){
				console.log(data[i].src);

				imgHtml+="<img onclick='selectImage(this)'src='"+url_vrt+"public/userdata/media_blog/"+data[i].src+"' width='100'/>";
			}

			modal("<div><center>"+imgHtml+"</center></div><br><center><button onclick='addImageToPost()'>Add Image</button></center>");
			//console.log(data);
		}
	});
    
	 

}



function selectImage(imageVal){

	//console.log(imageVal.src);

	//$('.selectedImage').removeClass('not_active_url');

	if(imageVal.className=='selectedImage'){
		imageVal.className='';
	}else{

		imageVal.className='selectedImage';

	}
								
    

}


function addImageToPost(){
	var x = document.getElementsByClassName("selectedImage");

	
      console.log(x.length); 
        for (i = 0; i < x.length; i++) {
			x[i].style.width='200px';
			console.log("i->"+ i);
			document.getElementById("theWYSIWYG").contentWindow.document.body.appendChild(x[i]);
        }
}



</script>

<!------------for selected image in model don't change style below------------->

<style>
.selectedImage{
	filter: brightness(0.4);
	border: 3px solid blue;
}



</style>




<div id="Iamhidden" style="display:none;"></div>

<div class="content" style="clear:both;width:100%;height:600px;margin-top:80px; padding-bottom:10%;">



<div class="row" style="clear:both;height:auto;background:#fff;border:.1px solid #efefef;">


<!---Left side content started---------------------------->

 <div class="col-sm-10" style="padding:10px;border-left:.1px solid #efefef;">
  <div id="textEditor">
  <textarea tabindex="1" id="title" name="title" placeholder="Title" aria-label="Edit title" rows="1" style="font-style:bold;font-size:15px;overflow: hidden; overflow-wrap: break-word; height: 62px;padding:10px;"></textarea>
  <button id="editURL" style="border:.1px solid #9f9f9f;">URL</button>
  <textarea onkeyup="checkUrl(this.value)" tabindex="1" id="url" placeholder="URL" aria-label="Edit Url" rows="1" style="border:.1px solid #999;display:none;font-style:bold;font-size:15px;overflow: hidden; overflow-wrap: break-word; height: 62px;padding:10px;"></textarea>
  <div id="error" style="display:none;"></div>
       <div id="theRibbon" >
	      <button id="boldButton" title="Bold"><b>B</b></button>
		  <button id="italicButton" title="Italic"><em>I</em></button>
		  <button id="supButton" title="Superscript">X<sup>2</sup></button>
		  <button id="subButton" title="Subscript">X<sub>2</sub></button>
		  <button id="strikeButton" title="Strikethrough"><s>abc</s></button>
		  <button id="orderedListButton" title="Number List">(i)</button>
		  <button id="unorderedListButton" title="Bulleted List">&bull;</button>
		  <input type="color" id="fontColorButton" name="fontColorButton" title="Change Font Color"/>
		  <input type="color" id="highlightButton" name="highlightButton" title="Highlight Text"/>
		  
		  <select id="fontChanger"name="fontChanger">
		     <option value="Times New Roman">Times New Roman</option>
			 <option value="Calibri">Calibri</option>
			 <option value="Verdana">Verdana</option>	
			 <option value="Cursive">Cursive</option>
		  </select>

		  <select id="fontSizeChanger" name="fontSizeChanger">
		     
			 <script>
			     for(var i=1;i<=10;i++){
					 
					 document.write("<option value='"+i+"'>"+i+"</option>")
				 }
			 
			 
			 </script>
		  
		  
		  </select>

		   <button id="linkButton" title="Link Button">Link</button>

		   <button id="unlinkButton" title="Unlink Button">Unlink</button>

		   <button id="undoButton"name="undoButton" title="Undo The Action">&larr;</button>
		   <button id="redoButton" name="redoButton" title="Redo">&rarr;</button>

		   <button id="insertImage" onclick="document.getElementById('image_file').click();"name="insertImage" title="Insert Image"><img style="margin-bottom:2px;width:20px;padding:1px;height:20px;"src="<?php echo URL;?>public/images/img.png"  /> </button>
		   <input type="file" name="image_file" id="image_file" accept="image/*" style="display:none" />

		   <button id="htmlVal">HTML</button>/<button id="visualVal">Visual</button>


		  
		  
		  </div>
       <div id="richTextArea">
	  
	      <iframe id="theWYSIWYG" name="theWYSIWYG" frameborder="0">
		     
		  </iframe>
	   </div>
   </div>

   
    <script>
		var fonts=document.querySelectorAll("select#FontChanger > option");
		for(var i=0;i<fonts.length;i++){
			fonts[i].style.fontFamily=fonts[i].value;
		}

        
		function updateTagPost(){

		var tags=$('#tagValueOfPost').val();

		var formData = new FormData();

		formData.append('postId',currentUniquestId);
        formData.append('postdata',tags);
		$.ajax({
		url:url_vrt+"write/updateTag",
		type:"POST",
		data:formData,
		contentType: false,
        cache: false,
        processData:false,
		success:function(data){
                
		}
	    });
    

		}


		function revertDraft(){

			
			var formData = new FormData();
			formData.append('postId',currentUniquestId);
			
			$.ajax({
				url:url_vrt+"write/revertdraft",
				type:"POST",
				data:formData,
				contentType: false,
				cache: false,
				processData:false,
				success:function(data){

				}
			});

		}


		function setDatePost(){

			var dateData=$('#date_post').val();
			var formData = new FormData();
			formData.append('postId',currentUniquestId);

			formData.append('post_date',dateData);
			
			$.ajax({
				url:url_vrt+"write/updateDatePost",
				type:"POST",
				data:formData,
				contentType: false,
				cache: false,
				processData:false,
				success:function(data){

				}
			});

		}


		



   </script>
   
 
   </div>
  <!---Left side content ended---------------------------->

<style>
.nav li a:hover{
	
	background:transparent;
}

.nav li:hover{
    border:.1px solid #000000;
}

.nav li{
	border:.1px solid #dfdfdf;
}


</style>
  <!---Right side content started---------------------------->
   <div class="col-sm-2" style="padding:10px;">
     <ul class="nav nav-pills nav-stacked">
	 <li id="update_val" onclick="updatePost(0)"><a href="#">Update</a></li>
	 <li id="publish_val" onclick="publishPost(0)"><a href="#" >Publish</a></li>
	   <li  onclick="loadMedia()"id="media"><a href="#">Media</a></li>
	   <li id="tags"><a href="#">Tags</a></li>
	   <div id="tags_view" style="display:none;">
	   <textarea id='tagValueOfPost'placeholder="Enter Tags seperate with comma" onchange="updateTagPost()"  height="40px" style="padding:5px;margin:10px 0px;width:100%;border:.1px solid #777;"></textarea>
	   </div>
	   <li id="dateAdd"><a href="#">Add Date</a></li>
	   <div id="date_add" style="display:none;">
	   <input onchange='setDatePost()' style="width:100%"type="date" id='date_post'/>
	   
	    </div>
	   <li id="saved" class="not_active_url"><a href="#" id="valueSave"style="pointer-events:none;">Saved</a></li>
	   <li id="revertDraft" onclick="revertDraft()"><a href="#">Revert to Draft</a></li>
	   </ul>
   </div>

   <!---Right side content ended---------------------------->
</div>
</div>
	</div>
	
	
	<div style="display:none">
	