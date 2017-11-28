<?php
/**
 * Base controller for the API.
 *
 * @package PWK8\Bookmarker
 * @author  Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */

namespace App\Http\Controllers;

use Illuminate\Http\Response as IlluminateResponse;

/**
 * Base controller for the API.
 *
 * Controllers for the API should extend this controller.
 *
 * API responses are always in JSON format.  The outermost element is always a JavaScript `Object`,
 * e.g., a PHP associative array.
 *
 * The outermost element may include an optional key named `errors`.  The value of this key is a JavaScript `Array`,
 * e.g., a PHP ordered array.  Each element thereof specifies an error condition and includes the following keys:
 *
 * * `message {!string}`:  A human-readable error message.
 * * `code {!number}`:     An integer representing an error code.
 *
 * By convention, the values of error codes in the `errors` key should follow this pattern:
 *
 * * If an HTTP status code closely corresponds to the error condition, it should be used as the value.
 * * Otherwise, if the error condition is a problem with the request, the value should be between 4000 and 4999.
 * * Otherwise, the value should be between 5000 and 5999.
 *
 * In API responses, the HTTP status code is authoritative as to the status of the request.  Specifically:
 *
 * * 200-series HTTP status codes indicate overall success.  If the `errors` key is present, it describes warning
 *   conditions in an otherwise successful request.
 * * 400-series and 500-series HTTP status codes indicate overall failure, whether or not the `errors` key is included.
 *
 * In some cases, API controllers invoke logic from the corresponding web controllers.  Because API controllers
 * do *not* extend the corresponding web controllers, any such logic must be declared as `public`.
 * This is suboptimal, but it is preferable to the following alternatives:
 *
 * * Duplicating the logic would result in code that is not DRY.
 * * Placing controller logic in the corresponding model would defy the MVC architecture.
 * * Having API controllers extend the corresponding web controllers would result in nonexistent API methods having
 *   the same behavior as the corresponding web methods, which could have undesirable results.
 */
class ApiController extends Controller
{
    /**
     * The pending HTTP status code to be included in the API response.
     *
     * The value will be `200 OK` until and unless another HTTP status code is set.
     *
     * @var int
     */
    protected $httpStatusCode = IlluminateResponse::HTTP_OK;

    /**
     * Pending errors to be included in the API response.
     *
     * @var array An ordered array with the same format as the `errors` key of API responses.
     */
    protected $errors = [];

    /**
     * Determine whether a numeric code is a valid HTTP status code.
     *
     * @param  int  $code  The numeric code.
     * @return bool
     */
    public static function isValidHttpStatusCode($code)
    {
        $code = (int)$code;

        return array_key_exists($code, IlluminateResponse::$statusTexts);
    }

    /**
     * Determine whether a numeric code is a valid HTTP error code.
     *
     * Valid HTTP error codes are defined as valid HTTP status codes of 400 or greater.
     *
     * @see    \App\Http\Controllers\ApiController::isValidHttpStatusCode()  Determines whether a numeric code
     *                                                                       is a valid HTTP status code.
     *
     * @param  int  $code  The numeric code.
     * @return bool
     */
    public static function isValidHttpErrorCode($code)
    {
        $code = (int)$code;

        return (($code >= 400) && self::isValidHttpStatusCode($code));
    }

    /**
     * Gets the pending HTTP status code.
     *
     * @return int  The HTTP status code.
     */
    public function getHttpStatusCode()
    {
        return $this->httpStatusCode;
    }

    /**
     * Sets the pending HTTP status code.
     *
     * If the specified code is invalid, the HTTP status code is instead set to `500 Internal Server Error`.
     * @todo This situation should be logged.
     *
     * @param  int   $code  The HTTP status code.
     * @return $this
     */
    public function setHttpStatusCode($code)
    {
        $code = (int)$code;

        $this->httpStatusCode = self::isValidHttpStatusCode($code)
            ? $code
            : IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR;

        return $this;
    }

    /**
     * Gets the pending errors.
     *
     * @return array  An ordered array with the same format as the `errors` key of API responses.
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Adds a pending error.
     *
     * The pending HTTP status code is set to:
     *
     * * The specified numeric error code, if it represents a valid HTTP error code.
     * * `500 Internal Server Error`, otherwise.
     *
     * @param  string    $message  A human-readable error message.
     * @param  int|null  $code     A numeric error code.  Defaults to `500`.
     * @return $this
     */
    public function addError($message, $code = null)
    {
        $code = ($code === null) ? IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR : (int)$code;

        $this->errors[] = [
            'message' => $message,
            'code' => (int)$code
        ];

        $this->setHttpStatusCode(self::isValidHttpErrorCode($code)
            ? $code
            : IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR);

        return $this;
    }

    /**
     * Generates an API response.
     *
     * @param  mixed  $data  The data to encode in the API response.
     * @return \Illuminate\Http\JsonResponse  The generated response.
     */
    public function respond($data)
    {
        return response()->json($data, $this->httpStatusCode);
    }

    /**
     * Generates an API response including any pending errors.
     *
     * @param  mixed  $data  The data to encode in the API response.  If omitted, only the errors are included.
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithErrors($data = null)
    {
        $data = ($data === null) ? [] : (array)$data;

        if (count($this->errors) >= 1)
        {
            $data['errors'] = $this->errors;
        }

        return $this->respond($data);
    }

    /**
     * Generates an API response indicating that an entity was created.
     *
     * The HTTP status code is set to `201 Created`.
     *
     * @param  string  $message  A human-readable status message.
     * @return \Illuminate\Http\JsonResponse  The generated response.
     */
    public function respondCreated($message = 'Created!')
    {
        $this->setHttpStatusCode(IlluminateResponse::HTTP_CREATED);

        return $this->respond(['message' => $message]);
    }

    /**
     * Generates an API response indicating that an update to, or the destruction of, an entity was accepted.
     *
     * The HTTP status code is set to `202 Accepted`.
     *
     * @param  string  $message  A human-readable status message.
     * @return \Illuminate\Http\JsonResponse  The generated response.
     */
    public function respondAccepted($message = 'Accepted!')
    {
        $this->setHttpStatusCode(IlluminateResponse::HTTP_ACCEPTED);

        return $this->respond(['message' => $message]);
    }

    /**
     * Generates an API response indicating that an entity was not found.
     *
     * The HTTP status code is set to `404 Not Found`.
     *
     * @param  string  $message  A human-readable error message.
     * @return \Illuminate\Http\JsonResponse  The generated response.
     */
    public function respondNotFound($message = 'Not Found!')
    {
        $this->addError($message, IlluminateResponse::HTTP_NOT_FOUND);

        return $this->respondWithErrors();
    }

    /**
     * Generates an API response indicating that an internal server error occurred.
     *
     * The HTTP status code is set to `500 Internal Server Error`.
     *
     * @param  string  $message  A human-readable error message.
     * @return \Illuminate\Http\JsonResponse  The generated response.
     */
    public function respondInternalServerError($message = 'Error!')
    {
        $this->addError($message, IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR);

        return $this->respondWithErrors();
    }
}
