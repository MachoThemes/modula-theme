<?php

//localhost
//$download1_id = 219346;
//$download2_id = 219344;
//$download3_id = 219340;
//$download4_id = 219279;

//wp-modula.com pricing plans 
$download1_id = 256715;
$download2_id = 256712;
$download3_id = 256708;
$download4_id = 405675;

wp_enqueue_script( 'waypoints' );

$utm_medium = isset( $_GET['utm_medium'] ) ? $_GET['utm_medium'] : '';
$upgrading = false;

//Agency, Business, Trio, Basic
$download_ids = array(
        $download1_id,
        $download2_id,
        $download3_id,
        $download4_id
);

$cart_discounts = edd_get_cart_discounts();



if ( isset( $_GET['license'] ) ) {
	$license_by_key = edd_software_licensing()->get_license( $_GET['license'], true );

	if ( $license_by_key ) {
		$upgrading = true;
		$download_by_license = $license_by_key->download;
		$upgrades = edd_sl_get_license_upgrades( $license_by_key->ID );
	}
}

$downloads = array();
foreach ( $download_ids as $id ) {
	$download = edd_get_download( $id );

	if ( $upgrading ) {
		$download->upgrade_id = modula_get_upgrade_id_by_download_id( $upgrades, $download->ID );
		$download->upgrade_cost = edd_sl_get_license_upgrade_cost( $license_by_key->ID, $download->upgrade_id );
		$download->higher_plan = array_search( $download->id, $download_ids) >= array_search( $download_by_license->id, $download_ids) ? false : true;
	}

	$downloads[] = $download;
}

//get addons
$addons = modula_theme_get_all_extensions( $downloads );

?>
<section class="pricing-section">

	<a id="pricing" style="position: relative; top: -90px;"></a>

	<div class="container main-table">

		<div class="pricing-table pricing-table--header row">
			<div class="col-xs-3">

				<div class="pricing-table__message">
					<div class="row align-items-center">
						<div class="col-xs-10">
						<h6>You can change plans or cancel your account at any time</h6>
						<small>Choose a plan and you can upgrade or cancel it any time you want.</small>
						</div>
						<div class="col-xs-2">
							<i class="icon-right-open-big"></i>
						</div>
					</div>
				</div><!-- pricing-table__message -->
			</div>

			<?php foreach( $downloads as $download ): ?>

				<div class="col-xs-3 <?php echo isset( $download->higher_plan ) && $download->higher_plan === false ? 'pricing-table-inactive': ''; ?>">

					<h4 class="pricing-table__title mb-2"><?php echo explode( '-', $download->post_title )[1]; ?></h4>

					<?php if ( $upgrading && $download->higher_plan ): ?>
						<div class="pricing-table__initial-price">
							$<?php echo floor( edd_get_download_price( $download->ID ) ); ?>
						</div>
					<?php elseif ( count( $cart_discounts ) > 0 ): ?>
						<div class="pricing-table__initial-price">
							$<?php echo floor( edd_get_download_price( $download->ID ) ); ?>
						</div>
					<?php endif; ?>

					<div class="pricing-table__price mb-2">
						<?php if ( $upgrading && $download->higher_plan ) { ?>
							<sup>$</sup><?php echo $download->upgrade_cost; ?> 
						<?php } else { ?>
							<sup>$</sup><?php echo floor(modula_edd_get_download_price( $download->ID )); ?><sup>.00</sup>
						<?php } ?>
					</div>

					<?php if ( $upgrading && $download->higher_plan ): ?>
						<div class="pricing-table__savings">
							<p class="wp-block-machothemes-highlight mb-2">
								<mark class="wp-block-machothemes-highlight__content">$<?php echo edd_get_download_price( $download->ID ) - $download->upgrade_cost; ?> savings</mark>
							</p>
						</div>
					<?php elseif ( count( $cart_discounts ) > 0 ): ?>
						<div class="pricing-table__savings">
							<p class="wp-block-machothemes-highlight mb-2">
								<mark class="wp-block-machothemes-highlight__content">$<?php echo edd_get_download_price( $download->ID ) - modula_edd_get_download_price( $download->ID ); ?> savings</mark>
							</p>
						</div>
					<?php endif; ?>

					<?php if ( $upgrading && $download->higher_plan ): ?>
						<a class="button pricing-table__button" href="<?php echo esc_url( edd_sl_get_license_upgrade_url( $license_by_key->ID, $download->upgrade_id ) ); ?>" title="Upgrade">Upgrade</a>
					<?php else: ?>
						<?php echo do_shortcode( '[purchase_link price="0" class="edd-submit button pricing-table__button" text="Buy Now" id="' . $download->ID . '" direct="true"]' ) ?>
					<?php endif; ?>

				</div><!-- col -->

			<?php endforeach; ?>

		</div>

		<div class="row pricing-table">
			<div class="col-xs-3"> 
				Unlimited Galleries
				<span class="tooltip">
					<i class="icon-question-circle"></i>
					<span class="tooltip__text">The number of galleries you can create on your website.</span>
				</span>
			</div>
			<div class="col-xs-3">
				<i class="icon-ok"></i>
			</div>
			<div class="col-xs-3">
				<i class="icon-ok"></i>
			</div>
			<div class="col-xs-3">
				<i class="icon-ok"></i>
			</div>
			<div class="col-xs-3">
				<i class="icon-ok"></i>
			</div>
		</div><!-- row -->

		<div class="pricing-table row">
			<div class="col-xs-3">
				Unlimited Images
				<span class="tooltip">
					<i class="icon-question-circle"></i>
					<span class="tooltip__text">Any gallery created with Modula can have as many images as you want. </span>
				</span>
			</div>
			<div class="col-xs-3">
				<i class="icon-ok"></i>
			</div>
			<div class="col-xs-3">
				<i class="icon-ok"></i>
			</div>
			<div class="col-xs-3">
				<i class="icon-ok"></i>
			</div>
			<div class="col-xs-3">
				<i class="icon-ok"></i>
			</div>
		</div><!-- row -->

		<div class="pricing-table row">
            <div class="pricing-breaker">
                <h4>Support & Updates</h4>
            </div><!--pricing-breaker-->
        </div><!--row -->


		<div class="pricing-table row">
			<div class="col-xs-3">
				Supported Sites
				<span class="tooltip">
					<i class="icon-question-circle"></i>
					<span class="tooltip__text">The number of sites on which you can use Modula.</span>
				</span>
			</div>

			<?php foreach( $downloads as $download ): ?>

				<div class="col-xs-3">
					<?php echo modula_nr_of_sites( $download->ID ); ?>
				</div>

			<?php endforeach; ?>

		</div><!-- row -->


        <div class="pricing-table row">
            <div class="col-xs-3">
                Support for 1 full year
                <span class="tooltip">
					<i class="icon-question-circle"></i>
					<span class="tooltip__text">In case you ever run into issues with our plugin (unlikely), feel free to reach out to our support at any time. Priority support - tickets get handled in 12 hours or less. Regular support - tickets get handled in 36 hours or less. On weekends, response time might slow down to 48hours. </span>
				</span>
            </div>
            <div class="col-xs-3">
                <strong>Priority</strong>
            </div>
            <div class="col-xs-3">
                <strong>Priority</strong>
            </div>
            <div class="col-xs-3">
                Regular
            </div>
            <div class="col-xs-3">
                Regular
            </div>
        </div><!-- row -->

		<div class="pricing-table row">
			<div class="col-xs-3">
				Updates for 1 full year
				<span class="tooltip">
					<i class="icon-question-circle"></i>
					<span class="tooltip__text">You’ll have access to free updates for 1 year or until you cancel your yearly subscription.</span>
				</span>
			</div>
			<div class="col-xs-3">
				<i class="icon-ok"></i>
			</div>
			<div class="col-xs-3">
				<i class="icon-ok"></i>
			</div>
			<div class="col-xs-3">
				<i class="icon-ok"></i>
			</div>
			<div class="col-xs-3">
				<i class="icon-ok"></i>
			</div>
		</div><!-- row -->


        <div class="pricing-table row">
            <div class="pricing-breaker">
                <h4>Extensions included with each purchase</h4>
            </div><!--pricing-breaker-->
        </div><!--row -->

		

		<?php while ( $addons->have_posts() ): ?>
			<?php $addons->the_post(); ?>

			<div class="row pricing-table <?php echo isset( $utm_medium ) && $utm_medium === get_post_field( 'post_name' ) ? 'pricing-table--highlight' : ''; ?>">
				<div class="col-xs-3">
					<?php echo modula_get_post_meta( get_the_id(), 'pricing_title' ) != '' ? modula_get_post_meta( get_the_id(), 'pricing_title' ) : get_the_title(); ?>

					<?php if ( modula_get_post_meta( get_the_id(), 'tooltip' ) != '' || has_excerpt() ): ?>
						<span class="tooltip">
							<i class="icon-question-circle"></i>
							<span class="tooltip__text"><?php echo modula_get_post_meta( get_the_id(), 'tooltip' ) != '' ? modula_get_post_meta( get_the_id(), 'tooltip' ) : get_the_excerpt(); ?></span>
						</span>
					<?php endif; ?>
				</div>

				<?php foreach ( $downloads as $download ): ?>
					<div class="col-xs-3">
						<?php if ( false === array_search( get_the_id(), $download->get_bundled_downloads() ) ): ?>
							<i class="icon-cancel"></i>
						<?php else: ?>
							<i class="icon-ok"></i>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>

			</div><!-- row -->

		<?php endwhile; ?>

		<div class="pricing-table row">
	<div class="col-xs-3">
		Gallery Filters
		<span class="tooltip">
			<i class="icon-question-circle"></i>
			<span class="tooltip__text">Easily create <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'demo/filters' ) ) ); ?>">filterable WordPress galleries</a> with Modula.</span>
		</span>
	</div>
	<div class="col-xs-3">
		<i class="icon-ok"></i>
	</div>
	<div class="col-xs-3">
		<i class="icon-ok"></i>
	</div>
	<div class="col-xs-3">
		<i class="icon-ok"></i>
	</div>
	<div class="col-xs-3">
		<i class="icon-ok"></i>
	</div>
</div><!-- row -->

<div class="pricing-table row <?php echo isset( $utm_medium ) && $utm_medium === 'sorting-metabox' ? 'pricing-table--highlight' : ''; ?>">
	<div class="col-xs-3">
		Gallery Sorting
		<span class="tooltip">
			<i class="icon-question-circle"></i>
			<span class="tooltip__text">Multiple choices for sorting out images from your gallery: manual, date created, date modified, alphabetically, reverse or random</span>
		</span>
	</div>
	<div class="col-xs-3">
		<i class="icon-ok"></i>
	</div>
	<div class="col-xs-3">
		<i class="icon-ok"></i>
	</div>
	<div class="col-xs-3">
		<i class="icon-ok"></i>
	</div>
	<div class="col-xs-3">
		<i class="icon-ok"></i>
	</div>
</div><!-- row -->


		<div class="pricing-table pricing-table--last row">
			
			<?php foreach( $downloads as $download ): ?>

				<div class="col-xs-3 <?php echo isset( $download->higher_plan ) && $download->higher_plan === false ? 'pricing-table-inactive': ''; ?>">

					<?php if ( $upgrading && $download->higher_plan ): ?>
						<a class="button pricing-table__button" href="<?php echo esc_url( edd_sl_get_license_upgrade_url( $license_by_key->ID, $download->upgrade_id ) ); ?>" title="Upgrade">Upgrade</a>
					<?php else: ?>
						<?php echo do_shortcode( '[purchase_link price="0" class="edd-submit button pricing-table__button" text="Buy Now" id="' . $download->ID . '" direct="true"]' ) ?>
					<?php endif; ?>

				</div><!-- col -->

			<?php endforeach; ?>

		</div><!-- row -->



		





	</div><!-- container -->

	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="pricing-message">
					<div class="pricing-message__content">
						<h5>100% No-Risk Money Back Guarantee!</h5>
						<p>There’s no risk trying GravityView: if you don’t like GravityView after 30 days, we’ll refund your purchase. We take pride in a frustration-free refund process.</p>
					</div>
				</div>
			</div>
		</div><!-- row -->
	</div><!-- container -->

</section>

