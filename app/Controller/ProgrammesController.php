<?php
App::uses('AppController', 'Controller');
/**
 * Programmes Controller
 *
 * @property Programme $Programme
 * @property PaginatorComponent $Paginator
 */
class ProgrammesController extends AppController {

/**
 * Components
 *
 * @var array
 */
 public function beforeFilter() {
    parent::beforeFilter();
    // Allow users to register and logout.
    $this->Auth->allow( 'logout');
}

public function isAuthorized($user) {
    // All registered users can add posts
    if ($this->action === 'add') {
        return true;
    }
	
	 return parent::isAuthorized($user);
	 
	 }

public function login() {
    if ($this->request->is('post')) {
        if ($this->Auth->login($this->request->data)) {
            return $this->redirect($this->Auth->redirect());
        }
        $this->Session->setFlash(__('Invalid username or password, try again'));
    }
}

public function logout() {
    return $this->redirect($this->Auth->logout());
}
	 
	 
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Programme->recursive = 0;
		$this->set('programmes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Programme->exists($id)) {
			throw new NotFoundException(__('Invalid programme'));
		}
		$options = array('conditions' => array('Programme.' . $this->Programme->primaryKey => $id));
		$this->set('programme', $this->Programme->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Programme->create();
			if ($this->Programme->save($this->request->data)) {
				$this->Session->setFlash(__('The programme has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The programme could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Programme->exists($id)) {
			throw new NotFoundException(__('Invalid programme'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Programme->save($this->request->data)) {
				$this->Session->setFlash(__('The programme has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The programme could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Programme.' . $this->Programme->primaryKey => $id));
			$this->request->data = $this->Programme->find('first', $options);
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
		$this->Programme->id = $id;
		if (!$this->Programme->exists()) {
			throw new NotFoundException(__('Invalid programme'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Programme->delete()) {
			$this->Session->setFlash(__('The programme has been deleted.'));
		} else {
			$this->Session->setFlash(__('The programme could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Programme->recursive = 0;
		$this->set('programmes', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Programme->exists($id)) {
			throw new NotFoundException(__('Invalid programme'));
		}
		$options = array('conditions' => array('Programme.' . $this->Programme->primaryKey => $id));
		$this->set('programme', $this->Programme->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Programme->create();
			if ($this->Programme->save($this->request->data)) {
				$this->Session->setFlash(__('The programme has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The programme could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Programme->exists($id)) {
			throw new NotFoundException(__('Invalid programme'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Programme->save($this->request->data)) {
				$this->Session->setFlash(__('The programme has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The programme could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Programme.' . $this->Programme->primaryKey => $id));
			$this->request->data = $this->Programme->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Programme->id = $id;
		if (!$this->Programme->exists()) {
			throw new NotFoundException(__('Invalid programme'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Programme->delete()) {
			$this->Session->setFlash(__('The programme has been deleted.'));
		} else {
			$this->Session->setFlash(__('The programme could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
