<?php

App::uses('AppController', 'Controller');

/**
 * Lessons Controller
 *
 * @property Lesson $Lesson
 * @property Question $Question
 * @property PaginatorComponent $Paginator
 */
class LessonsController extends AppController {
    /**
     * List of used models
     *
     * @var type 
     */
    public $uses = array(
        'Lesson',
        'Question'
    );

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Lesson->recursive = 0;
        $this->Paginator->settings = array(
            'order' => array('Lesson.end' => 'asc'),
        );
        $this->jsonResponse($this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Lesson->exists($id)) {
            throw new NotFoundException(__('Invalid lesson'));
        }
        $options = array('conditions' => array('Lesson.' . $this->Lesson->primaryKey => $id));
        $lesson = $this->Lesson->find('first', $options);
        $lesson['Lesson']['Question'] = $lesson['Question'];
        $lesson['Lesson']['Image'] = $lesson['Image'];
        $this->jsonResponse($lesson['Lesson']);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $data = array();
        $message = '';
        if ($this->request->is('post')) {
            $this->Lesson->create();
            $data = $this->request->data;
            unset($data['Image']);
            $data['start'] = date('Y-m-d', strtotime($data['start']));
            $data['end'] = date('Y-m-d', strtotime($data['end']));
            if ($this->Lesson->saveAssociated($this->request->data)) {
                $message = __('The lesson has been saved.');
                $data['lesson'] = $this->Lesson;
            } else {
                $message = __('The lesson could not be saved. Please, try again.');
            }
        }
        $data['message'] = $message;
        $this->jsonResponse($data);
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $data = array();
        $message = '';
        if (!$this->Lesson->exists($id)) {
            throw new NotFoundException(__('Invalid lesson'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $options = array('conditions' => array('Lesson.' . $this->Lesson->primaryKey => $id));
            $oldQuestions = $this->Lesson->find('first', $options)['Question'];
            unset($this->request->data['Image']);
            if ($this->Lesson->saveAssociated($this->request->data)) {
                $newQuestions = $this->request->data['Question'];
                $this->deleteUnusedQuestions($oldQuestions, $newQuestions);
                $message = __('The lesson has been saved.');
            } else {
                $message = __('The lesson could not be saved. Please, try again.');
            }
        }
        $data['message'] = $message;
        $this->jsonResponse($data);
    }
    
    /**
     * Delete questions that not associated with lesson anymore
     * 
     * @param array $oldQuestions
     * @param array $newQuestions
     */
    public function deleteUnusedQuestions($oldQuestions, $newQuestions) {
        $unusedQuestions = array();
        foreach ($oldQuestions as $old) {
            $unused = true;
            foreach ($newQuestions as $new) {
                if ($new['id'] === $old['id']) {
                    $unused = false;
                    break;
                }
            }
            if ($unused) {
                $unusedQuestions[] = $old['id'];
            }
        }
        if ($unusedQuestions) {
            $conditions = array('Question.' . $this->Question->primaryKey => $unusedQuestions);
            $this->Question->deleteAll($conditions);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Lesson->id = $id;
        $success = false;
        $message = '';
        if (!$this->Lesson->exists()) {
            throw new NotFoundException(__('Invalid lesson'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Lesson->delete()) {
            $message = __('The lesson has been deleted.');
        } else {
            $message = __('The lesson could not be deleted. Please, try again.');
        }
        $data = array('message' => $message,
            'success' => $success);
        $this->jsonResponse($data);
    }

}
