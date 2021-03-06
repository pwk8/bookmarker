/**
 * @fileoverview JavaScript logic for integration with the Bookmarker API.
 *
 * @package PWK8\Bookmarker
 * @author  Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */


axios = require('axios');
UserInterface = require('./user-interface');


/**
 * JavaScript logic for integration with the Bookmarker API.
 *
 * The base URL for the API is defined as the subset of the URL which is common to all requests for a specific
 * version of the API.  This subset includes everything up to and including the section specifying the version,
 * along with the following slash character.
 *
 * @type {!Object}
 */
module.exports = {
    /**
     * Generate an interface to make requests to the API from JavaScript logic.
     *
     * When using this interface, the URL should be relative to the base URL for the API.
     * This will facilitate upgrading JavaScript code to newer versions of the API.
     *
     * The interface has the following defaults:
     *
     * * Base URL:  `/api/v0/`, with the same protocol and hostname as the original request.
     * * Timeout:   10 seconds.
     *
     * @return {axios.Axios}
     */
    generateApiInterface: function() {
        return axios.create({
            baseURL: '/api/v0/',
            timeout: 10000
        });
    },

    /**
     * Display an error returned by the API.
     *
     * Information about the error is logged to the console.
     *
     * Please note that this function *cannot* directly be passed to the `axios.catch()` method.
     * Instead, use an arrow function, like this:
     *
     * ```
     * axios.get('url')
     *      .then(response => { self.data = response.data.data; })
     *      .catch(error => { ApiIntegration.displayApiError(error); });
     * ```
     *
     * @see UserInterface.displayErrorMessage()  Displays the error message.
     *
     * @param  {!Object}  error  An error, in the format returned by axios.
     * @return {void}
     */
    displayApiError: function(error) {
        let message = [];

        console.log('The following API request failed:');
        console.log(error.config);

        if (error.response)
        {
            console.log('The API response indicating failure was as follows:');
            console.log(error.response);

            try
            {
                for (let i = 0; i < error.response.data.errors.length; i++)
                {
                    message.push(error.response.data.errors[i].message);
                }
            }
            catch (e)
            {
                // If there is no `errors` key, look at the HTTP status code instead.
                // Do the same as a failsafe if the `errors` key could not be parsed.
            }

            if (message.length === 0)
            {
                try
                {
                    switch (error.response.status)
                    {
                        case 401:
                            message.push('Sorry, but your session has timed out.  Please log in again.');
                            break;

                        case 403:
                            message.push('Sorry, but you are not authorized to perform that action.');
                            break;

                        case 404:
                            message.push('Sorry, but the information you requested could not be found.');
                            break;

                        case 422:
                            message.push('Sorry, but your form submission was invalid.  Please double-check and try again.');
                            break;

                        // The default case is handled below by returning the generic error message.
                    }
                }
                catch (e)
                {
                    // Exceptions in parsing the error data likely mean the data were malformed.
                    // In this case, return the generic error message.
                }
            }
        }
        else if (error.request)
        {
            console.log('No response was received to the following API request:');
            console.log(error.request);
            message.push('Sorry, but the web application could not be reached.  Please try again later.');
        }
        else
        {
            console.log('An error occurred when attempting an API request:');
            console.log(error.message);
            // In this case, return the generic error message.
        }

        // If no messages were generated by the above rules, display the generic error message.
        UserInterface.displayErrorMessage((message.length === 0) ? null : message.join(' / '));
    },

    /**
     * Generate a URL to invoke API operations on a specific bookmark.
     *
     * The URL is relative to the base URL for the API.
     *
     * @param  {!number}  id  The unique ID of the bookmark.
     * @return {!string}      The URL.
     */
    generateUrlForBookmark: function(id) {
        return `bookmark/${id}`;
    }
};
