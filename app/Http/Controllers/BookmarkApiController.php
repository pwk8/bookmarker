<?php
/**
 * Resource API controller for bookmarks.
 *
 * @package PWK8\Bookmarker
 * @author  Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */

namespace App\Http\Controllers;

use App\Bookmark;
use App\Http\Requests\StoreBookmark;
use App\Http\Requests\UpdateBookmark;
use App\Http\Resources\Bookmark as BookmarkResource;
use App\Http\Resources\BookmarkCollection as BookmarkCollectionResource;
use Illuminate\Http\Request;

/**
 * Resource API controller for bookmarks.
 *
 * All methods of the controller require authentication.  Many methods assume there is an authenticated user.
 *
 * @see \App\Bookmark  Model for bookmarks, e.g., the entities managed by this controller.
 */
class BookmarkApiController extends ApiController
{
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
     * Respond with data about a collection of bookmarks belonging to the authenticated user.
     *
     * @return \App\Http\Resources\BookmarkCollection
     */
    public function index()
    {
        return new BookmarkCollectionResource(Bookmark::allOwnedByAuthenticatedUser());
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
     * Create a new bookmark in persistent storage.
     *
     * The authenticated user must be authorized to `create` bookmarks.
     *
     * @param  \App\Http\Requests\StoreBookmark  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookmark $request)
    {
        $this->authorize('create', Bookmark::class);

        $bookmark = new Bookmark;
        $this->transcribeRequestToModel($request, $bookmark, BookmarkController::$writeAttributes);
        $bookmark->changeOwnerToAuthenticatedUser()->save();

        return $this->respondCreated(BookmarkController::formatStoreSuccessMessage($bookmark));
    }

    /**
     * Respond with data about a specific bookmark.
     *
     * The authenticated user must be authorized to `view` the bookmark.
     *
     * @param  \App\Bookmark  $bookmark
     * @return \App\Http\Resources\Bookmark
     */
    public function show(Bookmark $bookmark)
    {
        $this->authorize('view', $bookmark);

        return new BookmarkResource($bookmark);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * This action is not implemented.  It is likely unnecessary because the Modern UI will include the form.
     *
     * @param  \App\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function edit(Bookmark $bookmark)
    {
        return $this->respondNotFound('This action is not currently supported.');
    }

    /**
     * Update a specific bookmark in persistent storage.
     *
     * The authenticated user must be authorized to `update` the bookmark.
     *
     * @param  \App\Http\Requests\UpdateBookmark  $request
     * @param  \App\Bookmark                      $bookmark
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookmark $request, Bookmark $bookmark)
    {
        $this->authorize('update', $bookmark);

        $this->transcribeRequestToModel($request, $bookmark, BookmarkController::$writeAttributes);
        $bookmark->save();

        return $this->respondAccepted(BookmarkController::formatUpdateSuccessMessage($bookmark));
    }

    /**
     * Trash (soft delete) a specific bookmark in persistent storage.
     *
     * The authenticated user must be authorized to `delete` the bookmark.
     *
     * @param  \App\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bookmark $bookmark)
    {
        $this->authorize('delete', $bookmark);

        $successMessage = BookmarkController::formatDestroySuccessMessage($bookmark);

        $bookmark->delete();

        return $this->respondAccepted($successMessage);
    }
}
