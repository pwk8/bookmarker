{{--
    Display any validation errors which were flashed to the session.

    @package PWK8\Bookmarker
    @author  Philip W. Knerr <pwk8@philknerr.com>
    @license MIT
--}}

@if ($errors->any())
    <div class="alert alert-danger">
        <p>
            @if ($errors->count() === 1)
                Please correct the following error:
            @else
                Please correct the following errors:
            @endif
        </p>
        <ul>
            @foreach ($errors->all() as $message)
            <li>
                {{ $message }}
            </li>
            @endforeach
        </ul>
    </div>
@endif
