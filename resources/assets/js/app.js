/**
 * @fileoverview JavaScript logic which is available to the entire Bookmarker application.
 *
 * @package PWK8\Bookmarker
 * @author  Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
ApiIntegration = require('./api-integration');
UserInterface = require('./user-interface');
Bookmark = require('./classes/Bookmark');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

Vue.component(
    'modern-ui',
    require('./components/ModernUi.vue')
);

Vue.component(
    'modern-ui-bookmark-fields',
    require('./components/ModernUiBookmarkFields.vue')
);

const app = new Vue({
    el: '#app'
});

/**
 * Confirms that a bookmark should be trashed.
 *
 * The form with a CSS ID of `trash-form` is submitted.
 *
 * @see UserInterface.confirmTrashBookmark()  Confirms that the user wishes to trash the bookmark.
 *                                            If not confirmed, trashing the bookmark is cancelled.
 *
 * @return {void}
 */
window.confirmBookmarkTrash = function()
{
    if (UserInterface.confirmTrashBookmark()) {
        document.getElementById('trash-form').submit();
    }
}
