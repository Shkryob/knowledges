<?php

App::uses('AppModel', 'Model');

/**
 * Question Model
 *
 * @property Lesson $Lesson
 * @property Answer $Answer
 */
class Question extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'question';


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Lesson' => array(
            'className' => 'Lesson',
            'foreignKey' => 'lesson_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Answer' => array(
            'className' => 'Answer',
            'foreignKey' => 'question_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

}
