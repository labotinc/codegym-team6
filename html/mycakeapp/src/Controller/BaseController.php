<?php

namespace App\Controller;

use App\Controller\AppController;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;
use App\Form\LoginForm;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BaseController extends AppController
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
				'controller' => 'Main',
				'action' => 'mypage'
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
		$this->Auth->allow(['top', 'ticketDiscount']);
	}

	/**
	 * Index method
	 *
	 * @return \Cake\Http\Response|null
	 */

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
