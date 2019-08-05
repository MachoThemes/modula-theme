<?php $discount_code_id = 177460; ?>
<section class="promotion-section text-center" style="display:none">
	Use the promo code <span class="discount-code"><?php echo get_post_meta($discount_code_id, '_edd_discount_code', true);  ?></span> and get <strong>10% OFF</strong>. Offer expires in <span data-expires="<?php echo get_post_meta($discount_code_id, '_edd_discount_expiration', true);  ?>" class="timer"></span>
</section>

<script>

jQuery(function() {

	function getCookie(name) {
		var value = "; " + document.cookie;
		var parts = value.split("; " + name + "=");
		if (parts.length == 2) return parts.pop().split(";").shift();
	}

	var $promotionSection = jQuery('.promotion-section');
	var $timerSpan = jQuery('.promotion-section').find('.timer');
	var $modulaDiscountCode = getCookie('modulaDiscountCode');

	if( ! $modulaDiscountCode )  {
		//set cookie
		var now = new Date().getTime();
		var exdate = new Date();
		exdate.setDate( exdate.getDate() + 30 );
		document.cookie = "modulaDiscountCode="+ now +"; expires="+exdate.toUTCString();

		$modulaDiscountCode = now;
	}

	var now = new Date().getTime();
	var distance = now - $modulaDiscountCode;
	var days = Math.floor(distance / (1000 * 60 * 60 * 24));
	var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));

	if( days == 0 && hours < 6 ) {

		// Update the count down every 1 second
		var x = setInterval(function() {

			var now = new Date().getTime();
			var distance = (6*60*60*1000) - (now - $modulaDiscountCode);

			// Time calculations for days, hours, minutes and seconds
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);

			$timerSpan.html( ('0' + hours).slice(-2) + ":" + ('0' + minutes).slice(-2) + ":" + ('0' + seconds).slice(-2) );

			// If the count down is finished, write some text
			if (distance < 0) {
				clearInterval(x);
				$promotionSection.hide();
			}
		}, 1000);

		$promotionSection.delay(1000).slideDown( "fast" );

	}


});

</script>