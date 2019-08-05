export default class Testimonials {

	constructor($element){
 		this.$testimonials = $element;

		this.$testimonials.slick({
			adaptiveHeight: true,
			autoplay: true,
			autoplaySpeed: 5000,
			arrows: false,
			dots: true
		});
	}



}


