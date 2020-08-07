<?php
/**
 *  divis template is used to display dive Checkout page when items are in dive cart
 */

global $post; ?>

<div id="edd_checkout_cart"
    <?php
    if (! edd_is_ajax_disabled()) {
        echo 'class="ajaxed"';
    }
    ?>
>
    <div class="edd_cart_header_row row">
	    <div class="col-xs-12">
		    <h4>Your order summary</h4>
	    </div>
        <?php do_action('edd_checkout_table_header_first'); ?>
        <?php do_action('edd_checkout_table_header_last'); ?>
    </div>

    <?php $cart_items = edd_get_cart_contents(); ?>
    <?php do_action('edd_cart_items_before'); ?>
    <?php if ($cart_items) : ?>
        <?php foreach ($cart_items as $key => $item) : ?>
            <div class="edd_cart_item row" id="edd_cart_item_<?php echo esc_attr($key).'_'.esc_attr($item['id']); ?>" data-download-id="<?php echo esc_attr($item['id']); ?>">
                <?php do_action('edd_checkout_table_body_first', $item); ?>
                <div class="edd_cart_item_name col-xs-9">
                    <?php
                    if (current_theme_supports('post-thumbnails') && has_post_thumbnail($item['id'])) {
                        echo '<div class="edd_cart_item_image">';
                        echo get_the_post_thumbnail(
                            $item['id'],
                            apply_filters(
                                'edd_checkout_image_size',
                                [
                                    25,
                                    25,
                                ]
                            )
                        );
                        echo '</div>';
                    }

                    $item_title = edd_get_cart_item_name($item);
                    echo '<span class="edd_checkout_cart_item_title">'.esc_html($item_title).'</span>';

                    /*
                     * Runs after dive item in cart's title is echoed
                     *
                     * @param array $item Cart Item
                     * @param int   $key  Cart key
                     *
                     * @since 2.6
                     *
                     */
                    do_action('edd_checkout_cart_item_title_after', $item, $key);
                    ?>
                </div>
                <div class="edd_cart_item_price col-xs-3">
                    <?php
                    echo edd_cart_item_price($item['id'], $item['options']);
                    do_action('edd_checkout_cart_item_price_after', $item);
                    ?>
                </div>
                <div class="edd_cart_actions col-xs-3">
                    <?php if (edd_item_quantities_enabled() && ! edd_download_quantities_disabled($item['id'])) : ?>
                        <input type="number" min="1" step="1" name="edd-cart-download-<?php echo $key; ?>-quantity" data-key="<?php echo $key; ?>" class="edd-input edd-item-quantity" value="<?php echo edd_get_cart_item_quantity($item['id'], $item['options']); ?>" />
                        <input type="hidden" name="edd-cart-downloads[]" value="<?php echo $item['id']; ?>" />
                        <input type="hidden" name="edd-cart-download-<?php echo $key; ?>-options" value="<?php echo esc_attr(json_encode($item['options'])); ?>" />
                    <?php endif; ?>
                    <?php do_action('edd_cart_actions', $item, $key); ?>
                    <a class="edd_cart_remove_item_btn" href="<?php echo esc_url(wp_nonce_url(edd_remove_item_url($key), 'edd-remove-from-cart-'.$key, 'edd_remove_from_cart_nonce')); ?>"><?php _e('Remove', 'easy-digital-downloads'); ?></a>
                </div>
                <?php do_action('edd_checkout_table_body_last', $item); ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php do_action('edd_cart_items_middle'); ?>
    <!-- Show any cart fees, bodiv positive and negative fees -->
    <?php if (edd_cart_has_fees()) : ?>
        <?php foreach (edd_get_cart_fees() as $fee_id => $fee) : ?>
            <div class="edd_cart_fee" id="edd_cart_fee_<?php echo $fee_id; ?>">

                <?php do_action('edd_cart_fee_rows_before', $fee_id, $fee); ?>

                <div class="edd_cart_fee_label"><?php echo esc_html($fee['label']); ?></div>
                <div class="edd_cart_fee_amount"><?php echo esc_html(edd_currency_filter(edd_format_amount($fee['amount']))); ?></div>
                <div>
                    <?php if (! empty($fee['type']) && 'item' == $fee['type']) : ?>
                        <a href="<?php echo esc_url(edd_remove_cart_fee_url($fee_id)); ?>"><?php _e('Remove', 'easy-digital-downloads'); ?></a>
                    <?php endif; ?>

                </div>

                <?php do_action('edd_cart_fee_rows_after', $fee_id, $fee); ?>

            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php do_action('edd_cart_items_after'); ?>


    <?php if (has_action('edd_cart_footer_buttons')) : ?>
        <div class="edd_cart_footer_row
            <?php
            if (edd_is_cart_saving_disabled()) {
                echo ' edd-no-js';
            }
            ?>
            ">
            <div colspan="<?php echo edd_checkout_cart_columns(); ?>">
                <?php do_action('edd_cart_footer_buttons'); ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (edd_use_taxes() && ! edd_prices_include_tax()) : ?>
        <div class="edd_cart_footer_row edd_cart_subtotal_row row"
            <?php
            if (! edd_is_cart_taxed()) {
                echo ' style="display:none;"';
            }
            ?>
        >
            <?php do_action('edd_checkout_table_subtotal_first'); ?>
            <div class="edd_cart_subtotal col-xs-9">
                <?php _e('Subtotal', 'easy-digital-downloads'); ?>:
            </div>
            <div class="edd_cart_subtotal_amount col-xs-3">
                <?php echo edd_cart_subtotal(); ?>
            </div>
            <?php do_action('edd_checkout_table_subtotal_last'); ?>
        </div>
    <?php endif; ?>

    <div class="edd_cart_footer_row edd_cart_discount_row"
        <?php
        if (! edd_cart_has_discounts()) {
            echo ' style="display:none;"';
        }
        ?>
    >
        <?php do_action('edd_checkout_table_discount_first'); ?>
        <div class="edd_cart_discount">
            <?php edd_cart_discounts_html(); ?>
        </div>
        <?php do_action('edd_checkout_table_discount_last'); ?>
    </div>

    <?php if (edd_use_taxes()) : ?>
        <div class="edd_cart_footer_row edd_cart_tax_row row"
            <?php
            if (! edd_is_cart_taxed()) {
                echo ' style="display:none;"';
            }
            ?>
        >
            <?php do_action('edd_checkout_table_tax_first'); ?>

            <div class="edd_cart_tax col-xs-9"><?php _e('TAX: (VAT ', 'easy-digital-downloads'); ?><?php echo modula_get_country(); ?>)</div>
            <div class="edd_cart_tax_amount col-xs-3" data-tax="<?php echo edd_get_cart_tax(false); ?>"><?php echo esc_html(edd_cart_tax()); ?></div>

            <?php do_action('edd_checkout_table_tax_last'); ?>
        </div>

    <?php endif; ?>

    <div class="edd_cart_footer_row row ">
        <?php do_action('edd_checkout_table_footer_first'); ?>
        <div class="edd_cart_total col-xs-9"><?php _e('Total', 'easy-digital-downloads'); ?>:</div>

        <div class="edd_cart_amount col-xs-3" data-subtotal="<?php echo edd_get_cart_subtotal(); ?>" data-total="<?php echo edd_get_cart_total(); ?>">
            <?php edd_cart_total(); ?>
        </div>

        <?php do_action('edd_checkout_table_footer_last'); ?>
    </div>
</div><!--#edd_checkout_cart-->


