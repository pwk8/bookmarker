{{--
    View for the API Access section of the Bookmarker application.

    @package PWK8\Bookmarker
    @author  Philip W. Knerr <pwk8@philknerr.com>
    @license MIT
--}}

@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div id="app" class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div style="display: flex; justify-content: space-between; align-items: center;">
                        <span>
                            API Access
                        </span>
					</div>
                </div>
                <div class="panel-body">
                    <p>
                        Here, you may configure access to the Bookmarker API from an external application.
                    </p>

                    <p>
                        <em>Important:</em>
                        Any clients registered on this page are specific to your account.
                        Similarly, any tokens generated on this page access your account.
                    </p>
				</div>
            </div>

            <passport-clients></passport-clients>
            <passport-authorized-clients></passport-authorized-clients>
            <passport-personal-access-tokens></passport-personal-access-tokens>

            <div class="panel panel-default">
                <div class="panel-body">
                    <div>
                        <span>
                            <small>
                                This page requires JavaScript.
                                Moreover, it may not work in older browsers,
                                including Internet Explorer version 8 or earlier.
                            </small>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
