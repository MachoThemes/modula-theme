<?php /* Template Name: Become an Affiliate */ ?>

<?php get_header(); ?>

<?php get_template_part( 'template-parts/sections/title' ); ?>

<section class="main">
	<div class="container">
		<div class="row">




			<div class="col-md-6" style="order:1">
		
				<?php get_template_part( 'assets/images/illustration-7.svg' ); ?>
				<div class="illustration illustration-7 mb-3 mb-md-0">
					<div class="illustration__content">
						<svg class="illustration-7__static" viewBox="0 0 100 100" >
							<use xlink:href="#illustration-7__static"></use>
						</svg>
						<svg class="illustration__animated-svg illustration-7__line-1" viewBox="0 0 100 100" >
							<use xlink:href="#illustration-7__line-1"></use>
						</svg>
						<svg class="illustration__animated-svg illustration-7__line-2" viewBox="0 0 100 100" >
							<use xlink:href="#illustration-7__line-2"></use>
						</svg>
						<svg class="illustration__animated-svg illustration-7__line-3" viewBox="0 0 100 100" >
							<use xlink:href="#illustration-7__line-3"></use>
						</svg>
						<svg class="illustration__animated-svg illustration-7__line-4" viewBox="0 0 100 100" >
							<use xlink:href="#illustration-7__line-4"></use>
						</svg>
						<svg class="illustration__animated-svg illustration-7__line-5" viewBox="0 0 100 100" >
							<use xlink:href="#illustration-7__line-5"></use>
						</svg>
						<svg class="illustration__animated-svg illustration-7__line-6" viewBox="0 0 100 100" >
							<use xlink:href="#illustration-7__line-6"></use>
						</svg>
						<svg class="illustration__animated-svg illustration-7__line-7" viewBox="0 0 100 100" >
							<use xlink:href="#illustration-7__line-7"></use>
						</svg>
						<svg class="illustration-7__person" viewBox="0 0 100 100" >
							<use xlink:href="#illustration-7__person"></use>
						</svg>
					</div>
				</div>
			</div>

			<div class="col-md-6" style="order:0">
				<h3>Learn more about Modula's Affiliate Program!</h3>
				<p>First things first, affiliates are a very important part of our growth strategy. </p>
				<p>We have many successful affiliate partners who profit from our program because of our continued commitment to creating opportunities for our affiliates to earn commissions.</p>
				<p>As a Modula affiliate, you’ll earn a 20% commission from everyone you refer.</p>
			</div>

		</div>

		<?php if ( ! affwp_is_affiliate( get_current_user_id() ) ) : ?>

		<div class="row">
			<div class="col-md-6">
			
				<?php get_template_part( 'assets/images/illustration-8.svg' ); ?>
				<div class="illustration illustration-8 mb-3 mb-md-0 float-lg-right">
					<div class="illustration__content">
						<svg class="illustration-8__static" viewBox="0 0 100 100" >
							<use xlink:href="#illustration-8__static"></use>
						</svg>
						<svg class="illustration__animated-svg illustration-8__slice-1" viewBox="0 0 100 100" >
							<use xlink:href="#illustration-8__slice-1"></use>
						</svg>
						<svg class="illustration__animated-svg illustration-8__slice-2" viewBox="0 0 100 100" >
							<use xlink:href="#illustration-8__slice-2"></use>
						</svg>
						<svg class="illustration__animated-svg illustration-8__slice-3" viewBox="0 0 100 100" >
							<use xlink:href="#illustration-8__slice-3"></use>
						</svg>
						<svg class="illustration__animated-svg illustration-8__slice-4" viewBox="0 0 100 100" >
							<use xlink:href="#illustration-8__slice-4"></use>
						</svg>
						<svg class="illustration__animated-svg illustration-8__slice-5" viewBox="0 0 100 100" >
							<use xlink:href="#illustration-8__slice-5"></use>
						</svg>
						<svg class="illustration__animated-svg illustration-8__slice-6" viewBox="0 0 100 100" >
							<use xlink:href="#illustration-8__slice-6"></use>
						</svg>
						<svg class="illustration-8__person" viewBox="0 0 100 100" >
							<use xlink:href="#illustration-8__person"></use>
						</svg>

					</div>
				</div>
			</div>

			<div class="col-md-6">
				<h3>Joining in</h3>
				<p>Joining our affiliate program is simple. Fill out the form below to get started:</p>
				<?php echo do_shortcode( '[affiliate_registration]' ); ?>
			</div>

		</div>

		<?php endif; ?>

		<div class="row">
			<div class="col-md-6">
				<h3>The Process</h3>
				<p>Joining Modula's Affiliate Program is pretty simple. Use the form above to create an affiliate account. We’ll then auto-generate a password and email it to you. You’ll be given share links instantly if you want to start sharing Modula immediately. Check your email for the affiliate dashboard link and your password. Once you sign in you can see all your stats, enter your PayPal payment information, and download any logos or assets you need.</p>
				<p>Start promoting! You’ll see any clicks or activity reflected in your account.</p>
				<p>It’s good to have you on board!</p>
				<p>Have questions related to the affiliate program? Click here to <a href="https://wp-modula.com/contact-us/">get in touch</a>.</p>
			</div>

			<div class="col-md-6">
				<h3>Promotion Ideas</h3>
				<ul class="list--checkmark">
					<li>Write a Modula vs. _________ (whatever gallery plugin you are most familiar with or personally switched from) post and publish that on your blog and send it out to your email list.</li>
					<li>Add details about Modula, along with your affiliate link, to any pages or posts you have related to WordPress and web development.</li>
					<li>Share how you use Modula and what you were able to create with Modula and link to Modula using your affiliate link.</li>
					<li>Add Modula to your Resources page on your blog as one of your recommended WordPress plugins.</li>
					<li>And, of course, anything else you can think of!</li>
				</ul>
			</div>

		</div>



	</div>
</section>

<?php get_footer(); ?>
