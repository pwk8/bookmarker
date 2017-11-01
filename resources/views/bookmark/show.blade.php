{{--
    View for showing a bookmark.

    The view includes an option to edit the bookmark.

    `$bookmark` should be a populated `Bookmark` model.

    @package PWK8\Bookmarker
    @author  Philip W. Knerr <pwk8@philknerr.com>
    @license MIT
--}}

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Bookmark Details</div>

                <div class="panel-body">
                    @include ('status')

                    <h3>
                        @if ($bookmark->iconuri)
                            <img src="{{ $bookmark->iconuri }}" alt="" class="favicon">
                        @endif
						@if ($bookmark->title)
    						{{ $bookmark->title }}
						@else
    						(No title)
						@endif
                    </h3>

                    <div class="row">
                        <div class="col-md-3">
                            URI
                        </div>
                        <div class="col-md-9">
                            <a href="{{ $bookmark->uri }}"
                               target="bookmark_{{ $bookmark->id }}">{{ $bookmark->uri }}</a>
                        </div>
                    </div>
					<div class="row hidden-lg hidden-md">
                        <br>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            Icon URI
                        </div>
                        <div class="col-md-9">
                            @if ($bookmark->iconuri)
                                {{ $bookmark->iconuri }}
                            @else
                                (None)
                            @endif
                        </div>
                    </div>
					<div class="row hidden-lg hidden-md">
						<br>
					</div>
                    <div class="row">
                        <div class="col-md-3">
                            Tags
                        </div>
                        <div class="col-md-9">
                            @if ($bookmark->tags)
                                {{ $bookmark->tags }}
                            @else
                                (None)
                            @endif
                        </div>
                    </div>
					<div class="row hidden-lg hidden-md">
						<br>
					</div>
                    <div class="row">
                        <div class="col-md-3">
                            Keywords
                        </div>
                        <div class="col-md-9">
                            @if ($bookmark->keyword)
                                {{ $bookmark->keyword }}
                            @else
                                (None)
                            @endif
                        </div>
                    </div>
					<div class="row hidden-lg hidden-md">
						<br>
					</div>
                    <div class="row">
                        <div class="col-md-3">
                            Description
                        </div>
                        <div class="col-md-9">
                            @if ($bookmark->description)
                                {{ $bookmark->description }}
                            @else
                                (None)
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <br>
                            <a href="{{ route('bookmark.edit', ['bookmark' => $bookmark]) }}">Edit This Bookmark</a>
                            |
                            <a href="{{ route('bookmark.index') }}">Return to Bookmark List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
