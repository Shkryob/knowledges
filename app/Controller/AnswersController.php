<?php

App::uses('AppController', 'Controller');

/**
 * Answers Controller
 *
 * @property Answer $Answer
 * @property PaginatorComponent $Paginator
 */
class AnswersController extends AppController {

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
        $this->Answer->recursive = 0;
        $this->jsonResponse($this->Paginator->paginate());
    }
    
    /**
     * view_my method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function viewMy($id = null) {
        $user = $this->Session->read('user');
        
        $conditions = array('Question.lesson_id' => $id,
                            'Answer.user_id' => $user['id']);
        $options = array('conditions' => $conditions);
        $answers = $this->Answer->find('all', $options);
        $answersFiltered = array();
        foreach ($answers as $answer) {
            $answersFiltered[$answer['Answer']['question_id']] = $answer['Answer'];
        }
        $this->jsonResponse((object) $answersFiltered);
    }
    
    /**
     * view_all method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function viewAll($id = null) {
        $conditions = array('Question.lesson_id' => $id);
        $options = array('conditions' => $conditions);
        $answers = $this->Answer->find('all', $options);
        $answersByUser = array();
        foreach ($answers as $answer) {
            $userId = $answer['Answer']['user_id'];
            $questionId = $answer['Answer']['question_id'];
            if (!isset($answersByUser[$userId])) {
                $answersByUser[$userId]['name'] = $answer['User']['name'];
                $answersByUser[$userId]['answers'] = array();
            }
            $answersByUser[$userId]['answers'][$questionId] = $answer['Answer'];
        }
        $this->jsonResponse((object) $answersByUser);
    }
    
    /**
     * save_my method
     *
     * @throws NotFoundException
     * @return void
     */
    public function saveMy() {
        $user = $this->Session->read('user');
        $message = '';
        if ($this->request->is(array('post', 'put'))) {
            foreach ($this->request->data as &$answer) {
                $answer['user_id'] = $user['id'];
            }
            if ($this->Answer->saveAll($this->request->data)) {
                $message = __('The answer has been saved.');
            } else {
                $message = __('The answer could not be saved. Please, try again.');
            }
        }
        $data = array('message' => $message);
        $this->jsonResponse($data);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Answer->exists($id)) {
            throw new NotFoundException(__('Invalid answer'));
        }
        $options = array('conditions' => array('Answer.' . $this->Answer->primaryKey => $id));
        $this->set('answer', $this->Answer->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Answer->create();
            if ($this->Answer->save($this->request->data)) {
                $this->Session->setFlash(__('The answer has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The answer could not be saved. Please, try again.'));
            }
        }
        $users = $this->Answer->User->find('list');
        $questions = $this->Answer->Question->find('list');
        $this->set(compact('users', 'questions'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $message = '';
        if (!$this->Answer->exists($id)) {
            throw new NotFoundException(__('Invalid answer'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Answer->save($this->request->data)) {
                $message = __('The answer has been saved.');
            } else {
                $message = __('The answer could not be saved. Please, try again.');
            }
        }
        $data = array('message' => $message);
        $this->jsonResponse($data);
    }
    
    /**
     * edit_all method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function editAll() {
        $message = '';
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Answer->saveAll($this->request->data)) {
                $message = __('Answers has been saved.');
            } else {
                $message = __('Answers could not be saved. Please, try again.');
            }
        }
        $data = array('message' => $message);
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
        $this->Answer->id = $id;
        if (!$this->Answer->exists()) {
            throw new NotFoundException(__('Invalid answer'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Answer->delete()) {
            $this->Session->setFlash(__('The answer has been deleted.'));
        } else {
            $this->Session->setFlash(__('The answer could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
