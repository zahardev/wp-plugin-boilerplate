/**
 * UrlHelper
 *
 * @package WP_Plugin_Boilerplate
 * */

/**
 * Class UrlHelper
 * */
class UrlHelper {

	getUrlParameter( url, param ) {
		let urlParts = url.split( "?" ),
			args     = urlParts[ 1 ],
			argsArray,
			paramArray;
		if ( ! args ) {
			return '';
		}

		argsArray       = args.split( "&" );
		let arrayLength = argsArray.length;
		for ( let i = 0; i < arrayLength; i++ ) {
			paramArray = argsArray[ i ].split( '=' );
			if ( paramArray[ 0 ] === param ) {
				return paramArray[ 1 ]
			}
		}

		return '';
	}

	updateURLParameter( url, param, paramVal ) {
		let urlParts = url.split( "?" ),
			baseURL  = urlParts[ 0 ],
			args     = urlParts[ 1 ],
			newArgs  = this.filterUrlArgsParameter( args, param ),
			temp     = newArgs ? '&' : "";

		let updatedParam = paramVal ? temp + "" + param + "=" + paramVal : '';
		return newArgs || updatedParam ? baseURL + "?" + newArgs + updatedParam : baseURL;
	}

	removeUrlParameter( url, param ) {
		let urlParts = url.split( "?" ),
			baseURL  = urlParts[ 0 ],
			args     = urlParts[ 1 ],
			newArgs  = this.filterUrlArgsParameter( args, param );

		return newArgs ? baseURL + "?" + newArgs : baseURL;
	}

	filterUrlArgsParameter( args, param ) {
		if ( ! args ) {
			return '';
		}

		let argsArray   = args.split( "&" ),
			newArgs     = "",
			temp        = "",
			arrayLength = argsArray.length;
		for ( let i = 0; i < arrayLength; i++ ) {
			if ( argsArray[ i ].split( '=' )[ 0 ] !== param ) {
				newArgs += temp + argsArray[ i ];
				temp     = "&";
			}
		}

		return newArgs;
	}
}

export default UrlHelper;
