(function($){

	$(document).ready(function(){
		$('.compare-plans-button').on('click', function(e) {
                    e.preventDefault();
                    $('.pricing-section').show();
                    $("body,html").animate(
                    { scrollTop: $('.pricing-section').offset().top }, 800 );
		});
	});
        

})(jQuery);
