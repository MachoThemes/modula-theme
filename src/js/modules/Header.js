export default class Header {

	constructor($element){
		this.$header = $element;
		this.$mainMenu = this.$header.find('.main-menu');
		this.$menuIcon = this.$header.find('.menu-icon');
		this.$mainMenu.find('.menu-item-has-children').append('<div class="menu-arrow"></div>');
		this.$menuArrow = this.$mainMenu.find('.menu-arrow');
		this.initMenu();
	}



	initMenu() {

		this.$menuArrow.on( 'click', (e) => {
			jQuery( e.target ).toggleClass('menu-arrow--open');
			jQuery( e.target ).siblings('.sub-menu').toggleClass('sub-menu--open');
		});

		this.$menuIcon.on( 'click', () => {
			this.$menuIcon.toggleClass('menu-icon--open');
			this.$mainMenu.toggleClass('main-menu--open');
		});
	}

}


