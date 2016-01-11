<?php
class DBConfigureSchema extends CakeSchema {

        public function before($event = array()) {
                return true;
        }

        public function after($event = array()) {
        }

        public $configure_stores = array(
                'key' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                'value' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                'indexes' => array(
                        'PRIMARY' => array('column' => 'key', 'unique' => 1),
                        'key_UNIQUE' => array('column' => 'key', 'unique' => 1)
                ),
                'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
        );

}

