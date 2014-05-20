(function($){
$(function(){
	//$( '#nav li:has(ul)' ).doubleTapToGo();
	$('.nav-toggle').click(function(){
		$(this).parent().toggleClass('open');
	});
});
})(jQuery);