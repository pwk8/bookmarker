<?php
/**
 * Form request to store a bookmark.
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
 * Form request to store a bookmark.
 *
 * @see \App\Bookmark Model for bookmarks.
 */
class StoreBookmark extends FormRequest
{
    /**
     * Determine if the authenticated user is authorized to make the request.
     *
     * The relevant policy should additionally be enforced.  This method only confirms that a user has authenticated.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @see    \App\Bookmark::getBaseRules() Specifies the validation rules.
     * @return array
     */
    public function rules()
    {
        return Bookmark::getBaseRules();
    }
}
