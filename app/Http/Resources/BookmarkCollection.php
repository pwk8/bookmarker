<?php
/**
 * Resource for bookmark collections.
 *
 * @package PWK8\Bookmarker
 * @author  Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Resource for bookmark collections.
 *
 * @see \App\Http\Resources\Bookmark Resource for individual bookmarks.
 * @see \App\Bookmark                Model for bookmarks.
 */
class BookmarkCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
