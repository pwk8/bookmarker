{{--
    View for creating a bookmark.

    `$bookmark` should be a `Bookmark` model.  This model is required, but it will normally be blank.
    Alternatively, the model may optionally be prefilled with default values.

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
                <div class="panel-heading">Create New Bookmark</div>

                <div class="panel-body">
                    @include ('status')
                    @include ('errors')

                    <form method="POST" action="{{ route('bookmark.store') }}" class="form-horizontal">
                        @include ('bookmark.fields')

                        <div class="row">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    Create Bookmark
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-xs-12">
                            <br>
							<br>
                            <button class="btn btn-warning"
                                    onclick="window.location='{{ route('bookmark.index') }}';">
								Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
