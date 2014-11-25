<?php
App::uses('AppController', 'Controller');
/**
 * UsersInformations Controller
 *
 * @property UsersInformation $UsersInformation
 * @property PaginatorComponent $Paginator
 */
class UsersInformationsController extends AppController {
public $d;
/**
 * Components
 *
 * @var array
 */
 public function beforeFilter() {
    parent::beforeFilter();
    // Allow users to register and logout.
    $this->Auth->allow('add');
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
		$this->UsersInformation->recursive = 0;
		$this->set('usersInformations', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UsersInformation->exists($id)) {
			throw new NotFoundException(__('Invalid users information'));
		}
		$options = array('conditions' => array('UsersInformation.' . $this->UsersInformation->primaryKey => $id));
		$this->set('usersInformation', $this->UsersInformation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UsersInformation->create();
			if ($this->UsersInformation->save($this->request->data)) {
				$this->Session->setFlash(__('The users information has been saved.'));
				$d = $this->request->data;
				$link = "http://" . $_SERVER['HTTP_HOST'] . $this->webroot . "usersInformations/";
				App::uses('CakeEmail', 'Network/Email');
				$mail = new CakeEmail('gmail');
				$mail->from('noreply@localhost.com')
				     ->to('antoine859@gmail.com')
				     ->subject('Inscription étudiant')
				     ->emailFormat('html')
					 ->template('message')
					 ->viewVars(array('prenom'=>$d['UsersInformation']['prenom'], 
										'link'=>$link,  
										'nom'=>$d['UsersInformation']['nom'],
										'noda'=>$d['UsersInformation']['numero_da'],
										'pays'=>$d['UsersInformation']['pay_id'],
										'programme'=>$d['UsersInformation']['programme_id'],
										'voyage'=>$d['UsersInformation']['voyage_id'],
										'date_naiss'=>$d['UsersInformation']['date_de_naissance'],
										'passeport'=>$d['UsersInformation']['numero_passeport'],
										'delivrance'=>$d['UsersInformation']['date_de_delivrance'],
										'expiration'=>$d['UsersInformation']['date_expiration'],
										'adresse'=>$d['UsersInformation']['adresse'],
										'ville'=>$d['UsersInformation']['ville'],
										'code_postal'=>$d['UsersInformation']['code_postal'],
										'telephone'=>$d['UsersInformation']['telephone'],
										'cellulaire'=>$d['UsersInformation']['cellulaire'],
										'courriel'=>$d['UsersInformation']['courriel'],
										'session'=>$d['UsersInformation']['session'],
										'cours_espagnol'=>$d['UsersInformation']['cours_espagnol'],
										'cours_espagnol_precise'=>$d['UsersInformation']['cours_espagnol_precise']
										
					 ))
					 ->send();
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users information could not be saved. Please, try again.'));
			}
		}
		$pays = $this->UsersInformation->Pays->find('list', array(
        'fields' => array('id', 'pays')));
		$programmes = $this->UsersInformation->Programme->find('list', array(
        'fields' => array('id', 'programme')));
		$voyages = $this->UsersInformation->Voyage->find('list', array(
        'fields' => array('id', 'voyage')));
		$this->set(compact('pays', 'programmes', 'voyages'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UsersInformation->exists($id)) {
			throw new NotFoundException(__('Invalid users information'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UsersInformation->save($this->request->data)) {
				$this->Session->setFlash(__('The users information has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users information could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UsersInformation.' . $this->UsersInformation->primaryKey => $id));
			$this->request->data = $this->UsersInformation->find('first', $options);
		}
		$pays = $this->UsersInformation->Pays->find('list', array(
        'fields' => array('id', 'pays')));
		$programmes = $this->UsersInformation->Programme->find('list', array(
        'fields' => array('id', 'programme')));
		$voyages = $this->UsersInformation->Voyage->find('list', array(
        'fields' => array('id', 'voyage')));
		$this->set(compact('pays', 'programmes', 'voyages'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UsersInformation->id = $id;
		if (!$this->UsersInformation->exists()) {
			throw new NotFoundException(__('Invalid users information'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UsersInformation->delete()) {
			$this->Session->setFlash(__('The users information has been deleted.'));
		} else {
			$this->Session->setFlash(__('The users information could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function paiement($id = null) {
			$this->UsersInformation->recursive = 0;
		$this->set('usersInformations', $this->Paginator->paginate());
		
		$voyages = $this->UsersInformation->Voyage->find('list', array(
        'fields' => array('id', 'voyage','prix')));
		
		
		$this->set(compact('voyages', 'prix'));
	}
	
	public function effectuerPaiement($id = null) {
			$this->UsersInformation->id = $id;
		if (!$this->UsersInformation->exists()) {
			throw new NotFoundException(__('Invalid users information'));
		}
		$results = $this->UsersInformation->saveField('paiement',1);
		
			$this->Session->setFlash(__('Paiement effectuer.'));
				$d = $this->request->data;
				$link = "http://" . $_SERVER['HTTP_HOST'] . $this->webroot . "usersInformations/view/".$id;
				App::uses('CakeEmail', 'Network/Email');
				$mail = new CakeEmail('gmail');
				$mail->from('noreply@localhost.com')
				     ->to('antoine859@gmail.com')
				     ->subject('Paiement étudiant')
				     ->emailFormat('html')
					 ->template('message2')
					 ->viewVars(array( 'link'=>$link))
					 ->send();
		
		return $this->redirect(array('action' => 'paiement'));
	
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->UsersInformation->recursive = 0;
		$this->set('usersInformations', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->UsersInformation->exists($id)) {
			throw new NotFoundException(__('Invalid users information'));
		}
		$options = array('conditions' => array('UsersInformation.' . $this->UsersInformation->primaryKey => $id));
		$this->set('usersInformation', $this->UsersInformation->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->UsersInformation->create();
			if ($this->UsersInformation->save($this->request->data)) {
				$this->Session->setFlash(__('The users information has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users information could not be saved. Please, try again.'));
			}
		}
		$pays = $this->UsersInformation->Pay->find('list');
		$programmes = $this->UsersInformation->Programme->find('list');
		$voyages = $this->UsersInformation->Voyage->find('list');
		$this->set(compact('pays', 'programmes', 'voyages'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->UsersInformation->exists($id)) {
			throw new NotFoundException(__('Invalid users information'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UsersInformation->save($this->request->data)) {
				$this->Session->setFlash(__('The users information has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users information could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UsersInformation.' . $this->UsersInformation->primaryKey => $id));
			$this->request->data = $this->UsersInformation->find('first', $options);
		}
		$pays = $this->UsersInformation->Pay->find('list');
		$programmes = $this->UsersInformation->Programme->find('list');
		$voyages = $this->UsersInformation->Voyage->find('list');
		$this->set(compact('pays', 'programmes', 'voyages'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->UsersInformation->id = $id;
		if (!$this->UsersInformation->exists()) {
			throw new NotFoundException(__('Invalid users information'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UsersInformation->delete()) {
			$this->Session->setFlash(__('The users information has been deleted.'));
		} else {
			$this->Session->setFlash(__('The users information could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
