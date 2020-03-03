(function($){

	$(document).ready(function(){
		$('body').on('click', '.edd_vat_link', function(e) {
			e.preventDefault();
			$(e.currentTarget).parent().fadeOut('fast');
			$('#edd_vat_fields').fadeIn('slow');
		});
	});

})(jQuery);
