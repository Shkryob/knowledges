<?php 
class AppSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $answers = array(
		'text' => array('type' => 'string', 'null' => false, 'default' => null),
		'created' => array('type' => 'date', 'null' => false, 'default' => null),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => '4'),
		'question_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => '4'),
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'indexes' => array(
			
		),
		'tableParameters' => array()
	);

	public $groups = array(
		'name' => array('type' => 'string', 'null' => false, 'default' => null),
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'indexes' => array(
			
		),
		'tableParameters' => array()
	);

	public $lessons = array(
		'name' => array('type' => 'string', 'null' => false, 'default' => null),
		'start' => array('type' => 'date', 'null' => true, 'default' => null),
		'end' => array('type' => 'date', 'null' => true, 'default' => null),
		'group_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => '4'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => '4'),
		'order' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => '4'),
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'indexes' => array(
			
		),
		'tableParameters' => array()
	);

	public $questions = array(
		'question' => array('type' => 'string', 'null' => false, 'default' => null),
		'order' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => '4'),
		'lesson_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => '4'),
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'indexes' => array(
			
		),
		'tableParameters' => array()
	);

	public $roles = array(
		'name' => array('type' => 'string', 'null' => false, 'default' => null),
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'indexes' => array(
			
		),
		'tableParameters' => array()
	);

	public $users = array(
		'email' => array('type' => 'string', 'null' => false, 'default' => null),
		'name' => array('type' => 'string', 'null' => false, 'default' => null),
		'role_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => '4'),
		'password' => array('type' => 'string', 'null' => true, 'default' => null),
		'group_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => '4'),
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'indexes' => array(
			
		),
		'tableParameters' => array()
	);

}
