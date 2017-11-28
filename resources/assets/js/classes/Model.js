/**
 * @fileoverview Abstract JavaScript class for data models.
 *
 * @package PWK8\Bookmarker
 * @author  Philip W. Knerr <pwk8@philknerr.com>
 * @license MIT
 */


/**
 * Abstract class for data models.
 */
class Model {

    /**
     * Construct a new Model object.
     *
     * The `id` property is initialized to null.
     *
     * The protected `_universalIdPrefix` property is initialized to `model`.
     *
     * @return {void}
     */
    constructor () {
        if (this.id === undefined)
        {
            this.id = null;
        }
        if ( ! this._universalIdPrefix)
        {
            this._universalIdPrefix = 'model';
        }
    }

    /**
     * Gets the universal ID for the object.
     *
     * @return {!string}
     */
    get universal_id () {
        return ((this.id === null) ? this._universalIdPrefix : `${this._universalIdPrefix}-${this.id}`);
    }

    /**
     * Generate a slice of the model which includes only specific properties.
     *
     * @param  {!Array.<!string>}  propertyNames  Names of properties to include in the slice.
     * @return {!Object}
     */
    slice (propertyNames) {
        let s = {};

        for (let i = 0; i < propertyNames.length; i++)
        {
            let propName = propertyNames[i];
            s[propName] = this[propName];
        }

        return s;
    }

    /**
     * Initialize a property.
     *
     * The property in the data object which matches the property name is transcribed into this object.
     * If this property is missing from the data object or has a value of `undefined` therein,
     * the property in this object is set to the default value.
     *
     * @protected
     * @param  {!string}  name          The property name.
     * @param  {!Object}  data          The data object.
     * @param  {?*=}      defaultValue  The default value for the property.
     * @return {void}
     */
    _initializeProperty (name, data, defaultValue = null) {
        this[name] = (data[name] === undefined ? defaultValue : data[name]);
    }
}


module.exports = Model;
