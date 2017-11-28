<?php
/**
 * Resource API controller for users.
 *
 * @package PWK8\Bookmarker
 * @author  Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */

namespace App\Http\Controllers;

use App\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;

/**
 * Resource API controller for users.
 *
 * All methods of the controller require authentication.  Many methods assume there is an authenticated user.
 *
 * @see \App\User Model for users, e.g., the entities managed by this controller.
 */
class UserApiController extends ApiController
{
    /**
     * Names of properties which are subject to CRUD operations.
     *
     * @var array
     */
    private static $fieldNames = ['name', 'email'];

    /**
     * Construct the controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @todo Not implemented yet.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->respondNotFound('This action is not currently supported.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * This action is not implemented.  It is likely unnecessary because the Modern UI will include the form.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->respondNotFound('This action is not currently supported.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @todo Not implemented yet.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->respondNotFound('This action is not currently supported.');
    }

    /**
     * Respond with data about a specific user.
     *
     * The authenticated user must be authorized to `view` the user.
     *
     * @param  \App\User  $user
     * @return \App\Http\Resources\User
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * This action is not implemented.  It is likely unnecessary because the Modern UI will include the form.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return $this->respondNotFound('This action is not currently supported.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @todo Not implemented yet.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        return $this->respondNotFound('This action is not currently supported.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @todo Not implemented yet.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        return $this->respondNotFound('This action is not currently supported.');
    }

    /**
     * Respond with data about the authenticated user.
     *
     * This action is defined as being identical to the `show` action of this controller when invoked with
     * the `id` of the authenticated user.
     *
     * @see    \App\Http\Controllers\UserApiController:show()  The `show` action of this controller.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\User
     */
    public function showAuthenticatedUser(Request $request)
    {
        return $this->show($request->user());
    }
}
