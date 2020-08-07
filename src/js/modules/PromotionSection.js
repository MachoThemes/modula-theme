export default class PromotionSection {

	constructor($element){

		this.$promotionSection = $element;

		this.initSticky();
	}

	initSticky(){

		if( ! jQuery( 'body' ).hasClass( 'page-template-pricing' ) ) {
			return;
		}

		window.addEventListener( 'scroll', () => this.makeSticky() );
	}

	makeSticky() {

	 	if ( window.pageYOffset > 0 ) {
			this.$promotionSection.addClass( 'promotion-section--sticky' );
		} else {
			this.$promotionSection.removeClass( 'promotion-section--sticky' );
		}
	}

}


