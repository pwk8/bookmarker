<?php
/**
 * API routes for the entire application.
 *
 * All API routes are currently prefixed with `api/v0`.  The number after the `v` is the major version number
 * of the API.  The version numbering of the API is based on [Semantic Versioning](http://semver.org/).
 * The major version being zero thus implies that the API is in its initial development,
 * and backwards incompatible changes may be introduced.
 *
 * @package PWK8\Bookmarker
 * @author  The Laravel team, with modifications by Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
*/

Route::group(['prefix' => 'v0', 'as' => 'v0.'], function()
{
    Route::resource('user', 'UserApiController', ['only' => ['show']]);
    Route::get('/authenticated-user', 'UserApiController@showAuthenticatedUser')->name('authenticated-user.show');

    Route::resource('bookmark', 'BookmarkApiController', ['except' => ['create', 'edit']]);
});
