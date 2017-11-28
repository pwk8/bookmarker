/**
 * @fileoverview JavaScript logic for the Bookmarker user interface.
 *
 * @package PWK8\Bookmarker
 * @author  Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */


/**
 * JavaScript logic for the Bookmarker user interface.
 *
 * Text displayed to the user by JavaScript logic should be located in this file wherever possible,
 * so as to facilitate internationalization and localization in the future.
 *
 * @todo Messages, and the manner in which they are displayed, need to be polished.
 *
 * @type {!Object}
 */
module.exports = {
    /**
     * Display a success message.
     *
     * @param  {?string=}  message  A success message.  If falsy, a generic success message is displayed.
     * @return {void}
     */
    displaySuccessMessage: function(message = null)
    {
        alert(message ? message : 'Success!');
    },

    /**
     * Display an error message.
     *
     * @param  {?string=}  message  An error message.  If falsy, a generic error message is displayed.
     * @return {void}
     */
    displayErrorMessage: function(message = null)
    {
        alert(message ? message : 'Sorry, but something went wrong.');
    },

    /**
     * Confirms that the user wishes to discard unsaved changes.
     *
     * @return {boolean}  Whether the user provided confirmation.
     */
    confirmDiscardChanges: function()
    {
        return confirm('Are you sure you wish to discard unsaved changes?');
    },

    /**
     * Confirms that the user wishes to trash a bookmark.
     *
     * @return {boolean}  Whether the user provided confirmation.
     */
    confirmTrashBookmark: function()
    {
        return confirm('Are you sure you want to trash this bookmark?');
    }
};
