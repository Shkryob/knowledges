<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

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
        $this->User->recursive = 0;
        $this->jsonResponse($this->Paginator->paginate());
    }
    
    /**
     * register method
     * 
     * @return void
     */
    public function register() {
        $message = '';
        $success = false;
        $data = array();
        if ($this->request->is('post')) {
            $this->User->create();
            $user = $this->request->data;
            $user['role_id'] = 1; //Pupil role
            $user['password'] = sha1($user['password']);
            if ($this->User->save($user)) {
                $message = __('Registration completed.');
                $success = true;
            } else {
                unset($user['password']);
                $this->Session->write('user', $user);
                $data['user'] = $user;
                $message = __('The user could not be saved. Please, try again.');
            }
        }
        
        $data['message'] = $message;
        $data['success'] = $success;
        $this->jsonResponse($data);
    }
    
    /**
     * login method
     * 
     * @return void
     */
    public function login() {
        $success = false;
        $message = '';
        if ($this->request->is('post')) {
            $options = array('conditions' => array(
                'User.email' => $this->request->data['email'],
                'User.password' => sha1($this->request->data['password'])
            ));
            $user = $this->User->find('first', $options);
            if ($user) {
                unset($user['password']);
                $this->Session->write('user', $user);
                $data['user'] = $user;
                $success = true;
                $message = __('You are succesfully logged in.');
            } else {
                $message = __('Email and/or password are incorrect.');
            }
        }
        $data['message'] = $message;
        $data['success'] = $success;
        $this->jsonResponse($data);
    }
    
    /**
     * current method
     *
     * @return void
     */
    public function current() {
        $user = $this->Session->read('user');
        if (!$user) {
            $user = new stdClass();
        }
        $this->jsonResponse($user);
    }
    
    /**
     * logout method
     *
     * @return void
     */
    public function logout() {
        $this->Session->destroy();
        $data = array('message' => 'You have been logged out',
            'success' => true);
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
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->User->Role->find('list');
        $groups = $this->User->Group->find('list');
        $this->set(compact('roles', 'groups'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
        $roles = $this->User->Role->find('list');
        $groups = $this->User->Group->find('list');
        $this->set(compact('roles', 'groups'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash(__('The user has been deleted.'));
        } else {
            $this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
