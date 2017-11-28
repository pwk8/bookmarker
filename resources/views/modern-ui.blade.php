{{--
    View for the Modern UI for the Bookmarker application.

    @package PWK8\Bookmarker
    @author  Philip W. Knerr <pwk8@philknerr.com>
    @license MIT
--}}

@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div id="app" class="col-xs-12">
			<modern-ui></modern-ui>

			<div class="panel panel-default">
				<div class="panel-body">
					<div>
                        <span>
                            <small>
								The Modern UI requires JavaScript.
								Moreover, it may not work in older browsers,
                                including Internet Explorer version 8 or earlier.
								If the Modern UI is not working for you,
								<nobr><a href="{{ route('bookmark.index') }}">try the Classic UI instead.</a></nobr>
							</small>
                        </span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
