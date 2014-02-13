<?php

/**
 * Author: samokspv <samokspv@yandex.ru>
 * Date: 13.02.2014
 * Time: 1:52:58 PM
 * Format: http://book.cakephp.org/2.0/en/development/testing.html
 */

class AllDBConfigureTest extends PHPUnit_Framework_TestSuite {

	/**
	 * Suite define the tests for this suite
	 *
	 * @return void
	 */
	public static function suite() {
		$suite = new CakeTestSuite('All DBConfigure Tests');

		$path = App::pluginPath('DBConfigure') . 'Test' . DS . 'Case' . DS;
		$suite->addTestDirectoryRecursive($path);
		return $suite;
	}

}