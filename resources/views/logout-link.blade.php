{{--
    View for a hyperlink to deauthenticate from (logout of) the Bookmarker application.

    The hyperlink requires that a form with a CSS ID of `logout-form` already exists in the DOM.
    Submitting this form should deauthenticate the user.

    @package PWK8\Bookmarker
    @author  The Laravel team (the only change was to copy this code to a separate file)
    @license MIT
--}}

<a href="{{ route('logout') }}"
   onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
    Logout
</a>
