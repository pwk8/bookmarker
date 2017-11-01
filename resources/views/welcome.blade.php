{{--
    Welcome page for the Bookmarker application.

    @package PWK8\Bookmarker
    @author  The Laravel team, with substantial modifications by Philip W. Knerr <pwk8@philknerr.com>
    @license MIT
--}}<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bookmarker</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="welcome">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Bookmarker
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <p>
                            Bookmarker is a web-based application for managing bookmarks to Internet resources.
                        </p>

                        <p>
                            Bookmarks can be viewed, followed, created, updated, and trashed via a web-based
                            user interface.  This functionality is analogous to the bookmarking functionality
                            in a web browser.  However, once created in Bookmarker, a bookmark can be accessed
                            from any web browser on any device.
                        </p>

                        <p>
                            Bookmarker is a multi-user application.  You may
							<a href="{{ route('register') }}">register for an account</a>
                            or
							<a href="{{ route('login') }}">log in to an existing account</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
