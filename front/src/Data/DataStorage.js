import DataContainer from '@/Data/DataContainer';


export default class DataStorage {
    /** @type {DataContainer} */
    articles;

    /** @type {?number} */
    loggedAsId = null;

    /** @type {Boolean} */
    ready = false;

    constructor () {
        this.articles = new DataContainer(DataContainer.TYPE_ARTICLE);

    }

    loadData () {
        return this.articles.load().then(articles => {
            this.onDataAvailable();
            return articles;
        });
    }

    onDataAvailable () {
        this.ready = this.isReady();

        if (this.ready) {
            console.log('Data storage ready.');
        }
    }

    /**
     * @return {boolean}
     */
    isReady () {
        return this.articles.ready
    }


    /**
     * @return {?Article[]}
     */
    getArticles () {
        return this.articles.data;
    }


    /**
     * @param {number} id
     * @return {?Article}
     */
    getArticle (id) {
        return this.articles.data.find(article => article.id === id );
    }


    /**
     * @param article
     */
    removeArticle (article) {
        this.articles.data.splice(this.articles.data.indexOf(article), 1);
    }


    // /**
    //  * @return {?User}
    //  */
    // getLoggedUser () {
    //     return this.users.data.find(user => user.id === this.loggedAsId);
    // }
}
