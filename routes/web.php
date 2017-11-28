<?php
/**
 * Web routes for the entire application.
 *
 * @package PWK8\Bookmarker
 * @author  The Laravel team, with modifications by Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('bookmark', 'BookmarkController');

Route::get('/modern-ui', 'ModernUiController@index')->name('modern-ui');

Route::get('/api-access', 'ApiAccessController@index')->name('api-access');
