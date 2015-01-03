<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        'Acl',
        'RequestHandler',
        'Session',
        'ImageCropResize.ImageResize'
    );

    public function beforeFilter() {
        $this->RequestHandler->addInputType('json', array('json_decode', true));
        $user = $this->Session->read('user');
        $aro = 'Role/0';
        if ($user) {
            $aro = 'Role/' . $user['role_id'];
        }
        $aco = 'controllers/' . $this->request->params['controller'];
        $aco .= '/' . $this->request->params['action'];
        if (!$this->Acl->check($aro, $aco)) {
            $this->response->statusCode(403);
            $this->response->send();
            exit();
        }
    }
    
    public function jsonResponse($data) {
        $this->autoRender = false;
        $this->response->type('json');

        $json = json_encode($data);
        $this->response->body($json);
    }

}
