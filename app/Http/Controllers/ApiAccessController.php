<?php
/**
 * Controller for the web content for the API Access section.
 *
 * @package PWK8\Bookmarker
 * @author  Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller for the web content for the API Access section.
 *
 * The API Access section allows configuring external clients to access the Bookmarker API.
 * It allows generating tokens which the external clients may transmit to access the API.
 *
 * All methods of this controller require authentication.
 * This is because clients and tokens are specific to the authenticated user.
 */
class ApiAccessController extends Controller
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
     * Show the API Access section.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('api-access');
    }
}
