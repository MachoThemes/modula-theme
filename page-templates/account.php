<?php /* Template Name: Account */ ?>

<?php get_header(); ?>

<section class="main">
	<div class="container">
		<div class="row">
                    <?php if (is_user_logged_in()): ?>
                    <ul class="nav nav-tabs col-xs-12" id="account-tabs" role="tablist">
                        <div class="section-left col-md-10">
                            <li class="nav-item">
                              <a class="nav-link active" id="purchase-history-tab" data-toggle="tab" href="#purchase-history" role="tab" aria-controls="purchase-history" aria-selected="true"><?php _e('Purchase History', 'modula-theme'); ?></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="downloads-tab" data-toggle="tab" href="#downloads" role="tab" aria-controls="downloads" aria-selected="false"><?php _e('Downloads', 'modula-theme'); ?></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><?php _e('Profile', 'modula-theme'); ?></a>
                            </li>
                        </div>
                        <div class="section-right col-md-2">
                            <li class="nav-logout">
                              <a class="nav-link" href="<?php echo wp_logout_url( home_url() ); ?>"><?php _e('Log out', 'modula-theme'); ?></a>
                            </li>
                        </div>
                    </ul>
                    
                    <div class="tab-content col-xs-12" id="account-tabs-content">
                        
                        <div class="tab-pane fade show active" id="purchase-history" role="tabpanel" aria-labelledby="purchase-history-tab">
                            <?php echo do_shortcode('[purchase_history]'); ?>
                        </div>
                        
                        <div class="tab-pane fade" id="downloads" role="tabpanel" aria-labelledby="downloads-tab">
                            <?php 
                            $purchases = edd_get_users_purchases( get_current_user_id(), 20, true, 'any' );
                            $licensing = edd_software_licensing();
                            ?>
                            <div class="license-container">
                            <?php foreach ( $purchases as $payment ) {
                                if( edd_is_payment_complete( $payment->ID ) && $licensing->get_licenses_of_purchase( $payment->ID ) ) {
                                    $license_keys = $licensing->get_licenses_of_purchase( $payment->ID );
                                    if( $license_keys ) {
                                        foreach( $license_keys as $license ): 
                                            if (!$license->parent): ?>
                                            <div class="license">
                                                <span class="download-name"><?php echo $licensing->get_download_name($license->ID) ?></span>
                                                <span class="download-license"><?php echo edd_software_licensing()->licenses_db->get( $license->ID )->license_key ?></span>
                                            </div>
                                            <?php endif; 
                                        endforeach;
                                    }
                                }
                            } ?>
                            </div>
                            <table id="edd_user_history" class="edd-table">
                            <thead>
                                <tr class="edd_download_history_row">
                                    <th class="edd_download_download_name"><?php _e( 'Plugin', 'modula-theme' ); ?></th>
                                    <th class="edd_download_version"><?php _e( 'Version', 'modula-theme' ); ?></th>
                                    <th class="edd_download_download_files"><?php _e( 'Changelog', 'modula-theme' ); ?></th>
                                    <th class="edd_download_download_files"><?php _e( 'Download', 'modula-theme' ); ?></th>
                                </tr>
                            </thead>
                            <?php if ( $purchases ) :
                                foreach ( $purchases as $payment ) :
                                    $downloads      = edd_get_payment_meta_cart_details( $payment->ID, true );
                                    $count = 0;
                                    if ( $downloads ) :
                                        foreach ( $downloads as $download ) :
                                            if (!empty($download['parent'])): ?>
                                            <?php $count++; ?>
                                            <tr class="edd_download_history_row">
                                                <td class="download-name">
                                                <?php
                                                $price_id       = edd_get_cart_item_price_id( $download );
                                                $version        = get_post_meta($download['id'], '_edd_sl_version', true);
                                                $changelog       = get_post_meta($download['id'], '_edd_sl_changelog', true);
                                                $download_files = edd_get_download_files( $download['id'], $price_id );
                                                echo $download['name']; 
                                                ?>
                                                </td>
                                                <td>
                                                <?php if ($version): ?>
                                                    <?php echo $version ?>
                                                <?php endif; ?>
                                                </td>
                                                <td>
                                                <?php if ($changelog): ?>
                                                <a id="changelog-link-<?php echo $count ?>" data-count="<?php echo $count ?>" class="changelog-link" href="#"><?php _e('Changelog', 'modula-theme') ?></a>
                                                <div id="modal--changelog-<?php echo $count ?>" class="modal modal--changelog <?php echo $_POST['edd_action'] ? 'modal--open': ''; ?>">
                                                    <div class="modal__overlay"></div>
                                                    <div class="modal__content">
                                                        <div class="modal__close"></div>
                                                        <div class="changelog"><?php echo $changelog; ?></div>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                </td>
                                                <td>
                                                <?php foreach ($download_files as $file): ?>
                                                <a href="<?php echo $file['file'] ?>"><?php _e('Download', 'modula-theme') ?></a>
                                                <?php endforeach; ?>
                                                </td>
                                            </tr>
                                            <?php
                                            endif;
                                        endforeach;
                                    endif;
                                endforeach; ?>
                            <?php endif; ?>            
                            </table>
                        </div>
                        
			<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <?php echo do_shortcode('[edd_profile_editor]'); ?>
			</div>
                    <?php else: ?>
                        <div class="col-xs-12">
				<div class="rounded-box">
                                    <div class="account-container">
					<a class="anchor" name="account-information"></a>
                                        <span class="title-icon"><img draggable="false" role="img" class="emoji" alt="🔐" src="https://s.w.org/images/core/emoji/13.0.0/svg/1f510.svg"></span>
                                        <div class="login-title mb-3">You're not logged in.</div>              
                                        <p>Please log into your account below.</p>
                                    </div>
                                    <div class="account-form-container">
                                        <?php echo do_shortcode('[edd_profile_editor]'); ?>
                                    </div>
				</div>
			</div>
                    <?php endif; ?>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/sections/cta' ); ?>

<?php get_footer(); ?>

