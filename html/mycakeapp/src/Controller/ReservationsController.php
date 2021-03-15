<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Reservations Controller
 *
 * @property \App\Model\Table\ReservationsTable $Reservations
 *
 * @method \App\Model\Entity\Reservation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReservationsController extends BaseController
{
	public function initialize()
	{
		$this->loadModel('Reservations');
		$this->loadModel('Tickets');
		$this->loadModel('Movies');
		$this->loadModel('Reserved_seats');
		$this->loadModel('Screening_schedules');
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
			'contain' => ['Users'],
		];
		$reservations = $this->paginate($this->Reservations);

		$this->set(compact('reservations'));
	}

	/**
	 * View method
	 *
	 * @param string|null $id Reservation id.
	 * @return \Cake\Http\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$reservation = $this->Reservations->get($id, [
			'contain' => ['Users', 'Payments', 'ReservedSeats'],
		]);

		$this->set('reservation', $reservation);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$reservation = $this->Reservations->newEntity();
		if ($this->request->is('post')) {
			$reservation = $this->Reservations->patchEntity($reservation, $this->request->getData());
			if ($this->Reservations->save($reservation)) {
				$this->Flash->success(__('The reservation has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The reservation could not be saved. Please, try again.'));
		}
		$users = $this->Reservations->Users->find('list', ['limit' => 200]);
		$this->set(compact('reservation', 'users'));
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Reservation id.
	 * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$reservation = $this->Reservations->get($id, [
			'contain' => [],
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$reservation = $this->Reservations->patchEntity($reservation, $this->request->getData());
			if ($this->Reservations->save($reservation)) {
				$this->Flash->success(__('The reservation has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The reservation could not be saved. Please, try again.'));
		}
		$users = $this->Reservations->Users->find('list', ['limit' => 200]);
		$this->set(compact('reservation', 'users'));
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Reservation id.
	 * @return \Cake\Http\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$reservation = $this->Reservations->get($id);
		if ($this->Reservations->delete($reservation)) {
			$this->Flash->success(__('The reservation has been deleted.'));
		} else {
			$this->Flash->error(__('The reservation could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}

	public function selectticket()
	{
		$this->viewBuilder()->setLayout('main');
		$tickets = $this->Tickets->find('all', array('order' => array('Tickets.row ASC')));
		$session = $this->getRequest()->getSession();
		//次へのボタンを押した時の処理
		if ($this->request->is('put')) {
			//ラジオボタンで選択したチケットIDを取得
			$selected_ticket = $this->request->getData('ticket');
			if (isset($selected_ticket)) {
				$session->write('session.ticket', $selected_ticket);
				return $this->redirect(['action' => 'reservation']);
			} else {
				$error = 'チケットを選択してください';
				$this->set(compact('error'));
			}
		}
		$this->set(compact('tickets'));
		$session->consume('session.ticket');
	}

	public function reservation()
	{
		$this->viewBuilder()->setLayout('main');
		$ticket_id = $this->getRequest()->getSession()->read('session.ticket');
		$tickets = $this->Tickets->find()->where(['id' => $ticket_id]);
		$this->set(compact('tickets'));
	}

	public function dummy()
	{
		$seats = $this->Reserved_seats->find()->first();
		//座席予約テーブルのスケジュールIDでスケジュールテーブルを検索
		$screening_schedule = $this->Screening_schedules->find()->where(['id' => $seats['screening_schedule_id']])->first();
		//スケジュールテーブルの映画IDで映画テーブルを検索
		$movie = $this->Movies->find()->where(['id' => $screening_schedule['movie_id']])->first();
		$session = $this->getRequest()->getSession();
		$this->viewBuilder()->setLayout('main');
		//次へボタンを押した時にセッションに保存をしてリダイレクト
		if ($this->request->is('post')) {
			$session->write('session.seats', $seats);
			$session->write('session.screening_schedule', $screening_schedule);
			$session->write('session.movie', $movie);
			return $this->redirect(['action' => 'selectticket']);
		}
		$this->set(compact('seats', 'screening_schedule', 'movie'));
		//画面遷移してきたタイミングで保存していたセッションは破棄する
		$session->consume('session.seats');
		$session->consume('session.screening_schedule');
		$session->consume('session.movie');
	}
}
