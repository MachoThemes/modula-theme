<?php get_template_part( 'assets/images/hero.svg' ); ?>
<section class="hero-section-2">
    <div class="hero-section-2__bg-1"></div>

    <div class="container">
        <div class="row">

            <div class="col-md-6 text-center text-md-left" style="z-index:1">
                <h1 class="mb-3">Martech Wise Black-friday special deal.</h1>
                <p class="mb-3">With our drag-to-fit grid system you can take your pictures and drag them into unique layouts that put your images in the spotlight.</p>
                <p class="mb-3">
                <div class="stars mr-2"></div><strong>60,000+</strong> Active Users
                </p>
                <a class="button button--xl mr-1 mb-md-0" href="#pricing">Buy Modula Gallery</a>
            </div>

            <div class="col-md-6" style="z-index:0;">
                <img class="hero-section-2__hero" src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-2.png">

                <div class="hero-section-2__arrow">
					<?php echo file_get_contents( get_template_directory_uri() . '/assets/images/banner-section__arrow.svg' ); ?>
                </div>
            </div>

        </div>
    </div>
</section>