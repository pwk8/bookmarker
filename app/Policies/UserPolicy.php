<?php
/**
 * Authorization policy for users.
 *
 * @package PWK8\Bookmarker
 * @author  Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Authorization policy for users.
 *
 * The user requesting authorization and the user to be accessed may be the same user.
 * In fact, this policy should be applied to such requests.
 *
 * @see \App\User Model for users, e.g., the entities to which access is authorized based on this policy.
 */
class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether a specific user can view another specific user.
     *
     * @param  \App\User  $userToAuthorize  The user requesting authorization.
     * @param  \App\User  $targetUser       The user to be viewed.
     * @return bool
     */
    public function view(User $userToAuthorize, User $targetUser)
    {
        return ($userToAuthorize->id == $targetUser->id);
    }

    /**
     * Determine whether a specific user can create other users.
     *
     * @param  \App\User  $userToAuthorize  The user requesting authorization.
     * @return bool
     */
    public function create(User $userToAuthorize)
    {
        return false;
    }

    /**
     * Determine whether a specific user can update another specific user.
     *
     * @param  \App\User  $userToAuthorize  The user requesting authorization.
     * @param  \App\User  $targetUser       The user to be updated.
     * @return bool
     */
    public function update(User $userToAuthorize, User $targetUser)
    {
        return ($userToAuthorize->id == $targetUser->id);
    }

    /**
     * Determine whether a specific user can delete another specific user.
     *
     * @param  \App\User  $userToAuthorize  The user requesting authorization.
     * @param  \App\User  $targetUser       The user to be deleted.
     * @return bool
     */
    public function delete(User $userToAuthorize, User $targetUser)
    {
        return false;
    }
}
