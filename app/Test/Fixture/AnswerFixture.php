<?php

/**
 * AnswerFixture
 *
 */
class AnswerFixture extends CakeTestFixture {

    /**
     * Fields
     *
     * @var array
     */
    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => '4', 'key' => 'primary'),
        'text' => array('type' => 'string', 'null' => false, 'default' => null),
        'created' => array('type' => 'date', 'null' => false, 'default' => null),
        'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => '4'),
        'question_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => '4'),
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
            'text' => 'Lorem ipsum dolor sit amet',
            'created' => '2014-12-14',
            'user_id' => 1,
            'question_id' => 1
        ),
    );

}
