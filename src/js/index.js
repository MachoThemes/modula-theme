import Header from './modules/Header';
import Modal from './modules/Modal';
import Events from './modules/Events';
import Accordion from './modules/Accordion';

class Modula {

    constructor()
    {
        this.initHeader();
        this.initScrollAnimation();
        this.initModals();
        this.initAccordions();
        this.initEvents();

    }

    initHeader()
    {
        new Header(jQuery('.header'));

    }

    initScrollAnimation()
    {
        jQuery('a[href*="#"]:not([href="#"])').on(
            'click',
            function ( e ) {
                let target;
                if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
                    target = jQuery(this.hash);
                    target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        e.preventDefault();
                        jQuery('html, body').animate({ scrollTop: target.offset().top }, 1000, 'swing');
                    }
                }
            }
        );

    }

    initModals()
    {
        new Modal('modal-1', jQuery('.modal--login'), jQuery('.login-link'));
        new Modal('modal-2', jQuery('.modal--video'), jQuery('.banner-section .hero__img, .banner-section .hero__play-icon, .hero-section-2__hero'));

    }

    initAccordions( $elements = jQuery(".accordion") )
    {
        $elements.each(
            function ( index ) {
                new Accordion(jQuery(this));
            }
        );

    }

    initEvents()
    {
        new Events();

    }
}

window.Modula = new Modula();