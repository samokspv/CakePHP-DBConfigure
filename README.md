CakePHP DBConfigure Plugin
==============================
[![Build Status](https://travis-ci.org/samokspv/CakePHP-DBConfigure.png)](https://travis-ci.org/samokspv/CakePHP-DBConfigure) [![Coverage Status](https://coveralls.io/repos/samokspv/CakePHP-DBConfigure/badge.png?branch=master)](https://coveralls.io/r/samokspv/CakePHP-DBConfigure?branch=master) [![Latest Stable Version](https://poser.pugx.org/samokspv/cakephp-db-configure/v/stable.svg)](https://packagist.org/packages/samokspv/cakephp-db-configure) [![Total Downloads](https://poser.pugx.org/samokspv/cakephp-db-configure/downloads.svg)](https://packagist.org/packages/samokspv/cakephp-db-configure) [![Latest Unstable Version](https://poser.pugx.org/samokspv/cakephp-db-configure/v/unstable.svg)](https://packagist.org/packages/samokspv/cakephp-db-configure) [![License](https://poser.pugx.org/samokspv/cakephp-db-configure/license.svg)](https://packagist.org/packages/samokspv/cakephp-db-configure)

DBConfigure plugin for CakePHP 2.2+

Use it if you want to save and read serialized data into/from DB (DBConfigure::read = (Configure::write + DBConfigure::write)).

## Installation

	cd my_cake_app/app
	git clone git://github.com/samokspv/cakephp-DBConfigure.git Plugin/DBConfigure

or if you use git add as submodule:

	cd my_cake_app
	git submodule add "git://github.com/samokspv/cakephp-DBConfigure.git" "app/Plugin/DBConfigure"

then add plugin loading in Config/bootstrap.php

	CakePlugin::load('DBConfigure');

## Usage

In any place of your code:
	
	App::uses('DBConfigure', 'DBConfigure.Utility');

	For example:
	// save to DB
	DBConfigure::write('TestSetting', array(
		'key_1' => array(
			'key_1_1' => 'value_1_1',
			'key_1_2' => array(
				'key_1_2_1' => 'value_1_2_1'
			)
		)
	));
	// read from DB
	DBConfigure::read('TestSetting'); 
		/*return: array(
			'key_1' => array(
				'key_1_1' => 'value_1_1',
				'key_1_2' => array(
					'key_1_2_1' => 'value_1_2_1'
				)
			)
		)*/
	DBConfigure::read('TestSetting.key_1');
		/*return: array(
			'key_1_1' => 'value_1_1',
			'key_1_2' => array(
				'key_1_2_1' => 'value_1_2_1'
			)
		)*/
	DBConfigure::read('TestSetting.key_1.key_1_2');
		/*return: array(
			'key_1_2_1' => 'value_1_2_1'
		)*/
	DBConfigure::read('TestSetting.key_1_3', 'defaultValue_1_3'); 
		/*return: defaultValue_1_3*/

	// save to DB
	DBConfigure::write('TestSetting.key_1.key_1_2', 'value_1_2_1_update');
	// read from DB
	DBConfigure::read('TestSetting.key_1.key_1_2');
		/*return: array(
			'key_1_2_1' => 'value_1_2_1_update'
		)*/

	// save to session
	Configure::write('TestSetting.key_1', 'value_1');
	Configure::write('TestSetting.key_2', 'value_2');
	// save to DB
	DBConfigure::write('TestSetting.key_2', 'value_2_update');
	DBConfigure::write('TestSetting.key_3', 'value_3');
	// read from DB
	DBConfigure::read('TestSetting');
		/*return: array(
			'key_1' => 'value_1',
			'key_2' => 'value_2_update',
			'key_3' => 'value_3'
		)*/