<?php
namespace PaysbuyPayAPI;

require_once dirname(__FILE__).'/resource/APIResource.php';

class Payment extends APIResource {

	const ENDPOINT = 'payment';


	/**
	 * Retrieve payment
	 *
	 * @param		string $id
	 * @param		string $publicKey
	 * @param		string $secretKey
	 *
	 * @return	Payment
	 */
	public static function retrieve($id, $publicKey = null, $secretKey = null) {

		return parent::_retrieve(get_class(), self::getUrl($id), $publicKey, $secretKey);

	}


	/**
	 * Create new payment
	 *
	 * @param		array	 $attrs
	 * @param		string $publicKey
	 * @param		string $secretKey
	 *
	 * @return	Payment
	 */
	public static function create($attrs, $publicKey = null, $secretKey = null) {

		return parent::_create(get_class(), self::getUrl(), $attrs, $publicKey, $secretKey);

	}


	/**
	 * Reload this payment
	 */
	public function reload() {

		parent::_reload(self::getUrl($this['id']));

	}


	/**
	 * Get the URL for this payment
	 *
	 * @param		string $id
	 *
	 * @return	string
	 */
	private static function getUrl($id = '') {

		return API_URL.self::ENDPOINT.'/'.$id;

	}

}
