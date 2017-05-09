<?php
namespace PaysbuyPayAPI;

require_once dirname(__FILE__).'/resource/VaultResource.php';

class Token extends VaultResource {

	const ENDPOINT = '';


	/**
	 * Retrieve token
	 *
	 * @param		string $id
	 * @param		string $publicKey
	 * @param		string $secretKey
	 *
	 * @return	Token
	 */
	public static function retrieve($id, $publicKey = null, $secretKey = null) {

		return parent::_retrieve(get_class(), self::getUrl($id), $publicKey, $secretKey);

	}


	/**
	 * Create new token
	 *
	 * @param		array	 $attrs
	 * @param		string $publicKey
	 * @param		string $secretKey
	 *
	 * @return	Token
	 */
	public static function create($attrs, $publicKey = null, $secretKey = null) {

		/* EXTREMELY IMPORTANT **************************************************************************
		*                                                                                               *
		*  You probably shouldn't be using this on a live server unless your company/organisation       *
		*  is PCI compliant! If you need to use our tokenisation service on your site, you should       *
		*  almost certainly be using our JS library:                                                    *
		*                                                                                               *
		*    https://github.com/paysbuy/paysbuy.js                                                      *
		*                                                                                               *
		*  Using this, all sensitive data will be sent from the client directly to PAYSBUY's secure,    *
		*  PCI compliant servers for tokenisation - removing any potential risk of you handling         *
		*  sensitive customer payment information (credit card details etc.) on your servers            *
		*                                                                                               *
		************************************************************************************************/

		return parent::_create(get_class(), self::getUrl(), $attrs, $publicKey, $secretKey);

	}


	/**
	 * Delete a token
	 *
	 * @param		string $id
	 * @param		string $publicKey
	 * @param		string $secretKey
	 *
	 * @return	Token
	 */
	public static function destroy($id, $publicKey = null, $secretKey = null) {

		parent::_destroy(self::getUrl($id), $publicKey, $secretKey);

	}


	/**
	 * Reload this token
	 */
	public function reload() {

		parent::_reload(self::getUrl($this['id']));

	}


	/**
	 * Get the URL for this token
	 *
	 * @param		string $id
	 *
	 * @return	string
	 */
	private static function getUrl($id = '') {

		return VAULT_URL.$id;

	}

}
