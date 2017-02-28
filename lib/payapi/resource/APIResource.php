<?php
namespace PaysbuyPayAPI;


define(__NAMESPACE__.'\PHP_LIB_VERSION', '0.1.0');

defined(__NAMESPACE__.'\API_URL') || define(__NAMESPACE__.'\API_URL', 'https://payapi.paysbuy.com/');
defined(__NAMESPACE__.'\VAULT_URL') || define(__NAMESPACE__.'\VAULT_URL', 'https://vault.paysbuy.com/');


require_once dirname(__FILE__).'/object/Object.php';


class ApiResource extends Object {

	// Methods
	const
		RQ_GET = 'GET',
		RQ_POST = 'POST',
		RQ_PATCH = 'PATCH',
		RQ_DELETE = 'DELETE'
	;

	// Timeout settings
	private
		$CONNECTTIMEOUT = 30,
		$TIMEOUT = 60
	;


	/**
	 * Get instance of given class if possible
	 *
	 * @param		string $cls
	 * @param		string $publicKey
	 * @param		string $secretKey
	 *
	 * @throws	Exception
	 *
	 * @return	APIResource / VaultResource
	 */
	protected static function getInstance($cls, $publicKey = null, $secretKey = null) {

		if (!class_exists($cls)) {
			throw new \Exception("Class '$cls' is undefined");
		} else {
			return new $cls($publicKey, $secretKey);
		}
		
	}


	/**
	 * Creates resource using passed attrib array
	 *
	 * @param		string $cls
	 * @param		string $url
	 * @param		array  $attrs
	 * @param		string $publicKey
	 * @param		string $secretKey
	 *
	 * @throws	Exception
	 *
	 * @return	APIResource / VaultResource
	 */
	protected static function _create($cls, $url, $attrs, $publicKey = null, $secretKey = null) {

		$resource = call_user_func(array($cls, 'getInstance'), $cls, $publicKey, $secretKey);
		$result = $resource->execute($url, self::RQ_POST, $resource->getResourceKey(), $attrs);
		$resource->refresh($result);

		return $resource;

	}


	/**
	 * Retrieves resource
	 *
	 * @param		string $cls
	 * @param		string $url
	 * @param		string $publicKey
	 * @param		string $secretKey
	 *
	 * @throws	Exception
	 *
	 * @return	APIResource / VaultResource
	 */
	protected static function _retrieve($cls, $url, $publicKey = null, $secretKey = null) {

		$resource = call_user_func(array($cls, 'getInstance'), $cls, $publicKey, $secretKey);
		$result = $resource->execute($url, self::RQ_GET, $resource->getResourceKey());
		$resource->refresh($result);

		return $resource;

	}


	/**
	 * Updates the resource with passed attrib array
	 *
	 * @param		string $url
	 * @param		array  $attrs
	 *
	 * @throws	Exception
	 */
	protected function _update($url, $attrs) {

		$result = $this->execute($url, self::RQ_PATCH, $this->getResourceKey(), $attrs);
		$this->refresh($result);

	}


	/**
	 * Destroy resource
	 *
	 * @param		string $url
	 *
	 * @throws	Exception
	 */
	protected function _destroy($url) {

		$result = $this->execute($url, self::RQ_DELETE, $this->getResourceKey());
		$this->refresh($result, true);

	}


	/**
	 * Reload resource with most recent data
	 *
	 * @param		string $url
	 *
	 * @throws	Exception
	 */
	protected function _reload($url) {

		$result = $this->execute($url, self::RQ_GET, $this->getResourceKey());
		$this->refresh($result);

	}


	/**
	 * Perform API request and return decoded JSON data in arr
	 *
	 * @param		string $url
	 * @param		string $requestMethod
	 * @param		string $key
	 * @param		array  $attrs
	 *
	 * @throws Exception
	 *
	 * @return array
	 */
	protected function execute($url, $requestMethod, $key, $attrs = null) {
		
		// Use Curl to run the request
		// TODO - May need to do something about testing here?
		$result = $this->_execCurl($url, $requestMethod, $key, $attrs);

		$arr = json_decode($result, true); // decode as an array

		// Check validity of response
		if (!count($arr) || !isset($arr['object'])) throw new \Exception('Bad response received from request');

		// Is response an error?
		if ($arr['object'] == 'error') throw PayAPIException::getInstance($arr);

		return $arr;

	}


	/**
	 * Run the request with Curl
	 *
	 * @param		string $url
	 * @param		string $requestMethod
	 * @param		string $key
	 * @param		array  $attrs
	 *
	 * @throws	Exception
	 *
	 * @return	string
	 */
	private function _execCurl($url, $requestMethod, $key, $attrs = null) {

		$handle = curl_init($url);
		$opts = $this->_getCurlOptions($requestMethod, $key, $attrs);

		curl_setopt_array($handle, $opts);

		// Attempt request
		$result = curl_exec($handle);

		// failure?
		if ($result === false) {
			// TODO - handle errors better - maybe different type of exception for each type of error? Error types determined using HTTP code?
			// See - https://docs.paysbuy.com/wave/#errors
			$error = curl_error($handle);
			curl_close($handle);
			throw new \Exception($error);
		}

		// All was ok
		curl_close($handle);

		return $result;

	}


	/**
	 * Build option array for Curl
	 *
	 * @param		string $requestMethod
	 * @param		array  $attrs
	 *
	 * @return	array
	 */
	private function _getCurlOptions($requestMethod, $key, $attrs) {

		// TODO - Will we need any user agent? What about API versioning?

		$opts = array(
			CURLOPT_HTTP_VERSION		=> CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST		=> $requestMethod,
			CURLOPT_RETURNTRANSFER	=> true,
			CURLOPT_HEADER					=> 0,
			CURLINFO_HEADER_OUT			=> true,
			CURLOPT_AUTOREFERER			=> true,
			CURLOPT_TIMEOUT					=> $this->TIMEOUT,
			CURLOPT_CONNECTTIMEOUT	=> $this->CONNECTTIMEOUT,
			CURLOPT_USERPWD					=> $key, // Authentication
			CURLOPT_FRESH_CONNECT		=> true,
			CURLOPT_FOLLOWLOCATION	=> true,
		);

		// Add attrs as POST params if we have any
		if (count($attrs)) $opts += array(CURLOPT_POSTFIELDS => http_build_query($attrs));

		return $opts;

	}


	/**
	 * Checks if resource is destroyed
	 *
	 * @return	boolean
	 */
	protected function isDestroyed() {
		return $this['deleted'];
	}


	/**
	 * Returns key for the resource (secret in this case)
	 *
	 * @return string
	 */
	protected function getResourceKey() {
		return $this->_secretKey;
	}


}
