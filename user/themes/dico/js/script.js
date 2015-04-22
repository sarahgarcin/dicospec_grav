$(document).ready(function(){

	var $dialog = $("#dialog");
	var $popWidth = $(window).width() / 4	;
	var $definition = $('.definition-list li a');

	// Display definition excerpt when hover definition name
	// $definition.mouseenter(function(){
	// 	$(this).children("p").show();
	// });
	// $definition.mouseleave(function(){
	// 	$(this).children("p").hide();
	// });


	// Open definition 
	function OpenPopup($link, $this) {
		$dialog.dialog({
    	autoOpen: false,
    	appendTo: ".container",
    	position: { my: "left top", at: "left top", of: $this },
    	closeText: "x",
    	modal: true,
    	// height: $popHeight,
    	width: $popWidth,  
	 	});
	 	$dialog.load($link + " .container");
		$dialog.dialog('open');


		//Close Pop when click outside
		$('body').on('mousedown', function (e){
    	if (!$dialog.is(e.target) && $dialog.has(e.target).length === 0){
        $dialog.dialog("close");
    	}
		});
	}               
	
	$definition.on('click', function(e) {
		OpenPopup($(this).attr('href'), $(this));
		return false;
	});

	// $(".definition-list").packery({
 //  	itemSelector: '.item',
 //  	gutter: 10
	// });

	//Active menu
	$(".menu-principal li a").each(function(){
		 if(this.href == window.location.href){
		 	$(this).addClass("active");
		 }

	});

});
