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
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @include ('status')

                    <p>
                        Hello, {{ Auth::user()->name }}! You are now logged in.
                    </p>

                    <p>
                        <a href="{{ route('bookmark.index') }}">Go to your bookmark list.</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
