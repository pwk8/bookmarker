{{--
    View for editing a bookmark.

    The view includes an option to trash (soft delete) the bookmark.

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
                <div class="panel-heading">Edit Bookmark</div>

                <div class="panel-body">
                    @include ('status')
                    @include ('errors')

                    <form method="POST" action="{{ route('bookmark.update', ['bookmark' => $bookmark]) }}"
                          class="form-horizontal">
                        {{ method_field('PUT') }}

                        @include ('bookmark.fields')

                        <div class="row">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    Update Bookmark
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-xs-6">
                            <br>
                            <br>
							<button class="btn btn-warning"
									onclick="window.location='{{ route('bookmark.show', ['bookmark' => $bookmark]) }}';">
								Cancel
							</button>
                        </div>
                        <div class="col-xs-6">
                            <br>
                            <br>
                            <button class="btn btn-danger pull-right"
                                    onclick="event.preventDefault();
                                             confirmBookmarkTrash();">
                                Move Bookmark to the Trash
                            </button>

                            <form id="trash-form" class="hidden" method="POST"
                                  action="{{ route('bookmark.destroy', ['bookmark' => $bookmark]) }}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
