(function($){

	$(document).ready(function(){
		$('a.compare-plans-button').on('click', function(e) {
                    e.preventDefault();
                    $('.pricing-table').show();
                    $("body,html").animate(
                    { scrollTop: $('.pricing-table').offset().top }, 800 );
		});
	});
        

})(jQuery);
