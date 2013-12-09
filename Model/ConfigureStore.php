<?

/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 06.12.2013
 * Time: 12:00:00
 * Format: http://book.cakephp.org/2.0/en/models.html
 */

/**
 * Model for key-value storage
 *
 * @package SnatzAdmin
 * @subpackage Misc
 */
class ConfigureStore extends AppModel {

	/**
	 * Model name
	 *
	 * @var string
	 */
	public $name = 'ConfigureStore';

	/**
	 * Primary key
	 *
	 * @var string
	 */
	public $primaryKey = 'key';

	/**
	 * Behaviours
	 *
	 * @var array
	 */
	public $actsAs = array(
		'Serializable.Serializable' => array(
			'fields' => array('value')
		)
	);

	/**
	 * Adds (or update) variable to storage
	 *
	 * @param string $key Variable name
	 * @param mixed $value Variable value
	 */
	public function add($key, $value) {
		$this->id = $key;
		$this->save(compact('key', 'value'));
	}

	/**
	 * Return variable value from storage.
	 * If variable not exists return default value
	 *
	 * @param string $key Variable name
	 * @param mixed $default_value Default value if variable not found
	 * @return mixed Variable value
	 */
	public function get($key = null, $default_value = null) {
		$conditions = compact('key');
		if ($key === null) {
			return $this->find('all', $conditions);
		} else {
			$value = $this->field('value', $conditions);
			return $this->find('count', array('conditions' => $conditions)) ? $value : $default_value;
		}
	}

	/**
	 * Increase numeric variable value.
	 * If variable not found creates it with initial value - zero
	 *
	 * @param string $key Variable name
	 * @param numeric $value Increase value
	 *
	 * @return int Increased value
	 */
	public function increaseBy($key, $value) {
		$value_old = $this->get($key, 0);
		if (is_numeric($value) && is_numeric($value_old)) {
			$this->add($key, $value + $value_old);
			return $value + $value_old;
		}
	}

}