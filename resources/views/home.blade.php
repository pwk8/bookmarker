{{--
    Dashboard for the Bookmarker application.

    @package PWK8\Bookmarker
    @author  The Laravel team, with substantial modifications by Philip W. Knerr <pwk8@philknerr.com>
    @license MIT
--}}

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @include ('status')

                    <p>
                        Hello, {{ Auth::user()->name }}! You are now logged in.
                    </p>

                    <hr>

                    <p>
                        <a href="{{ route('modern-ui') }}">Go to the Modern UI.</a><br>
                        This is a modern user interface based on the Vue.js framework.
                    </p>

                    <hr>

                    <p>
                        <a href="{{ route('bookmark.index') }}">Go to the Classic UI.</a><br>
                        This is a traditional user interface.
                        Use this if JavaScript is disabled or you are using an older browser,
                        including Internet Explorer version 8 or earlier.
                    </p>

                    <hr>

                    <p>
                        <a href="{{ route('api-access') }}">Configure API access.</a><br>
                        This section is only necessary if you wish to access the Bookmarker API
                        from an external application.
                    </p>

                    <hr>

                    <p>
                        @include ('logout-link')
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
