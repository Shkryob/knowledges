<?php

App::uses('AppController', 'Controller');

/**
 * Lessons Controller
 *
 * @property Lesson $Lesson
 * @property PaginatorComponent $Paginator
 */
class LessonsController extends AppController {

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
            if ($this->Lesson->saveAssociated($this->request->data)) {
                $message = __('The lesson has been saved.');
            } else {
                $message = __('The lesson could not be saved. Please, try again.');
            }
        }
        $data['message'] = $message;
        $this->jsonResponse($data);
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
