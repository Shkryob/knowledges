<?php

/**
 * QuestionFixture
 *
 */
class QuestionFixture extends CakeTestFixture {

    /**
     * Fields
     *
     * @var array
     */
    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => '4', 'key' => 'primary'),
        'question' => array('type' => 'string', 'null' => false, 'default' => null),
        'order' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => '4'),
        'lesson_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => '4'),
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
            'question' => 'Lorem ipsum dolor sit amet',
            'order' => 1,
            'lesson_id' => 1
        ),
    );

}
