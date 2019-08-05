<section class="topbar-section <?php echo ( $_COOKIE['modula_top_bar_section_animated'] == 'true' ) ? '': 'topbar-section--animated'; ?>">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 text-center">
				<?php echo wp_kses_post( modula_get_option( 'top_bar_content' ) ); ?>
			</div>
		</div>
	</div>
</section>


<script>
jQuery(function() {

	function getCookie(name) {
		var value = "; " + document.cookie;
		var parts = value.split("; " + name + "=");
		if (parts.length == 2) return parts.pop().split(";").shift();
	}

	var $topbarCookie = getCookie('modula_top_bar_section_animated');

	if( ! $topbarCookie )  {
		var exdate = new Date();
		exdate.setDate( exdate.getDate() + 30 );
		document.cookie = "modula_top_bar_section_animated=true; expires="+exdate.toUTCString();
	}

});
</script>
