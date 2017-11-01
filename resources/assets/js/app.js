/**
 * @fileoverview JavaScript logic which is available to the entire application.
 *
 * @package PWK8\Bookmarker
 * @author  Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */


/**
 * First we will load all of this project's JavaScript dependencies.
 */

require('./bootstrap');


/**
 * Confirms that a bookmark should be trashed.
 *
 * A standard JavaScript confirmation dialog is displayed.  If and only if the user confirms this dialog,
 * the form with a CSS ID of `trash-form` is submitted.
 *
 * @return {void}
 */
window.confirmBookmarkTrash = function()
{
    if (confirm('Are you sure you want to trash this bookmark?')) {
        document.getElementById('trash-form').submit();
    }
}
