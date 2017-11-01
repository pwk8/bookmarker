{{--
    View for listing bookmarks.

    `$bookmarks` should be an iterable list of `Bookmark` models.

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
                <div class="panel-heading">Bookmark List</div>

                <div class="panel-body">
                    @include ('status')

                    @forelse ($bookmarks as $bookmark)
                        @if ($loop->first)
                            <ul>
                        @endif
                        <li>
                            @if ($bookmark->iconuri)
                                <a href="{{ $bookmark->uri }}"
                                   target="bookmark_{{ $bookmark->id }}"><img src="{{ $bookmark->iconuri }}"
                                                                              alt="" class="favicon"></a>
                            @endif
                            <a href="{{ $bookmark->uri }}"
                               target="bookmark_{{ $bookmark->id }}">{{ $bookmark->title ? $bookmark->title : $bookmark->uri }}</a>
                            (<a href="{{ route('bookmark.show', ['bookmark' => $bookmark]) }}">Details</a>)
                            (<a href="{{ route('bookmark.edit', ['bookmark' => $bookmark]) }}">Edit</a>)
                        </li>
                        @if ($loop->last)
                            </ul>
                        @endif
                    @empty
                        <p>You don&rsquo;t have any bookmarks yet. Just click the link below to get started!</p>
                    @endforelse

                    <p>
                        <a href="{{ route('bookmark.create') }}">Create a new bookmark</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
