<?php get_template_part( 'assets/images/hero.svg' ); ?>
<section class="banner-section">
	<div class="banner-section__bg-1"></div>
	<div class="banner-section__bg-2"></div>
	<div class="container">
		<div class="row">

			<div class="col-md-6 text-center text-md-left" style="z-index:1">
				<h1>The user-friendly<br/>WordPress gallery plugin.</h1>
				<p>Modula is the only gallery plugin that lets you freely resize images in your gallery so you can choose which images stand out.</p>
				<a class="button button--lg mr-1 mb-md-0" href="<?php echo esc_url( get_permalink( get_page_by_path( 'pricing' ) ) ); ?>">Buy Modula Gallery</a>
				<a class="button button--link ml-1 mb-md-0" href="#features">View Features</a>
			</div>

			<div class="col-md-6" style="z-index:0">
				<div class="hero">
					<div class="hero__content">
						<svg class="hero__leaf hero__leaf--1" viewBox="0 0 100 100" >
							<use xlink:href="#leaf1"></use>
						</svg>
						<svg class="hero__leaf hero__leaf--2" viewBox="0 0 100 100">
							<use xlink:href="#leaf2"></use>
						</svg>
						<svg class="hero__leaf hero__leaf--3" viewBox="0 0 100 100">
							<use xlink:href="#leaf3"></use>
						</svg>
						<svg class="hero__leaf hero__leaf--4" viewBox="0 0 100 100">
							<use xlink:href="#leaf4"></use>
						</svg>
						<svg class="hero__leaf hero__leaf--5" viewBox="0 0 100 100">
							<use xlink:href="#leaf5"></use>
						</svg>
						<svg class="hero__screen" viewBox="0 0 100 100">
							<use xlink:href="#screen"></use>
						</svg>
						<img class="hero__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/hero__img.jpg">
						<svg class="hero__play-icon">
							<use xlink:href="#play-icon"></use>
						</svg>
					</div>
				</div>

				<div class="banner-section__arrow"></div>

			</div>
		</div>
	</div>
</section>