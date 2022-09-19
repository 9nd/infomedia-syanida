
	var slideIndex = 1;
	var count_img=0;
	var content_slider="";
	var dot_content = "";
	var xc =0;
	var source_content ="";
	
	$(".ybs-image-slider").click(function(){
		slideIndex = 1;
		count_img=0;
		content_slider="";
		dot_content = "";
		xc =0;
		
		var a = $(this).attr("data-image");
		var b = a.split(','); 
	
		source_content = $(this).attr("data-source");
		count_img = b.length-1;
		
		
		if(b.length==1){
			var src  = $(this).attr("src");
			var caption = $(this).attr("data-image");
			create_single_content(src,caption);
		}else{
			b.forEach(create_content);
		}
		
		create_preview();

	});
	
	

	
	function create_preview(){
		var e = document.createElement('div');
		e.id = "ybs-modal-slider";
		e.classList.add('modal-image');
		e.innerHTML = '	<span class="close-image" data-dismiss="modal">&times;</span>' +
					  '	<div class="slideshow-container">'+
						 content_slider +
					  ' <a class="slider-prev" onclick="plusSlides(-1)">&#10094;</a>'+
					  ' <a class="slider-next" onclick="plusSlides(1)">&#10095;</a>'+
					  ' </div>'+
					  ' <br>'+
					  ' <div style="text-align:center">'+
							dot_content + 
					  ' </div>';
		e.style.display = "block";				
		$('#ybs-modal-slider').remove();
		$('.content-general').append(e);
		
		//var modal = document.getElementById('ybs-modal-slider');
		var span = document.getElementsByClassName("close-image")[0];
		
		// When the user clicks on <span> (x), close the modal
		span.onclick = function() { 
		e.style.display = "none";
		}
		
		
		showSlides(slideIndex);
	}
	

	function create_content(item){
		xc++;
		var caption = item.toString().replace('.jpg','');
		caption = caption.toString().replace('.png','');
		
		if(item !==""){
			content_slider += '<div class="ybs-slider">'+
					   '	<div class="slider-caption-text">'+caption+'</div>'+
					   '	<div class="slider-numbertext">'+xc+' / '+ count_img+'</div>'+
					   '	<img src="'+source_content+'/'+item+'" class="modal-content-image">'+
					   ' 	</div>';
					   
			dot_content +=  '<span class="slider-dot" onclick="currentSlide('+xc+')"></span> ';
		}
	}
	
	function create_single_content(item,caption){
		xc++;
		
		if(item !==""){
			content_slider += '<div class="ybs-slider">'+
					   '	<div class="slider-caption-text">'+caption+'</div>'+
					   '	<img src="'+item+'" class="modal-content-image">'+
					   ' 	</div>';
					   
			//dot_content +=  '<span class="slider-dot" onclick="currentSlide('+xc+')"></span> ';
		}
	}
	




//===================================



	// Next/previous controls
	function plusSlides(n) {
	  showSlides(slideIndex += n);
	}

	// Thumbnail image controls
	function currentSlide(n) {
	  showSlides(slideIndex = n);
	}

	function showSlides(n) {
	 try{
		  var i;
		  var slides = document.getElementsByClassName("ybs-slider");
		  var dots = document.getElementsByClassName("slider-dot");
		  if (n > slides.length) {slideIndex = 1} 
			  if (n < 1) {slideIndex = slides.length}
			  for (i = 0; i < slides.length; i++) {
				  slides[i].style.display = "none"; 
			  }
		  for (i = 0; i < dots.length; i++) {
			  dots[i].className = dots[i].className.replace(" slider-active", "");
		  }
		  slides[slideIndex-1].style.display = "block"; 
		  dots[slideIndex-1].className += " slider-active"; 
	 }catch(error){
		 
	 }		
	 
	}

