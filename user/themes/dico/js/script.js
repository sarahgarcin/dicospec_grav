$(document).ready(function(){

	var $dialog = $("#dialog");
	var $popWidth = $(window).width() / 4	;
	var $definition = $('.definition-list li a');

	// variables pour l'ouverture d'une pop up dans les pages textes
	var $dialogText = $('#dialog-text');
	var $elementClick = $(".page-text .inner-text").find("[title='definition']");

	// Display definition excerpt when hover definition name
	// $definition.mouseenter(function(){
	// 	$(this).children("p").show();
	// });
	// $definition.mouseleave(function(){
	// 	$(this).children("p").hide();
	// });

	initEvents();

	function initEvents(){

		$definition.on('click', function(e) {
			//open pop on definition click
			OpenPopup($(this).attr('href'), $(this));
			return false;
		});

		// $elementClick.on('click', function(e) {
		// 	//open pop on definition click In text pge
		// 	OpenPopupInTextPage($(this).attr('href'), $(this));
		// 	return false;
		// });

		$elementClick.each(function(e){
			console.log($(this));
		});

		$elementClick.hover(function(e){
			e.preventDefault();
      var href = $(this).attr('href');
      var $wrap = $('#ajax-wrap');
      var topPosition = $(this).offset().top;
      var leftPosition = $(this).offset().left;
      $wrap.html('').load(href + " .content-def p", function () {
      	$wrap.children("p").children("img").remove();
      	$wrap.css({"top":e.pageY, "left":e.pageX - 100});
        $wrap.show();  
      });
		});
		
		$(".menu-principal li a").each(function(){
			//Active menu
			 if(this.href == window.location.href){
			 	$(this).addClass("active");
			 }
		});

		// $(".menu-principal li a").mouseenter(function(){

		// 	$(this).parent().children(".submenu").slideDown("fast");
		// });
		// $(".menu-principal li a").mouseleave(function(){
		// 	$(this).parent().children(".submenu").slideUp("fast");
		// });
	}


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


	// Open definition in text page 
	function OpenPopupInTextPage($link, $this) {
		$dialogText.dialog({
    	autoOpen: false,
    	appendTo: ".container",
    	position: { my: "right-30", at: "right", of: window },
    	closeText: "x",
    	modal: true,
    	width: $popWidth,
	 	});
	 	$dialogText.load($link + " .container");
		$dialogText.dialog('open');


		//Close Pop when click outside
		$('body').on('mousedown', function (e){
    	if (!$dialogText.is(e.target) && $dialogText.has(e.target).length === 0){
        $dialogText.dialog("close");
    	}
		});
	}            

});
