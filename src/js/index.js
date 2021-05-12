import Header from './modules/Header';
import PromotionSection from './modules/PromotionSection';
import Modal from './modules/Modal';
import Events from './modules/Events';
import Accordion from './modules/Accordion';
import DocSearch from './modules/DocSearch';
import Tabs from './modules/Tabs';

class Modula {

	constructor(){
		this.initHeader();
		this.initScrollAnimation();
		this.initModals();
		this.initAccordions();
		this.initDocSearch();
		this.initEvents();
		this.initWaypoints();
		this.initPromotionSection();
		this.initCurrency();
		this.initPostNavigation();
		this.initCheckoutPage();
	}

	initHeader() {
		new Header( jQuery('.header') );
	}

	initPromotionSection() {
		new PromotionSection( jQuery('.promotion-section') );
	}

	initScrollAnimation() {

		jQuery( 'a[href*="#"]:not([href="#"])' ).on( 'click', function(e) {
			let target;
			if ( location.pathname.replace( /^\//, '' ) === this.pathname.replace( /^\//, '' ) && location.hostname === this.hostname ) {
				target = jQuery( this.hash );
				target = target.length ? target : jQuery( '[name=' + this.hash.slice( 1 ) + ']' );
				if ( target.length ) {
					e.preventDefault();
					jQuery( 'html, body' ).animate( { scrollTop: target.offset().top }, 1000, 'swing' );
				}
			}
		});
	}

	initModals() {
		new Modal( 'modal-1', jQuery('.modal--login'), jQuery('.login-link') );
		new Modal( 'modal-2', jQuery('.modal--video'), jQuery('.banner-section .hero__img, .banner-section .hero__play-icon, .hero-section-2__hero') );
                jQuery('.changelog-link').each(function() {
                    var count = jQuery(this).attr('data-count');
                    new Modal( 'modal-changelog-' + count, jQuery('#modal--changelog-' + count), jQuery('#changelog-link-' + count));
                });
	}

	initAccordions( $elements = jQuery(".accordion") ){
		$elements.each(function(index) {
			new Accordion( jQuery(this) );
		});
	}

	initDocSearch( $elements = jQuery(".doc-search") ){
		$elements.each( function() {
			new DocSearch( jQuery(this) );
		});
	}

	initEvents() {
		new Events();
	}

	initWaypoints() {

		if (typeof Waypoint === "undefined") {
			return;
		}

		jQuery('.illustration').each( function() {

			let $illustration = jQuery(this);

			new Waypoint({
				element: $illustration,
				offset: '36%',
				handler: function(direction) {
					$illustration.addClass('illustration--animate');
				}
			})

		});

		jQuery('.waypoint').each( function() {

			let $element = jQuery(this);

			new Waypoint({
				element: $element,
				offset: '75%',
				handler: function(direction) {
					$element.addClass('in-viewport');
				}
			})

		});


	}

	initPostNavigation() {

		if (typeof Waypoint === "undefined") {
			return;
		}

		if( jQuery('.post-navigation').length == 0 ) {
			return;
		}

		let $postNavigation = jQuery('.post-navigation');

		// make the post navigation stick
		new Waypoint({
			element: jQuery('.post-content'),
			offset: '200px',
			handler: function(direction) {
			 	if( 'down' === direction ) {
					$postNavigation.addClass('stick');
				}
				if( 'up' === direction ) {
					$postNavigation.removeClass('stick');
				}
			}
		});

		// hide the post navigation when reaching the bottom of the post
	 	new Waypoint({
			element: jQuery('.post-content > *:last-child'),
			offset: '200px',
			handler: function(direction) {
				if( 'down' === direction ) {
					$postNavigation.addClass('invisible');
				}
				if( 'up' === direction ) {
					$postNavigation.removeClass('invisible');
				}
			}
		});

		// hide/show the post navigation when hovering over alignwide and alignfull elements
		jQuery('.post-content .alignwide, .post-content .alignfull').on('mouseenter', () => {
			$postNavigation.addClass('invisible');
		});

		jQuery('.post-content .alignwide, .post-content .alignfull').on('mouseleave', () => {
			$postNavigation.removeClass('invisible');
		});

		//strip dashes in toc links
		jQuery('.post-navigation').find('.ez-toc-list a').each(function(index) {
 			var href = jQuery( this ).attr( 'href' );
			href = href.replace('-_', '');
			jQuery( this ).attr( 'href', href );
		});


	}

	initCurrency() {

		var cpoSymbols = {
			'EUR': '&euro;',
			'GBP': '&pound;',
			'USD': '&dollar;',
		};

		jQuery( window ).on( 'ppeddfsAfterFsMarkup', function(){
			jQuery( 'span.fsc-currency' ).each( function(){
				var $span = jQuery( this ),
					currency = $span.text();

					if ( cpoSymbols[ currency ] ) {
						$span.html( cpoSymbols[ currency ] );
					}
			});
		});
	}

	initCheckoutPage() {

		if ( ! jQuery('body').hasClass('page-template-checkout') ) {
			return;
		}

		//new CheckoutPage();
	}

}
window.Modula = new Modula();