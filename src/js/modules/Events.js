export default class Events {

    constructor($hero)
    {
        document.addEventListener('modal-2-opened', (e) => this.onModalVideoOpen(e));
        document.addEventListener('modal-2-closed', (e) => this.onModalVideoClosed(e));

    }

    onModalVideoOpen(e)
    {
        e.preventDefault();
        jQuery('.modal--video iframe').attr('src',  "https://www.youtube.com/embed/NxrTXQNExh4?feature=oembed&autoplay=1");

    }

    onModalVideoClosed(e)
    {
        e.preventDefault();
         jQuery('.modal--video iframe').attr('src',  "");

    }

}
