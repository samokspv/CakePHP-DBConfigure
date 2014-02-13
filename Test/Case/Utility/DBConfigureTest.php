<?php

/**
 * Author: samokspv <samokspv@yandex.ru>
 * Date: 13.02.2014
 * Time: 1:52:58 PM
 * Format: http://book.cakephp.org/2.0/en/development/testing.html
 */
App::uses('DBConfigure', 'DBConfigure.Utility');

class DBConfigureTest extends CakeTestCase {

	/**
	 * {@inheritdoc}
	 *
	 * @var array
	 */
	public $fixtures = array(
		'plugin.DBConfigure.ConfigureStore'
	);

	public function setUp() {
		parent::setUp();
	}

	/**
	 * Test save to DB
	 *
	 * @param int $id Term id
	 * @param string $key
	 * @param string $value
	 * @param string $result
	 *
	 * @dataProvider writeVariations
	 */
	public function testWriteAndRead($key, $value, $result) {
		// save to DB
		DBConfigure::write($key, $value);
		// read from DB
		if ($result) {
			$this->assertSame(DBConfigure::read($key), $value);
		} else {
			$this->assertNull(DBConfigure::read($key));
		}
	}

	/**
	 * data provider for testWrite
	 *
	 * @return array
	 */
	public static function writeVariations() {
		return array(
			array('TestSetting', false, false),
			array('TestSetting', array(), false),
			array('TestSetting', 'value', true),
			array('TestSetting', 1, true),
			array('TestSetting.key_1', 'value_1', true),
			array('TestSetting.key_1.key_1_1', 'value_1_1', true),
			array('TestSetting.key_1.key_1_1.key_1_1_1', 'value_1_1_1', true),
			array(
				'TestSetting', 
				array(
					'key_1' => array(
						'key_1_1' => 'value_1_1',
						'key_1_2' => array(
							'key_1_2_1' => 'value_1_2_1'
						)
					)
				),
				true
			),
			array(
				'TestSetting.key_1', 
				array(
					'key_1_1' => 'value_1_1',
					'key_1_2' => 'value_1_2'
				),
				true
			),
			array(
				'TestSetting.key_1', 
				array(
					'key_1_1' => 'value_1_1'
				),
				true
			),
			array(
				'TestSetting.key_1.key_1_3', 
				'value_1_3',
				true
			),
			array(
				'TestSetting.key_1', 
				array(
					'key_1_1' => 'value_1_1',
					'key_1_2' => array(
						'key_1_2_1' => 'value_1_2_1'
					)
				),
				true
			)
		);
	}
}