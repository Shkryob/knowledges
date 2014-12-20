<?php

App::uses('AppController', 'Controller');

/**
 * Roles Controller
 *
 * @property Role $Role
 * @property PaginatorComponent $Paginator
 */
class RolesController extends AppController {

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
        $this->Role->recursive = 0;
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
        if (!$this->Role->exists($id)) {
            throw new NotFoundException(__('Invalid role'));
        }
        $options = array('conditions' => array('Role.' . $this->Role->primaryKey => $id));
        $role = $this->Role->find('first', $options);
        $this->jsonResponse($role['Role']);
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
            $this->Role->create();
            if ($this->Role->save($this->request->data)) {
                $message = __('The role has been saved.');
            } else {
                $message = __('The role could not be saved. Please, try again.');
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
        if (!$this->Role->exists($id)) {
            throw new NotFoundException(__('Invalid role'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Role->save($this->request->data)) {
                $message = __('The role has been saved.');
            } else {
                $message = __('The role could not be saved. Please, try again.');
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
        $this->Role->id = $id;
        $success = false;
        $message = '';
        if (!$this->Role->exists()) {
            throw new NotFoundException(__('Invalid role'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Role->delete()) {
            $message = __('The role has been deleted.');
        } else {
            $message = __('The role could not be deleted. Please, try again.');
        }
        $data = array('message' => $message,
            'success' => $success);
        $this->jsonResponse($data);
    }

}
