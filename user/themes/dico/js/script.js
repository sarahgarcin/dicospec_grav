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
			var href = $(this).attr('href');
      var $wrap = $('#ajax-wrap');
      var $element = $(this);
      $(this).click(false);
      $wrap.html('').load(href + " .content-def p", function () {
      	$wrap.children("p").children("img").remove();
      	var wrapHtml = $wrap.html();
      	$element.attr("data-def", wrapHtml);
      });
		});

		$elementClick.mouseenter(function(event){
			showTooltip($(this), event)
		});
		$elementClick.mouseleave(function(event){
			hideTooltip($(this));
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
 
	function showTooltip($element, event) {
		var addHtml = $element.attr("data-def");
	  $('.tooltip-definition').remove();
	  $('body').append("<div class='tooltip-definition'>" + addHtml + "</div>");
	  var tooltipX = event.pageX - 8;
	  var tooltipY = event.pageY + 8;
	  $('.tooltip-definition').css({top: tooltipY, left: tooltipX});
    
    //remove title when hover
    var title = $element.attr("title");
    $element.attr("tmp_title", title);
    $element.attr("title","");
	};
 
	function hideTooltip($this) {
	   $('.tooltip-definition').remove();
    //Rajouter le title 
    var title = $this.attr("tmp_title");
    $this.attr("title", title);
	};
		
	$(".menu-principal li a").each(function(){
		//Active menu
		 if(this.href == window.location.href){
		 	$(this).addClass("active");
		 }
	});          

});
