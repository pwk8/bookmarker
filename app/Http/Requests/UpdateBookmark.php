<?php
/**
 * Form request to update a bookmark.
 *
 * @package PWK8\Bookmarker
 * @author  Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */

namespace App\Http\Requests;

use App\Bookmark;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Form request to update a bookmark.
 *
 * @see \App\Bookmark Model for bookmarks.
 */
class UpdateBookmark extends FormRequest
{
    /**
     * Determine if the user is authorized to make the request to update a specific bookmark.
     *
     * The relevant policy should additionally be enforced.  This method only confirms that a user has authenticated.
     *
     * @param  \App\Bookmark $bookmark
     * @return bool
     */
    public function authorize(Bookmark $bookmark)
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @see    \App\Bookmark::getBaseRules() Specifies the validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return Bookmark::getBaseRules();
    }
}
