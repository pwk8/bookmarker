{{--
    Display any status message which was written to the session.

    @package PWK8\Bookmarker
    @author  The Laravel team (the only change was to copy this code to a separate file)
    @license MIT
--}}

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
