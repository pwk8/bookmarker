<?php
/**
 * Model for bookmarks.
 *
 * @package PWK8\Bookmarker
 * @author  Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model for bookmarks.
 *
 * @see \App\Http\Controllers\BookmarkController Resource controller for bookmarks.
 * @see \App\Http\Requests\StoreBookmark         Form request to store a bookmark.
 * @see \App\Http\Requests\UpdateBookmark        Form request to update a bookmark.
 * @see \App\Policies\BookmarkPolicy             Authorization policy for bookmarks.
 */
class Bookmark extends Model
{
    use SoftDeletes;

    /**
     * Names of attributes for which mass assignment is disallowed.
     *
     * @var array
     */
    protected $guarded = ['owner_user_id'];

    /**
     * Return the base validation rules for this model.
     *
     * @return array
     */
    public static function getBaseRules()
    {
        return [
            'uri'         => 'required|url|max:1023',
            'iconuri'     => 'nullable|url|max:1023',
            'title'       => 'nullable|max:255',
            'tags'        => 'nullable|max:255',
            'keyword'     => 'nullable|max:255',
            'description' => 'nullable|max:1023'
        ];
    }

    /**
     * Determine whether the bookmark is owned by a specific user.
     *
     * @param  \App\User $user
     * @return bool
     */
    public function isOwnedBy(User $user)
    {
        return ($user->id === $this->owner_user_id);
    }
}
