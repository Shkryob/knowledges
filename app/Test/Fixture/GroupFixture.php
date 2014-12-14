<?php

/**
 * GroupFixture
 *
 */
class GroupFixture extends CakeTestFixture {

    /**
     * Fields
     *
     * @var array
     */
    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => '4', 'key' => 'primary'),
        'name' => array('type' => 'string', 'null' => false, 'default' => null),
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
            'name' => 'Lorem ipsum dolor sit amet'
        ),
    );

}
