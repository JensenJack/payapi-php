<?php
namespace PaysbuyPayAPI;

class Object implements \ArrayAccess, \Countable, \Iterator {


	protected 

		// Object attribs
		$_values = array(),

		// Keys
		$_publicKey,
		$_secretKey

	;


	/**
	 * Setup object, default to constants if keys not given
	 *
	 * @param string $publicKey
	 * @param string $secretKey
	 */
	protected function __construct($publicKey = null, $secretKey = null) {

		$this->_publicKey = is_null($publicKey) ? PUBLIC_KEY : $publicKey;
		$this->_secretKey = is_null($secretKey) ? SECRET_KEY : $secretKey;

	}


	/**
	 * Reload object
	 *
	 * @param array   $values
	 * @param boolean $clear
	 */
	public function refresh($values, $clear = false) {
		
		if ($clear) $this->_values = array();
		$this->_values = array_merge($this->_values, $values);

	}


	/**
	 * Get this object as a JSON string
	 *
	 * @return	APIResource / VaultResource
	 */
	public function toJSON() {

		return json_encode($this->_values);
		
	}


	// ArrayAccess methods
	public function offsetUnset($key) { unset($this->_values[$key]); }

	public function offsetExists($key) { return isset($this->_values[$key]); }

	public function offsetSet($key, $val) { $this->_values[$key] = $val; }

	public function offsetGet($key) { return isset($this->_values[$key]) ? $this->_values[$key] : null; }


	// Iterator methods
	public function current() { return current($this->_values); }

	public function next() { return next($this->_values); }

	public function rewind() { reset($this->_values); }

	public function key() { return key($this->_values); }

	public function valid() { return ($this->current() !== false); }


	// Countable methods
	public function count() { return count($this->_values); }


}