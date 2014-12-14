<?php

/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {

    /**
     * Fields
     *
     * @var array
     */
    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => '4', 'key' => 'primary'),
        'email' => array('type' => 'string', 'null' => false, 'default' => null),
        'name' => array('type' => 'string', 'null' => false, 'default' => null),
        'role_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => '4'),
        'password' => array('type' => 'string', 'null' => true, 'default' => null),
        'group_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => '4'),
        'indexes' => array(
        ),
        'tableParameters' => array()
    );

    /**
     * Records
     *
     * @var array
     */
    public $records = array(
        array(
            'id' => 1,
            'email' => 'Lorem ipsum dolor sit amet',
            'name' => 'Lorem ipsum dolor sit amet',
            'role_id' => 1,
            'password' => 'Lorem ipsum dolor sit amet',
            'group_id' => 1
        ),
    );

}
