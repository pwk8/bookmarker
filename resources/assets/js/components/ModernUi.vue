<!--
    Vue component for the Modern UI for the Bookmarker application.

    This component requires the following modules:

    * `ApiIntegration`
    * `UserInterface`
    * `Bookmark`

    @package PWK8\Bookmarker
    @author  Philip W. Knerr <pwk8@philknerr.com>
    @license MIT
-->

<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-heading-content">
                    <span>
                        Bookmarks
                    </span>

                    <a class="action-link" v-on:click="createBookmark();">
                        Create New Bookmark
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <p class="m-b-none" v-if="bookmarkCollection.length === 0">
                    You don&rsquo;t have any bookmarks yet.  Just click the link above to get started!
                </p>
                <p v-else-if="bookmarkCollection.length === 1">
                    You have 1 bookmark:
                </p>
                <p v-else-if="bookmarkCollection.length > 1">
                    You have {{ bookmarkCollection.length }} bookmarks:
                </p>

                <ul v-if="bookmarkCollection.length > 0">
                    <li v-for="bookmark in bookmarkCollection" v-bind:key="bookmark.universal_id">
                        <a v-if="bookmark.iconuri"
                           v-bind:href="bookmark.uri"
                           v-bind:target="bookmark.universal_id"><img v-bind:src="bookmark.iconuri"
                                                                      alt=""
                                                                      class="favicon"></a>
                        <a v-bind:href="bookmark.uri"
                           v-bind:target="bookmark.universal_id">{{ bookmark.title ? bookmark.title : bookmark.uri }}</a>
                        (<a href="#" class="action-link" v-on:click.prevent="showBookmark(bookmark.id);">Details</a>)
                        (<a href="#" class="action-link" v-on:click.prevent="editBookmark(bookmark.id);">Edit</a>)
                    </li>
                </ul>
            </div>
        </div>

        <div class="modal fade" id="modal-create-bookmark" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="#" class="form-horizontal"
                          v-on:submit.prevent="storeBookmark(bookmarkToCreate);">
                        <div class="modal-header">
                            <button type="button" class="close" aria-hidden="true"
                                    v-on:click="cancelCreateBookmark();">&times;</button>

                            <h4 class="modal-title">
                                Create New Bookmark
                            </h4>
                        </div>

                        <div class="modal-body">
                            <modern-ui-bookmark-fields v-bind:bookmark="bookmarkToCreate"></modern-ui-bookmark-fields>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary pull-left">
                                Create Bookmark
                            </button>
                            <button type="button" class="btn btn-warning pull-right"
                                    v-on:click="cancelCreateBookmark();">
                                Return to Bookmark List
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-show-bookmark" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Bookmark Details
                        </h4>
                    </div>

                    <div class="modal-body">
                        <h3>
                            <img v-if="bookmarkToShow.iconuri" v-bind:src="bookmarkToShow.iconuri"
                                 alt="" class="favicon">
                            {{ bookmarkToShow.title ? bookmarkToShow.title : '(No title)' }}
                        </h3>

                        <div class="row">
                            <div class="col-md-3">
                                URI
                            </div>
                            <div class="col-md-9">
                                <a v-bind:href="bookmarkToShow.uri"
                                   v-bind:target="bookmarkToShow.universal_id">{{ bookmarkToShow.uri }}</a>
                            </div>
                        </div>
                        <div class="row hidden-lg hidden-md">
                            <br>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                Icon URI
                            </div>
                            <div class="col-md-9">
                                {{ bookmarkToShow.iconuri ? bookmarkToShow.iconuri : '(None)' }}
                            </div>
                        </div>
                        <div class="row hidden-lg hidden-md">
                            <br>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                Tags
                            </div>
                            <div class="col-md-9">
                                {{ bookmarkToShow.tags ? bookmarkToShow.tags : '(None)' }}
                            </div>
                        </div>
                        <div class="row hidden-lg hidden-md">
                            <br>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                Keywords
                            </div>
                            <div class="col-md-9">
                                {{ bookmarkToShow.keyword ? bookmarkToShow.keyword : '(None)' }}
                            </div>
                        </div>
                        <div class="row hidden-lg hidden-md">
                            <br>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                Description
                            </div>
                            <div class="col-md-9">
                                {{ bookmarkToShow.description ? bookmarkToShow.description : '(None)' }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary pull-left"
                                v-on:click="editBookmark(bookmarkToShow.id);">
                            Edit This Bookmark
                        </button>
                        <button type="button" class="btn btn-warning pull-right" data-dismiss="modal">
                            Return to Bookmark List
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-edit-bookmark" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="#" class="form-horizontal"
                          v-on:submit.prevent="updateBookmark(bookmarkToEdit);">
                        <div class="modal-header">
                            <button type="button" class="close" aria-hidden="true"
                                    v-on:click="cancelEditBookmark();">&times;</button>

                            <h4 class="modal-title">
                                Edit Bookmark
                            </h4>
                        </div>

                        <div class="modal-body">
                            <modern-ui-bookmark-fields v-bind:bookmark="bookmarkToEdit"></modern-ui-bookmark-fields>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary pull-left">
                                Update Bookmark
                            </button>
                            <button type="button" class="btn btn-danger pull-left"
                                    v-on:click="destroyBookmark(bookmarkToEdit);">
                                Trash Bookmark
                            </button>
                            <button type="button" class="btn btn-warning pull-right"
                                    v-on:click="cancelEditBookmark();">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        /**
         * The component's data.
         *
         * The data include the following keys:
         *
         * * `authenticatedUser  {!Object}`:            Information about the authenticated user.
         * * `bookmarkToCreate   {!Bookmark}`:          A bookmark which is being created.
         * * `bookmarkToShow     {!Bookmark}`:          A bookmark which is being shown.
         * * `bookmarkToEdit     {!Bookmark}`:          A bookmark which is being edited.
         * * `bookmarkCollection {!Array.<Bookmark>}`:  A collection of bookmarks owned by the authenticated user.
         *                                              The data is as returned by the `bookmark` API call.
         *
         * @return {!Object}
         */
        data() {
            return {
            	authenticatedUser:  {},
            	bookmarkToCreate:   new Bookmark,
            	bookmarkToShow:     new Bookmark,
            	bookmarkToEdit:     new Bookmark,
            	bookmarkCollection: []
            };
        },

        /**
         * Prepare the component after it is mounted (Vue 2.x).
         *
         * @return {void}
         */
        mounted() {
            let self = this;

            self.prepareComponent();
        },

        /**
         * The component's methods.
         *
         * @type {!Object}
         */
        methods: {
            /**
             * Prepare the component.
             *
             * @return {void}
             */
            prepareComponent() {
                let self = this;

                self.api = ApiIntegration.generateApiInterface();
                self.loadAuthenticatedUser();
                self.loadBookmarkCollection();
            },

            /**
             * Load information about the authenticated user from the API.
             *
             * The information is stored in the `authenticatedUser` key of the data.
             *
             * @return {void}
             */
            loadAuthenticatedUser() {
                let self = this;

                self.api.get('authenticated-user')
                        .then(response => { self.authenticatedUser = response.data.data; })
                        .catch(error => { ApiIntegration.displayApiError(error); });
            },

            /**
             * Load a collection of bookmarks owned by the authenticated user from the API.
             *
             * The information is stored in the `bookmarkCollection` key of the data.
             *
             * @return {void}
             */
			loadBookmarkCollection() {
                let self = this;

                self.api.get('bookmark')
                        .then(response => {
                            try
                            {
                                self.bookmarkCollection = [];
                                for (let i = 0; i < response.data.data.length; i++)
                                {
                                    let b = new Bookmark(response.data.data[i]);
                                    self.bookmarkCollection.push(b);
                                }
                            }
                            catch (e)
                            {
                                self.bookmarkCollection = [];
                                console.log(e);
                                UserInterface.displayErrorMessage();
                            };
                        })
                        .catch(error => { ApiIntegration.displayApiError(error); });
    		},

            /**
             * Load a specific bookmark from the API.
             *
             * @param  {!number}    id               The unique ID of the bookmark.
             * @param  {!Function}  successCallback  A callback function to be invoked if the bookmark is
             *                                       successfully loaded.  A `Bookmark` describing the loaded bookmark
             *                                       is passed as the first and only argument to this function.
             * @return {void}
             */
			loadBookmark(id, successCallback) {
                let self = this;

                self.api.get(ApiIntegration.generateUrlForBookmark(id))
                        .then(response => {
                            try
                            {
                                successCallback(new Bookmark(response.data.data));
                            }
                            catch (e)
                            {
                                console.log(e);
                                UserInterface.displayErrorMessage();
                            };
                        })
                        .catch(error => { ApiIntegration.displayApiError(error); });
			},

            /**
             * Display the form for creating a new bookmark.
             *
             * @see bookmarkToCreate  Set to a new, empty `Bookmark`.
             *
             * @return {void}
             */
            createBookmark() {
                let self = this;

                self.bookmarkToCreate = new Bookmark;
                self.showModal('modal-create-bookmark');
            },

            /**
             * Cancel creating a new bookmark.
             *
             * @see UserInterface.confirmDiscardChanges()  Confirms that the user wishes to discard changes.
             *                                             If not confirmed, cancellation is cancelled.
             *
             * @return {void}
             */
            cancelCreateBookmark() {
                let self = this;

                if (UserInterface.confirmDiscardChanges())
                {
                    self.hideModal('modal-create-bookmark');
                }
            },

            /**
             * Store a new bookmark via the API.
             *
             * @param  {!Bookmark}  bookmark  The data for the new bookmark.  The `id` property is ignored;
             *                                the API will automatically assign a unique ID to the new bookmark.
             * @return {void}
             */
            storeBookmark(bookmark) {
                let self = this;

                self.api.post('bookmark',
                              bookmark.slice([
                                  'uri',
                                  'iconuri',
                                  'title',
                                  'tags',
                                  'keyword',
                                  'description'
                              ]))
                        .then(response => {
                            try
                            {
                                UserInterface.displaySuccessMessage(response.data.message);
                                self.loadBookmarkCollection();
                                self.hideModal('modal-create-bookmark');
                            }
                            catch (e)
                            {
                                console.log(e);
                                UserInterface.displayErrorMessage();
                            };
                        })
                        .catch(error => { ApiIntegration.displayApiError(error); });
            },

            /**
             * Display data loaded from the API about a specific bookmark.
             *
             * @see bookmarkToShow  Set to the loaded `Bookmark`, provided that it is loaded successfully.
             *
             * @param  {!number}  id  The unique ID of the bookmark.
             * @return {void}
             */
            showBookmark(id) {
                let self = this;

                self.loadBookmark(id, (bookmark) => {
                    self.bookmarkToShow = bookmark;
                    self.showModal('modal-show-bookmark');
                });
            },

            /**
             * Display the form for editing a specific bookmark, populating the form with data loaded from the API.
             *
             * @see bookmarkToEdit  Set to the loaded `Bookmark`, provided that it is loaded successfully.
             *
             * @param  {!number}  id  The unique ID of the bookmark.
             * @return {void}
             */
            editBookmark(id) {
                let self = this;

                self.loadBookmark(id, (bookmark) => {
                    self.bookmarkToEdit = bookmark;
                    self.hideModal('modal-show-bookmark');
                    self.showModal('modal-edit-bookmark');
                });
            },

            /**
             * Cancel editing a bookmark.
             *
             * @see UserInterface.confirmDiscardChanges()  Confirms that the user wishes to discard changes.
             *                                             If not confirmed, cancellation is cancelled.
             *
             * @return {void}
             */
            cancelEditBookmark() {
                let self = this;

                if (UserInterface.confirmDiscardChanges())
                {
                    self.hideModal('modal-edit-bookmark');
                }
            },

            /**
             * Update a specific bookmark via the API.
             *
             * @param  {!Bookmark}  bookmark  The new data for the bookmark.  The bookmark with the same unique ID
             *                                is updated to contain this data.
             * @return {void}
             */
            updateBookmark(bookmark) {
                let self = this;

                self.api.put(ApiIntegration.generateUrlForBookmark(bookmark.id),
                             bookmark.slice([
                                 'uri',
                                 'iconuri',
                                 'title',
                                 'tags',
                                 'keyword',
                                 'description'
                             ]))
                        .then(response => {
                            try
                            {
                                UserInterface.displaySuccessMessage(response.data.message);
                                self.loadBookmarkCollection();
                                self.hideModal('modal-edit-bookmark');
                            }
                            catch (e)
                            {
                                console.log(e);
                                UserInterface.displayErrorMessage();
                            };
                        })
                        .catch(error => { ApiIntegration.displayApiError(error); });
            },

            /**
             * Destroy a specific bookmark via the API.
             *
             * @see UserInterface.confirmTrashBookmark()  Confirms that the user wishes to trash the bookmark.
             *                                            If not confirmed, trashing the bookmark is cancelled.
             *
             * @param  {!Bookmark}  bookmark  The bookmark to trash.  The bookmark with the same unique ID is trashed.
             * @return {void}
             */
            destroyBookmark(bookmark) {
                let self = this;

                if (UserInterface.confirmTrashBookmark())
                {
                    self.api.delete(ApiIntegration.generateUrlForBookmark(bookmark.id))
                            .then(response => {
                                try
                                {
                                    UserInterface.displaySuccessMessage(response.data.message);
                                    self.loadBookmarkCollection();
                                    self.hideModal('modal-edit-bookmark');
                                }
                                catch (e)
                                {
                                    console.log(e);
                                    UserInterface.displayErrorMessage();
                                };
                            })
                            .catch(error => { ApiIntegration.displayApiError(error); });
                }
            },

            /**
             * Show a modal.
             *
             * @param  {!string}  id  The CSS ID of the modal.
             * @return {void}
             */
            showModal(id) {
                $(`#${id}`).modal('show');
            },

            /**
             * Hide a modal.
             *
             * @param  {!string}  id  The CSS ID of the modal.
             * @return {void}
             */
            hideModal(id) {
                $(`#${id}`).modal('hide');
            }
        }
    }
</script>
