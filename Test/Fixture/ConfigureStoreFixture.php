<?php
/**
 * Author: samokspv <samokspv@yandex.ru>
 * Date: 13.02.2014
 * Time: 1:52:58 PM
 * Format: http://book.cakephp.org/2.0/en/development/testing.html#fixtures
 */

/**
 * ConfigureStoreFixture
 *
 */
class ConfigureStoreFixture extends CakeTestFixture {

	/**
	 * {@inheritdoc}
	 *
	 * @var string
	 */
	public $useDbConfig = 'test';

	/**
	 * {@inheritdoc}
	 *
	 * @var string
	 */
	public $table = 'configure_stores';

	/**
	 * {@inheritdoc}
	 *
	 * @var array
	 */
	public $fields = array(
		'key' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'value' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'key', 'unique' => 1),
			'key_UNIQUE' => array('column' => 'key', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	/**
	 * {@inheritdoc}
	 *
	 * @var array
	 */
	public $records = array();
}
