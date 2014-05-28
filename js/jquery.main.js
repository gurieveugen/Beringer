(function($){
	$(function(){
		//$( '#nav li:has(ul)' ).doubleTapToGo();
		$('.nav-toggle').click(function(){
			$(this).parent().toggleClass('open');
		});

		$('.transactions-list').isotope({
			itemSelector: '.a-item',
  			layoutMode: 'fitRows',
			getSortData : {
				dateSort : function( $item ) {
					return $($item).data('date');
				},
				ascSort : function( $item ) {
					return $($item).data('asc');
				},
				descSort : function( $item ) {
					return $($item).data('desc');
				},
				titleSort : function( $item ) {
					return $($item).data('title');
				}
			}
		});
		$('#sort-by').change(function(){
			var sort_by = $(this).val() + 'Sort';
			console.log(sort_by);
			$('.transactions-list').isotope({ sortBy: sort_by });
		});
	});
})(jQuery);