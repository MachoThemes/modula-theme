export default class Hero {

	constructor($hero){
 		this.$hero = $hero;

		//events
		this.$hero.on( 'click', (e) => this.onHeroClick(e) );
		document.addEventListener( 'modal-closed', (e) => this.onModalClosed(e) );
	}

	onHeroClick(e){
		e.preventDefault();
		jQuery('.modal--video iframe').attr('src',  "https://www.youtube.com/embed/NxrTXQNExh4?feature=oembed&autoplay=1");
	}

	onModalClosed(e) {
		jQuery('.modal--video iframe').attr('src',  "");
	}

}


