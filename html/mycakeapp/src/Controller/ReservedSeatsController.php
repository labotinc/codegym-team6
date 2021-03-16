<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * ReservedSeats Controller
 *
 * @property \App\Model\Table\ReservedSeatsTable $ReservedSeats
 *
 * @method \App\Model\Entity\ReservedSeat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReservedSeatsController extends BaseController
{
	public function initialize()
	{
		// mypageからの遷移先である予約・決済・ユーザー（削除）のModel読み込み
		$this->loadModel('Reservations');
		$this->loadComponent('Auth');
	}
	/**
	 * Index method
	 *
	 * @return \Cake\Http\Response|null
	 */
	public function index()
	{
		$this->paginate = [
			'contain' => ['Reservations', 'ScreeningSchedules'],
		];
		$reservedSeats = $this->paginate($this->ReservedSeats);

		$this->set(compact('reservedSeats'));
	}

	/**
	 * View method
	 *
	 * @param string|null $id Reserved Seat id.
	 * @return \Cake\Http\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$reservedSeat = $this->ReservedSeats->get($id, [
			'contain' => ['Reservations', 'ScreeningSchedules'],
		]);

		$this->set('reservedSeat', $reservedSeat);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$reservedSeat = $this->ReservedSeats->newEntity();
		if ($this->request->is('post')) {
			$reservedSeat = $this->ReservedSeats->patchEntity($reservedSeat, $this->request->getData());
			if ($this->ReservedSeats->save($reservedSeat)) {
				$this->Flash->success(__('The reserved seat has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The reserved seat could not be saved. Please, try again.'));
		}
		$reservations = $this->ReservedSeats->Reservations->find('list', ['limit' => 200]);
		$screeningSchedules = $this->ReservedSeats->ScreeningSchedules->find('list', ['limit' => 200]);
		$this->set(compact('reservedSeat', 'reservations', 'screeningSchedules'));
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Reserved Seat id.
	 * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$reservedSeat = $this->ReservedSeats->get($id, [
			'contain' => [],
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$reservedSeat = $this->ReservedSeats->patchEntity($reservedSeat, $this->request->getData());
			if ($this->ReservedSeats->save($reservedSeat)) {
				$this->Flash->success(__('The reserved seat has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The reserved seat could not be saved. Please, try again.'));
		}
		$reservations = $this->ReservedSeats->Reservations->find('list', ['limit' => 200]);
		$screeningSchedules = $this->ReservedSeats->ScreeningSchedules->find('list', ['limit' => 200]);
		$this->set(compact('reservedSeat', 'reservations', 'screeningSchedules'));
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Reserved Seat id.
	 * @return \Cake\Http\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$reservedSeat = $this->ReservedSeats->get($id);
		if ($this->ReservedSeats->delete($reservedSeat)) {
			$this->Flash->success(__('The reserved seat has been deleted.'));
		} else {
			$this->Flash->error(__('The reserved seat could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}

	public function pra()
	{
		$this->viewBuilder()->setLayout('main');
		$authuser = $this->Auth->user('id');

		// $reservedSeats = $this->ReservedSeats->newEntity();
		$reservations = $this->Reservations->newEntity();

		// nimaさんの流re

		// var_dump($authuser);
		// exit;

		if ($this->request->is('post')) {
			$data = array(
				'user_id' => $authuser, //ログインユーザー
			);
			$reservations = $this->Reservations->patchEntity($reservations, $data);
			// var_dump($reservations['id']);
			// exit;
			if ($this->Reservations->save($reservations)) {
				$reservations_id = $this->Reservations->find(array('order' => array('Reservations.created DESC')))->where(['user_id' => $authuser])->first();
				// $session = $this->getRequest()->getSession();
				// //セッションに書き込み
				// $session->write('session.credit', $reservations);
				return $this->redirect(['controller' => 'Main', 'action' => 'mypage']);
			}
		}
		$this->set(compact('reservations'));
	}
}
