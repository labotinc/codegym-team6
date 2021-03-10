<?php

namespace App\Controller;

use App\Controller\AppController;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;
use App\Form\LoginForm;
use Exception;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		// 各種コンポーネントのロード
		$this->loadComponent('RequestHandler');
		$this->loadComponent('Flash');
		$this->loadComponent('Auth', [
			'authorize' => ['Controller'],
			'authenticate' => [
				'Form' => [
					'fields' => [
						'username' => 'email',
						'password' => 'password'
					]
				]
			],
			'loginRedirect' => [
				'controller' => 'Users',
				'action' => 'login'
			],
			'logoutRedirect' => [
				'controller' => 'Users',
				'action' => 'logout',
			],
		]);
	}

	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Auth->allow(['login', 'index', 'add', 'signup', 'confirm']);
	}

	/**
	 * Index method
	 *
	 * @return \Cake\Http\Response|null
	 */
	public function index()
	{
		$users = $this->paginate($this->Users);

		$this->set(compact('users'));
	}

	/**
	 * View method
	 *
	 * @param string|null $id User id.
	 * @return \Cake\Http\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$user = $this->Users->get($id, [
			'contain' => ['Cards', 'Points', 'Reservations'],
		]);

		$this->set('user', $user);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$user = $this->Users->newEntity();
		if ($this->request->is('post')) {
			$user = $this->Users->patchEntity($user, $this->request->getData());
			if ($this->Users->save($user)) {
				$this->Flash->success(__('The user has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The user could not be saved. Please, try again.'));
		}
		$this->set(compact('user'));
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id User id.
	 * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$user = $this->Users->get($id, [
			'contain' => [],
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->getData());
			if ($this->Users->save($user)) {
				$this->Flash->success(__('The user has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The user could not be saved. Please, try again.'));
		}
		$this->set(compact('user'));
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id User id.
	 * @return \Cake\Http\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$user = $this->Users->get($id);
		if ($this->Users->delete($user)) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}

	public function signup()
	{
		$this->viewBuilder()->setLayout('main');

		if ($this->request->getSession()->read('Auth.User.id')) {
			//ログインした状態で直接遷移するとマイページトップへリダイレクト
			return $this->redirect(['controller' => 'Main', 'action' => 'mypage']);
		}

		try {
			$user = $this->Users->newEntity();
			if ($this->request->is('post')) {
				$user = $this->Users->patchEntity($user, $this->request->getData());
				if ($this->Users->save($user)) {
					$session = $this->getRequest()->getSession();
					$session->write('session.signup', $user);
					return $this->redirect(['action' => 'confirm']);
				}
			}
		} catch(Exception $e){
			throw new InternalErrorException;
		}

		$this->set(compact('user'));
	}

	public function confirm()
	{
		$session = $this->getRequest()->getSession();
		if (!$session->read('session.signup')) {
			throw new InternalErrorException;
		}

		$this->viewBuilder()->setLayout('main');
		$session->consume('session.signup');
	}

	public function login()
	{
		$this->viewBuilder()->setLayout('main');

		if ($this->request->getSession()->read('Auth.User.id')) {
			//ログインした状態で直接遷移するとマイページトップへリダイレクト
			return $this->redirect(['controller' => 'Main', 'action' => 'mypage']);
		}

		$user_form = new LoginForm();
		if ($this->request->isPost()) {
			$user_form->execute($this->request->getData());
			$user = $this->Auth->identify();
			if (!empty($user)) {
				$this->Auth->setUser($user);
				//ログイン後はマイページトップへリダイレクト
				return $this->redirect(['controller' => 'Main', 'action' => 'mypage']);
			}
			$error_msg = 'メールアドレスかパスワードが間違っています';
			$this->set(compact('error_msg'));
		}
		$this->set(compact('user_form'));
	}

	public function logout()
	{
		$this->request->getSession()->destroy();
		return $this->redirect($this->Auth->logout());
	}

	public function isAuthorized($user)
	{
		return true;
	}
}
