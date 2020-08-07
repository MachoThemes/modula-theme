export default class CheckoutPage {

	constructor(){
		this.waypointsInitiated = false;


		jQuery( window ).resize( () => this.onResize() );

		setTimeout( function() {
			jQuery( window ).trigger('resize');
		}, 2000);
	}

	onResize() {
		if( jQuery( window ).width() < 1200 ) {
			this.destroyStickyCart();
		} else{
			this.initStickyCart();
		}
	}

	initStickyCart() {

		if (typeof Waypoint === "undefined") {
			return;
		}

		if( this.waypointsInitiated == true ) {
			return;
		}

		this.waypoint1 = new Waypoint({
			element: jQuery('.edd-cart-col'),
			offset: '100px',
			handler: function(direction) {
			 	if( 'down' === direction ) {
					jQuery('.edd-cart-col').addClass('stick');
				}
				if( 'up' === direction ) {
					jQuery('.edd-cart-col').removeClass('stick');
				}
			}
		});

		this.waypoint2 = new Waypoint({
			element: jQuery('.footer-section'),
			offset: '100%',
			handler: function(direction) {
			 	if( 'down' === direction ) {
					jQuery('.edd-cart-col').removeClass('stick').css({ 'top': jQuery('#edd_purchase_form').height() - jQuery('.edd-cart-col').height() - jQuery('#edd_purchase_submit').height() });
				}
				if( 'up' === direction ) {
					jQuery('.edd-cart-col').css({ 'top': '' }).addClass('stick');
				}
			}
		});

		this.waypointsInitiated = true;

	}

	destroyStickyCart() {
		if( this.waypoint1 != undefined ) {
			this.waypoint1.destroy();
		}

		if( this.waypoint2 != undefined ) {
			this.waypoint2.destroy();
		}

		jQuery('.edd-cart-col').css({ 'top': '' }).removeClass('stick');

		this.waypointsInitiated = false;
	}

}


