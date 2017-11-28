<?php
/**
 * Resource controller for bookmarks.
 *
 * @package PWK8\Bookmarker
 * @author  Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */

namespace App\Http\Controllers;

use App\Bookmark;
use App\Http\Requests\StoreBookmark;
use App\Http\Requests\UpdateBookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Resource controller for bookmarks.
 *
 * All methods of the controller require authentication.  Many methods assume there is an authenticated user.
 *
 * @see \App\Bookmark  Model for bookmarks, e.g., the entities managed by this controller.
 */
class BookmarkController extends Controller
{
    /**
     * Names of attributes of the Bookmark model which are populated by the `store` and `update` actions.
     *
     * @var array
     */
    public static $writeAttributes = ['uri', 'iconuri', 'title', 'tags', 'keyword', 'description'];

    /**
     * Format a message indicating that a bookmark was successfully stored for the first time, e.g., created.
     *
     * @param \App\Bookmark  $bookmark
     * @return string
     */
    public static function formatStoreSuccessMessage(Bookmark $bookmark)
    {
        return "The bookmark, \"{$bookmark->title}\", was created!";
        // @todo Fix smart quotes in the Modern UI.  return "The bookmark, &ldquo;{$bookmark->title}&rdquo;, was created!";
    }

    /**
     * Format a message indicating that a bookmark was successfully updated.
     *
     * @param \App\Bookmark  $bookmark
     * @return string
     */
    public static function formatUpdateSuccessMessage(Bookmark $bookmark)
    {
        return "The bookmark, \"{$bookmark->title}\", was updated!";
        // @todo Fix smart quotes in the Modern UI.  return "The bookmark, &ldquo;{$bookmark->title}&rdquo;, was updated!";
    }

    /**
     * Format a message indicating that a bookmark was successfully destroyed.
     *
     * This method must be invoked *before* the bookmark is actually destroyed, because the message includes data
     * which is cleared when the bookmark is destroyed.
     *
     * @param \App\Bookmark  $bookmark
     * @return string
     */
    public static function formatDestroySuccessMessage(Bookmark $bookmark)
    {
        return "The bookmark, \"{$bookmark->title}\", was trashed!";
        // @todo Fix smart quotes in the Modern UI.  return "The bookmark, &ldquo;{$bookmark->title}&rdquo;, was trashed!";
    }

    /**
     * Construct the controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Generate a response which redirects to the index of bookmarks.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function generateRedirectToBookmarkIndex()
    {
        return redirect()->route('bookmark.index');
    }

    /**
     * Generate a response which redirects to show a specific bookmark.
     *
     * @param  \App\Bookmark  $bookmark
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function generateRedirectToBookmarkShow(Bookmark $bookmark)
    {
        return redirect()->route('bookmark.show', ['bookmark' => $bookmark]);
    }

    /**
     * Display a list of bookmarks belonging to the authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bookmark.index', ['bookmarks' => Bookmark::allOwnedByAuthenticatedUser()]);
    }

    /**
     * Display the form for creating a new bookmark.
     *
     * The authenticated user must be authorized to `create` bookmarks.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Bookmark::class);

        return view('bookmark.create', ['bookmark' => new Bookmark]);
    }

    /**
     * Create a new bookmark in persistent storage.
     *
     * The authenticated user must be authorized to `create` bookmarks.
     *
     * @see    \App\Http\Controllers\BookmarkController::generateRedirectToBookmarkShow()
     *             Redirects to show the new bookmark.
     *
     * @param  \App\Http\Requests\StoreBookmark  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookmark $request)
    {
        $this->authorize('create', Bookmark::class);

        $bookmark = new Bookmark;
        $this->transcribeRequestToModel($request, $bookmark, self::$writeAttributes);
        $bookmark->changeOwnerToAuthenticatedUser()->save();

        return $this->generateRedirectToBookmarkShow($bookmark)
                    ->with('status', self::formatStoreSuccessMessage($bookmark));
    }

    /**
     * Display data about a specific bookmark.
     *
     * The authenticated user must be authorized to `view` the bookmark.
     *
     * @param  \App\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function show(Bookmark $bookmark)
    {
        $this->authorize('view', $bookmark);

        return view('bookmark.show', ['bookmark' => $bookmark]);
    }

    /**
     * Display the form for editing a specific bookmark.
     *
     * The authenticated user must be authorized to `update` the bookmark.
     *
     * @param  \App\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function edit(Bookmark $bookmark)
    {
        $this->authorize('update', $bookmark);

        return view('bookmark.edit', ['bookmark' => $bookmark]);
    }

    /**
     * Update a specific bookmark in persistent storage.
     *
     * The authenticated user must be authorized to `update` the bookmark.
     *
     * @see    \App\Http\Controllers\BookmarkController::generateRedirectToBookmarkShow()
     *             Redirects to show the updated bookmark.
     *
     * @param  \App\Http\Requests\UpdateBookmark  $request
     * @param  \App\Bookmark                      $bookmark
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookmark $request, Bookmark $bookmark)
    {
        $this->authorize('update', $bookmark);

        $this->transcribeRequestToModel($request, $bookmark, self::$writeAttributes);
        $bookmark->save();

        return $this->generateRedirectToBookmarkShow($bookmark)
                    ->with('status', self::formatUpdateSuccessMessage($bookmark));
    }

    /**
     * Trash (soft delete) a specific bookmark in persistent storage.
     *
     * The authenticated user must be authorized to `delete` the bookmark.
     *
     * @see    \App\Http\Controllers\BookmarkController::generateRedirectToBookmarkIndex()
     *             Redirects to the index of bookmarks.
     *
     * @param  \App\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bookmark $bookmark)
    {
        $this->authorize('delete', $bookmark);

        $successMessage = self::formatDestroySuccessMessage($bookmark);

        $bookmark->delete();

        return $this->generateRedirectToBookmarkIndex()
                    ->with('status', $successMessage);
    }
}
