<?php

/**
 * LessonFixture
 *
 */
class LessonFixture extends CakeTestFixture {

    /**
     * Fields
     *
     * @var array
     */
    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => '4', 'key' => 'primary'),
        'name' => array('type' => 'string', 'null' => false, 'default' => null),
        'start' => array('type' => 'date', 'null' => true, 'default' => null),
        'end' => array('type' => 'date', 'null' => true, 'default' => null),
        'group_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => '4'),
        'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => '4'),
        'order' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => '4'),
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
            'name' => 'Lorem ipsum dolor sit amet',
            'start' => '2014-12-14',
            'end' => '2014-12-14',
            'group_id' => 1,
            'user_id' => 1,
            'order' => 1
        ),
    );

}
