<?php
/**
 * Controller for the web content for the Modern UI.
 *
 * @package PWK8\Bookmarker
 * @author  Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller for the web content for the Modern UI.
 *
 * The Modern UI is a single page application (SPA) based on Vue.js.  The SPA communicates with the API.
 * The API has its own set of controllers, all of which are distinct from this controller.
 *
 * All methods of this controller require authentication.
 * This is because the Modern UI accesses the API, which expects a user to be authenticated.
 */
class ModernUiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the Modern UI.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modern-ui');
    }
}
