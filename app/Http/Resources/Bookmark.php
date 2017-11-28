<?php
/**
 * Resource for bookmarks.
 *
 * @package PWK8\Bookmarker
 * @author  Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

/**
 * Resource for bookmarks.
 *
 * @see \App\Bookmark Model for bookmarks.
 */
class Bookmark extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array An associative array with the following keys:
     *   * `id            {!number}`
     *   * `owner_user_id {!number}`
     *   * `uri           {!string}`
     *   * `iconuri       {?string}`
     *   * `title         {?string}`
     *   * `tags          {?string}`
     *   * `keyword       {?string}`
     *   * `description   {?string}`
     *   * `created_at    {?string}`
     *   * `updated_at    {?string}`
     *   * `deleted_at    {?string}`
     */
    public function toArray($request)
    {
        return [
            'id'            => (int)$this->id,
            'owner_user_id' => (int)$this->owner_user_id,
            'uri'           => $this->uri,
            'iconuri'       => $this->iconuri,
            'title'         => $this->title,
            'tags'          => $this->tags,
            'keyword'       => $this->keyword,
            'description'   => $this->description,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
            'deleted_at'    => $this->deleted_at
        ];
    }
}
