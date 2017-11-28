<?php
/**
 * Base controller for all requests, including both web and API requests.
 *
 * @package PWK8\Bookmarker
 * @author  The Laravel team, with modifications by Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

/**
 * Base controller for all requests, including both web and API requests.
 *
 * All controllers should directly or indirectly extend this controller.
 *
 * @see \App\Http\Controllers\ApiController  The base controller which API controllers should extend.
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Transcribe specific fields of an HTTP request to the corresponding attributes of a model.
     *
     * Each attribute must have the same name as the corresponding field of the request.
     *
     * If an attribute does *not* have a corresponding field in the request, the attribute is silently ignored.
     *
     * @param  \Illuminate\Http\Request             $request
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  array                                $attributeNames  An ordered array of the names of the attributes
     *                                                               to transcribe.
     * @return $this
     */
    protected function transcribeRequestToModel(Request $request, Model $model, array $attributeNames)
    {
        foreach ($attributeNames as $key)
        {
            if ($request->exists($key))
            {
                $model->$key = $request->$key;
            }
        }

        return $this;
    }
}
