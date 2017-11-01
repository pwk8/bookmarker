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
 * @see \App\Bookmark Model for bookmarks, e.g., the resources managed by this controller.
 */
class BookmarkController extends Controller
{
    /**
     * Names of properties which are subject to CRUD operations.
     *
     * @var array
     */
    private static $fieldNames = ['uri', 'iconuri', 'title', 'tags', 'keyword', 'description'];

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
     * Apply specific fields in an HTTP request to the model of a bookmark.
     *
     * If a field does not exist in the request, it is silently ignored.
     *
     * @see    \App\Http\Controllers\BookmarkController::$fieldNames Names the fields to be applied.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Bookmark $bookmark
     * @return void
     */
    protected function applyRequestToModel(Request $request, Bookmark $bookmark)
    {
        foreach (self::$fieldNames as $key)
        {
            if ($request->exists($key))
            {
                $bookmark->$key = $request->$key;
            }
        }
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
     * @param  \App\Bookmark
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
        $bookmarks = Bookmark::where('owner_user_id', '=', Auth::id())->orderBy('id')->get();

        return view('bookmark.index', ['bookmarks' => $bookmarks]);
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
     * @param  \App\Http\Requests\StoreBookmark $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookmark $request)
    {
        $this->authorize('create', Bookmark::class);

        $bookmark = new Bookmark;
        $this->applyRequestToModel($request, $bookmark);
        $bookmark->owner_user_id = Auth::id();
        $bookmark->save();

        return $this->generateRedirectToBookmarkShow($bookmark)
            ->with('status', "The bookmark, &ldquo;{$bookmark->title}&rdquo;, was created!");
    }

    /**
     * Display data about a specific bookmark.
     *
     * The authenticated user must be authorized to `view` the bookmark.
     *
     * @param  \App\Bookmark $bookmark
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
     * @param  \App\Bookmark $bookmark
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
     * @param  \App\Http\Requests\UpdateBookmark $request
     * @param  \App\Bookmark $bookmark
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookmark $request, Bookmark $bookmark)
    {
        $this->authorize('update', $bookmark);

        $this->applyRequestToModel($request, $bookmark);
        $bookmark->save();

        return $this->generateRedirectToBookmarkShow($bookmark)
            ->with('status', "The bookmark, &ldquo;{$bookmark->title}&rdquo;, was updated!");
    }

    /**
     * Trash (soft delete) a specific bookmark in persistent storage.
     *
     * The authenticated user must be authorized to `delete` the bookmark.
     *
     * @see    \App\Http\Controllers\BookmarkController::generateRedirectToBookmarkIndex()
     *             Redirects to the index of bookmarks.
     *
     * @param  \App\Bookmark $bookmark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bookmark $bookmark)
    {
        $this->authorize('delete', $bookmark);

        $oldTitle = $bookmark->title;

        $bookmark->delete();

        return $this->generateRedirectToBookmarkIndex()
            ->with('status', "The bookmark, &ldquo;$oldTitle&rdquo;, was trashed!");
    }
}
