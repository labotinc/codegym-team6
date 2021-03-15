<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Tickets Controller
 *
 * @property \App\Model\Table\TicketsTable $Tickets
 *
 * @method \App\Model\Entity\Ticket[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TicketsController extends BaseController
{
	public function initialize()
	{
		$this->loadModel('Reservations');
		$this->loadModel('Payments');
		$this->loadModel('Users');
		$this->loadModel('Discounts');
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
		$tickets = $this->paginate($this->Tickets);

		$this->set(compact('tickets'));
	}

	/**
	 * View method
	 *
	 * @param string|null $id Ticket id.
	 * @return \Cake\Http\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$ticket = $this->Tickets->get($id, [
			'contain' => ['Payments'],
		]);

		$this->set('ticket', $ticket);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$ticket = $this->Tickets->newEntity();
		if ($this->request->is('post')) {
			$ticket = $this->Tickets->patchEntity($ticket, $this->request->getData());
			if ($this->Tickets->save($ticket)) {
				$this->Flash->success(__('The ticket has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The ticket could not be saved. Please, try again.'));
		}
		$this->set(compact('ticket'));
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Ticket id.
	 * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$ticket = $this->Tickets->get($id, [
			'contain' => [],
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$ticket = $this->Tickets->patchEntity($ticket, $this->request->getData());
			if ($this->Tickets->save($ticket)) {
				$this->Flash->success(__('The ticket has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The ticket could not be saved. Please, try again.'));
		}
		$this->set(compact('ticket'));
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Ticket id.
	 * @return \Cake\Http\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$ticket = $this->Tickets->get($id);
		if ($this->Tickets->delete($ticket)) {
			$this->Flash->success(__('The ticket has been deleted.'));
		} else {
			$this->Flash->error(__('The ticket could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}

	public function ticket()
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
			return $this->redirect(['action' => 'ticket']);
		}
		$this->set(compact('seats', 'screening_schedule', 'movie'));
		//画面遷移してきたタイミングで保存していたセッションは破棄する
		$session->consume('session.seats');
		$session->consume('session.screening_schedule');
		$session->consume('session.movie');
	}
}
