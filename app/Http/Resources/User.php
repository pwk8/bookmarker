<?php
/**
 * Resource for users.
 *
 * @package PWK8\Bookmarker
 * @author  Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

/**
 * Resource for users.
 *
 * @see \App\User Model for users.
 */
class User extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array An associative array with the following keys:
     *   * `id         {!number}`
     *   * `name       {!string}`
     *   * `email      {!string}`
     *   * `created_at {?string}`
     *   * `updated_at {?string}`
     */
    public function toArray($request)
    {
        return [
            'id'         => (int)$this->id,
            'name'       => $this->name,
            'email'      => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
