<?

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
	 * Adds (or update) variable to storage
	 *
	 * @param string $key Variable key
	 * @param mixed $value Variable value
	 * @return boolean
	 */
	public static function write($key, $value) {
		if (!empty($key) && !empty($value)) {
			self::_getEngine()->add($key, $value);
			return true;
		}
		return false;
	}

	/**
	 * Return variable value from storage.
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
		$config = self::_getEngine()->get($key[0]);
		if (!empty($config) && count($key) > 1) {
			array_shift($key);
			$config = Hash::get($config, implode('.', $key));
		}
		if (empty($config)) {
			$config = Configure::read($key[0]);
		}
		return !empty($config) ? $config : $defaultValue;
	}
}
