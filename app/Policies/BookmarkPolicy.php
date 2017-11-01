<?php
/**
 * Authorization policy for bookmarks.
 *
 * @package PWK8\Bookmarker
 * @author  Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */

namespace App\Policies;

use App\User;
use App\Bookmark;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Authorization policy for bookmarks.
 *
 * @see \App\Bookmark Model for bookmarks, e.g., the resources authorized based on this policy.
 */
class BookmarkPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether a specific user can view a specific bookmark.
     *
     * @param  \App\User     $user
     * @param  \App\Bookmark $bookmark
     * @return bool
     */
    public function view(User $user, Bookmark $bookmark)
    {
        return $bookmark->isOwnedBy($user);
    }

    /**
     * Determine whether a specific user can create bookmarks.
     *
     * @param  \App\User $user
     * @return bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether a specific user can update a specific bookmark.
     *
     * @param  \App\User     $user
     * @param  \App\Bookmark $bookmark
     * @return bool
     */
    public function update(User $user, Bookmark $bookmark)
    {
        return $bookmark->isOwnedBy($user);
    }

    /**
     * Determine whether a specific user can delete a specific bookmark.
     *
     * @param  \App\User     $user
     * @param  \App\Bookmark $bookmark
     * @return bool
     */
    public function delete(User $user, Bookmark $bookmark)
    {
        return $bookmark->isOwnedBy($user);
    }
}
