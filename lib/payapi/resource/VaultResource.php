<?php
namespace PaysbuyPayAPI;

require_once dirname(__FILE__).'/APIResource.php';


class VaultResource extends APIResource {


	/**
	 * Returns key for the resource (public in this case)
	 *
	 * @return string
	 */
	protected function getResourceKey() {
		return $this->_publicKey;
	}


}
