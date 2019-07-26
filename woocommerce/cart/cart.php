<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form class="owr-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
    <?php do_action( 'woocommerce_before_cart_table' ); ?>
    <div class="row owr-cart-form__header">
        <div class="owr-woc-cart-thumbnail col-md-3 header__title">
            YOUR <span style="color:#2D9CDB; margin-left: 10px;">CART</span>
        </div>
        <div class="owr-woc-cart-name col-md-4 header__count">
            <?php esc_html_e(  WC()->cart->cart_contents_count.' Items', 'woocommerce' ); ?>
        </div>
        <div class="owr-woc-cart-quantity col-md-2 header__quantity">
            <?php esc_html_e( 'Quantity', 'woocommerce' ); ?>
        </div>
        <div class="owr-woc-cart-price col-md-2 header__price">
            <?php esc_html_e( 'Price', 'woocommerce' ); ?>
        </div>
        <div class="col-md-1"></div>
    </div>
    <?php do_action( 'woocommerce_before_cart_contents' ); ?>

    <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
            $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key); ?>

            <div class="row owr-cart-form__body">
                <div class="owr-woc-cart-thumbnail col-lg-3 col-md-12 col-sm-12">
                    <?php
                    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                    if ( ! $product_permalink ) {
                        echo wp_kses_post( $thumbnail );
                    } else {
                        printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), wp_kses_post( $thumbnail ) );
                    }
                    ?>
                </div>
                <div class="owr-woc-cart-name col-lg-4 col-md-12 col-sm-12" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                    <?php
                    if ( ! $product_permalink ) {
                        echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                    } else {
                        echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                    }

                    $product_details = $_product->get_data();

                    echo '<p class="cart-product-description">' . $product_full_description = $product_details['short_description'] . '</p>';

                    do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                    // Meta data.
                    echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                    // Backorder notification.
                    if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                        echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>' ) );
                    }
                    ?>
                </div>
                <div class="owr-woc-cart-quantity col-lg-2 col-md-4 col-4" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                    <?php
                    if ( $_product->is_sold_individually() ) {
                        $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                    } else {
                        $product_quantity = woocommerce_quantity_input( array(
                            'input_name'   => "cart[{$cart_item_key}][qty]",
                            'input_value'  => $cart_item['quantity'],
                            'max_value'    => $_product->get_max_purchase_quantity(),
                            'min_value'    => '0',
                            'product_name' => $_product->get_name(),
                        ), $_product, false );
                    }

                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                    ?>
                </div>
                <div class="owr-woc-cart-price col-lg-2 col-md-4 col-4" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                    <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
                </div>
                <div class="owr-woc-cart-remove col-lg-1 col-md-4 col-4">
                    <?php
                    echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                        '<a href="%s" class="remove-btn" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                        __( 'Remove this item', 'woocommerce' ),
                        esc_attr( $product_id ),
                        esc_attr( $_product->get_sku() )
                    ), $cart_item_key );
                    ?>
                </div>
            </div>

        <?php }
    } ?>

    <?php do_action( 'woocommerce_cart_contents' ); ?>

    <div class="owr-cart-form__footer">
        <?php if ( wc_coupons_enabled() ) { ?>
            <div class="coupon">
                <label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button btn btn-primary owr-btn cart-btn" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
                <?php do_action( 'woocommerce_cart_coupon' ); ?>
            </div>
        <?php } ?>
            <div class="update-cart">
                <button type="submit" class="btn btn-primary owr-btn" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
            </div>
        <?php do_action( 'woocommerce_cart_actions' ); ?>

        <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
    </div>

    <?php do_action( 'woocommerce_after_cart_contents' ); ?>

    <?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

<div class="cart-collaterals">
    <?php
    /**
     * Cart collaterals hook.
     *
     * @hooked woocommerce_cross_sell_display
     * @hooked woocommerce_cart_totals - 10
     */
    do_action( 'woocommerce_cart_collaterals' );
    ?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
