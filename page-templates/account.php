<?php /* Template Name: Account */ ?>

<?php get_header(); ?>

<section class="main">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="rounded-box">
					<a class="anchor" name="purchase-history"></a>
					<h3 class="mb-3">Purchase History</h3>
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : ?>
							<?php the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-xs-12">
				<div class="rounded-box">
					<a class="anchor" name="subscriptions"></a>
					<h3 class="mb-3">Subscriptions</h3>
					<?php echo do_shortcode('[edd_subscriptions]'); ?>
				</div>
			</div>
			<div class="col-xs-12">
				<div class="rounded-box">
					<a class="anchor" name="appsumo"></a>
					<h3 class="mb-3">Redeem AppSumo Codes</h3>
					<?php echo do_shortcode('[edd_appsumo_redeem_form]'); ?>
				</div>
			</div>
			<div class="col-xs-12">
				<div class="rounded-box">
					<a class="anchor" name="account-information"></a>
					<h3 class="mb-3">Account Information</h3>
					<?php echo do_shortcode('[edd_profile_editor]'); ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="rounded-box">
					<a class="anchor" name="download-history"></a>
					<h3 class="mb-3">Download History</h3>
					<?php echo do_shortcode('[download_history]'); ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="rounded-box">
					<h3 class="mb-3">Login Status</h3>
					<?php $current_user = wp_get_current_user(); ?>
					<p class="mb-0">You are currently logged in as: <strong><?php echo $current_user->user_login; ?></strong></p>
					<a class="button button--link" href="<?php echo wp_logout_url( home_url() ); ?>">Log out?</a>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/sections/cta' ); ?>

<?php get_footer(); ?>

