<?php

/**
 * Author: samokspv <samokspv@yandex.ru>
 * Date: 06.12.2013
 * Time: 12:00:00
 */

/**
 * Class for key-value storage
 *
 */
class DBConfigure {

	/**
	 * Engine instance
	 *
	 * @var object
	 */
	protected static $_Engine = null;

	/**
	 * Engine name
	 *
	 * @var string
	 */
	protected static $_EngineName = 'ConfigureStore';
	
	/**
	 * Return engine instance
	 *
	 * @return object
	 */
	protected static function _getEngine() {
		if (!self::$_Engine) {
			self::$_Engine = ClassRegistry::init('DBConfigure.' . self::$_EngineName);
		}

		return self::$_Engine;
	}

	/**
	 * Get config data from storage/config file
	 *
	 * @param string $key Variable key
	 * @return mixed
	 */
	protected static function _getConfigByKey($key) {
		$dbConfig = self::_getEngine()->get($key);
		$fileConfig = Configure::read($key);
		if (!empty($fileConfig)) {
			$dbConfig = Hash::mergeDiff($fileConfig, (array)$dbConfig);
		}
		
		return $dbConfig;
	}

	/**
	 * Adds (or update) variable to storage
	 *
	 * @param string $key Variable key
	 * @param mixed $value Variable value
	 * @return boolean
	 */
	public static function write($key, $value) {
		if (empty($key) || empty($value)) {
			return false;
		}

		$key = explode('.', $key);
		$config = self::_getConfigByKey($key[0]);
		$cntKey = count($key);
		if (is_null($config) && $cntKey > 1) {
			$config = array();
		}
		if (!is_null($config)) {
			if ($cntKey > 1) {
				$value = Hash::insert((array)$config, implode('.', array_slice($key, 1)), $value);
			}
		}
		self::_getEngine()->add($key[0], $value);

		return true;
	}

	/**
	 * Return variable value from storage/config file.
	 * If variable not exists return default value
	 *
	 * @param string $key Variable key
	 * @param mixed $defaultValue Default value if variable not found
	 * @return mixed Variable value
	 */
	public static function read($key = null, $defaultValue = null) {
		if ($key === null) {
			return Hash::combine(
				self::_getEngine()->get(), 
				'{n}.' . self::$_EngineName . '.key', 
				'{n}.' . self::$_EngineName . '.value'
			);
		}
		
		$key = explode('.', $key);
		$config = self::_getConfigByKey($key[0]);
		if (!empty($config) && count($key) > 1) {
			$config = Hash::get($config, implode('.', array_slice($key, 1)));
		}
	
		return !empty($config) ? $config : $defaultValue;
	}
	
}