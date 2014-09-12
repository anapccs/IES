<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
 		$this->Auth->allow('login');
 		$this->Auth->allow('logout');
 		$this->Auth->allow('edit');
    }

    public function login() {

        if ($this->request->is('post')) {

            $password = strtoupper($this->request->data['User']['password']);

            $user = $this->User->findByPassword(AuthComponent::password($password));

            if ($user AND $this->Auth->login($user['User']))
            {
                $this->redirect($this->Auth->loginRedirect);
            }
            else
            {
                $this->Session->setFlash($this->Auth->authError, 'default', array(), 'auth');
                $this->redirect($this->Auth->loginAction);
            }
        }

        $this->layout = '../Layouts/login';
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
        $this->Session->setFlash(__('Saiu do sistema'));
    }

    public function index() {

        $this->User->recursive = 0;
        $this->set('Users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuário inválido'));
        }
        $this->set('User', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Usuário cadastrado'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Usuário não cadastrado, por favor tente novamente.'));
            }
        }
        $opts = array('fields' => array('id', 'role'));
        $this->set('roles', $this->User->Role->find('list', $opts));
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
            throw new NotFoundException(__('Usuário inválido'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Usuário alterado'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Usuário não foi alterado. Por favor, tente novamente.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }

        $opts = array('fields' => array('id', 'role'));
        $this->set('roles', $this->User->Role->find('list', $opts));
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuário inválido'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('Usuário excluído'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Usuário não foi excluído'));
        $this->redirect(array('action' => 'index'));
    }
}
