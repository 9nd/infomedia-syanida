 $("#sidebar-btn-header").click(function(e) {
				e.preventDefault();
				$("#container-sidebar").toggleClass("toggled");
			 });
			
			 $("#sidebar #btn-container").click(function(e){
				 e.preventDefault();
				if($("#container-sidebar").hasClass("hide-container") && $("#container-sidebar").hasClass("mini") && $("#container-sidebar").hasClass("toggled")){
					$("#container-sidebar").toggleClass("mini");
					$("#container-sidebar").toggleClass("toggled");
				}else{
					$("#container-sidebar").toggleClass("mini");
				}
				
			
});


$(".menu-item").click(function(e){
	$(this).toggleClass("toggled");
	$(this).next().toggleClass("toggled");
});

$(".menu-item").hover(
	function(e){
		
		var x = $("#container-sidebar.open-container.toggled #sidebar").css("width");
		if(x=="60px"){
			//$(this).toggleClass("show-submenu");
			var li = $(this).closest('li');
			$(li).addClass("show-submenu");
		}
	}
);

