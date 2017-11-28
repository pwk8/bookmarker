/**
 * @fileoverview JavaScript class for Bookmark models.
 *
 * @package PWK8\Bookmarker
 * @author  Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */


Model = require('./Model');


/**
 * Class for Bookmark models.
 */
class Bookmark extends Model {

    /**
     * Construct a new Bookmark object.
     *
     * @param  {Object=}  data  Initial data with which to populate the object.
     *                          Keys of this object should match names of properties of this object.
     *                          It is permissible to specify initial data for only a subset of the properties.
     * @return {void}
     */
    constructor (data = {}) {
        super(data);

        this._universalIdPrefix = 'bookmark';

        this._initializeProperty('id', data, null);
        this._initializeProperty('owner_user_id', data, null);
        this._initializeProperty('uri', data, null);
        this._initializeProperty('iconuri', data, null);
        this._initializeProperty('title', data, null);
        this._initializeProperty('tags', data, null);
        this._initializeProperty('keyword', data, null);
        this._initializeProperty('description', data, null);
        this._initializeProperty('created_at', data, null);
        this._initializeProperty('updated_at', data, null);
    }
}


module.exports = Bookmark;
