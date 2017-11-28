<!--
    Vue component for the form fields for bookmarks in the Modern UI for the Bookmarker application.

    This component requires the following module:

    * `Bookmark`

    @package PWK8\Bookmarker
    @author  Philip W. Knerr <pwk8@philknerr.com>
    @license MIT
-->

<template>
    <div>
        <div class="row form-group">
            <label for="uri" class="col-md-3 control-label">
                URI
            </label>
            <div class="col-md-9">
                <input type="url" class="form-control" id="uri" name="uri" required maxlength="1023"
                       v-model="bookmark.uri">
            </div>
        </div>
        <div class="row form-group">
            <label for="iconuri" class="col-md-3 control-label">
                Icon URI
            </label>
            <div class="col-md-9">
                <input type="url" class="form-control" id="iconuri" name="iconuri" maxlength="1023"
                       v-model="bookmark.iconuri">
            </div>
        </div>
        <div class="row form-group">
            <label for="title" class="col-md-3 control-label">
                Title
            </label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="title" name="title" maxlength="255"
                       v-model="bookmark.title">
            </div>
        </div>
        <div class="row form-group">
            <label for="tags" class="col-md-3 control-label">
                Tags
            </label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="tags" name="tags" maxlength="255"
                       v-model="bookmark.tags">
            </div>
        </div>
        <div class="row form-group">
            <label for="keyword" class="col-md-3 control-label">
                Keywords
            </label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="keyword" name="keyword" maxlength="255"
                       v-model="bookmark.keyword">
            </div>
        </div>
        <div class="row form-group">
            <label for="description" class="col-md-3 control-label">
                Description
            </label>
            <div class="col-md-9">
                <textarea class="form-control" id="description" name="description" maxlength="1023"
                          v-model="bookmark.description"></textarea>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        /**
         * The component's data.
         *
         * @return {!Object}
         */
        data() {
            return {};
        },

        /**
         * The component's props.
         *
         * The props include the following:
         *
         * * `bookmark {!Bookmark}`:  A bookmark to edit.  Form fields are bound to corresponding properties
         *                            of this model.  Please note that this is a two way binding.
         *
         * The two way binding is suboptimal, but it works around two data issues:
         *
         * 1.  If the parent component supplies a different `Bookmark`, it needs to propagate down to this component,
         *     even if this clobbers pending changes.
         * 2.  If the parent component is updated, thus propagating the `Bookmark` again, this should not clobber
         *     any pending changes by the user.
         *
         * @type {!Object}
         */
        props: {
            bookmark: {
                type: Bookmark,
                required: true
            }
        }
    }
</script>
