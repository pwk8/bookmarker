{{--
    Common fields for modifying a bookmark.

    `$bookmark` should be a `Bookmark` model.  When creating a new bookmark, this model is still required,
    but it will normally be blank.

    If there are any errors, old field values are redisplayed.  Otherwise, field values are read from
    the model in the `$bookmark` variable.

    On `xs` and `sm` screen sizes (including most mobile devices), the labels are above the fields.
    (Unlike on larger screen sizes, they are not to the left because there isn't enough space there.)

    `auth/login.blade.php` was used as a template, especially for flagging error fields.

    @package PWK8\Bookmarker
    @author  Philip W. Knerr <pwk8@philknerr.com>
    @license MIT
--}}

{{ csrf_field() }}
<div class="row form-group{{ $errors->has('uri') ? ' has-error' : '' }}">
    <label for="uri" class="col-md-3 control-label">
        URI
    </label>
    <div class="col-md-9">
        <input type="url" class="form-control" id="uri" name="uri" required maxlength="1023"
               value="{{ $errors->any() ? old('uri') : $bookmark->uri }}">
    </div>
</div>
<div class="row form-group{{ $errors->has('iconuri') ? ' has-error' : '' }}">
    <label for="iconuri" class="col-md-3 control-label">
        Icon URI
    </label>
    <div class="col-md-9">
        <input type="url" class="form-control" id="iconuri" name="iconuri" maxlength="1023"
               value="{{ $errors->any() ? old('iconuri') : $bookmark->iconuri }}">
    </div>
</div>
<div class="row form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label for="title" class="col-md-3 control-label">
        Title
    </label>
    <div class="col-md-9">
        <input type="text" class="form-control" id="title" name="title" maxlength="255"
               value="{{ $errors->any() ? old('title') : $bookmark->title }}">
    </div>
</div>
<div class="row form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
    <label for="tags" class="col-md-3 control-label">
        Tags
    </label>
    <div class="col-md-9">
        <input type="text" class="form-control" id="tags" name="tags" maxlength="255"
               value="{{ $errors->any() ? old('tags') : $bookmark->tags }}">
    </div>
</div>
<div class="row form-group{{ $errors->has('keyword') ? ' has-error' : '' }}">
    <label for="keyword" class="col-md-3 control-label">
        Keywords
    </label>
    <div class="col-md-9">
        <input type="text" class="form-control" id="keyword" name="keyword" maxlength="255"
               value="{{ $errors->any() ? old('keyword') : $bookmark->keyword }}">
    </div>
</div>
<div class="row form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label for="description" class="col-md-3 control-label">
        Description
    </label>
    <div class="col-md-9">
        <textarea class="form-control" id="description" name="description"
                  maxlength="1023">{{ $errors->any() ? old('description') : $bookmark->description }}</textarea>
    </div>
</div>
