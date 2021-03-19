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
		$this->loadModel('Users');
		$this->loadModel('Cards');
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

	public function selectTicket()
	{

		$this->viewBuilder()->setLayout('main');
		//チケット情報をrowの昇順で取得
		$tickets = $this->Tickets->find('all', array('order' => array('Tickets.row ASC')));
		$session = $this->getRequest()->getSession();
		//セッションに保存された上映スケジュールidを取得
		$session_screening_schedule_id = $session->read('session.screening_schedules_id');
		//取得した上映スケジュールidで検索、レコードの情報を取得
		$screening_schedules = $this->Screening_schedules->find()->where(['id' => $session_screening_schedule_id]);
		//上映スケジュールのmovie_idの値でmoviesテーブルを検索
		$screening_schedules_movie_id = $screening_schedules->toArray()[0]->movie_id;
		$movie = $this->Movies->find()->where(['id' => $screening_schedules_movie_id]);
		//セッションに保存された座席予約のidを取得
		$session_reserved_seats_id = $session->read('session.reserved_seats_id');
		//上の行で取得したidでreserved_seatsテーブルの情報を取得
		$reserved_seats = $this->Reserved_seats->find()->where(['id' => $session_reserved_seats_id]);

		//次へのボタンを押した時の処理
		if ($this->request->is('put')) {
			//ラジオボタンで選択したチケットIDを取得
			$selected_ticket = $this->request->getData('ticket_id');
			if (isset($selected_ticket)) {
				$session->write('session.ticket_id', $selected_ticket);
				return $this->redirect(['action' => 'reservation']);
			} else {
				$error = 'チケットを選択してください';
				$this->set(compact('error'));
			}
		}
		$this->set(compact('tickets', 'screening_schedules', 'movie', 'reserved_seats'));
		$session->consume('session.ticket_id');
	}

	public function reservation()
	{
		$this->viewBuilder()->setLayout('main');
		$ticket_id = $this->getRequest()->getSession()->read('session.ticket_id');
		$tickets = $this->Tickets->find()->where(['id' => $ticket_id]);
		$authuser = $this->Auth->user('id');
		//カードの枚数を数えて、ビューでの分岐に使う
		$cardcount = $this->Cards->find()->where(['user_id' => $authuser])->count();
		$session = $this->getRequest()->getSession();
		//セッションに保存された上映スケジュールidを取得
		$session_screening_schedule_id = $session->read('session.screening_schedules_id');
		//取得した上映スケジュールidで検索、レコードの情報を取得
		$screening_schedules = $this->Screening_schedules->find()->where(['id' => $session_screening_schedule_id]);
		//上映スケジュールのmovie_idの値でmoviesテーブルを検索
		$screening_schedules_movie_id = $screening_schedules->toArray()[0]->movie_id;
		$movie = $this->Movies->find()->where(['id' => $screening_schedules_movie_id]);
		//セッションに保存された座席予約のidを取得
		$session_reserved_seats_id = $session->read('session.reserved_seats_id');
		//上の行で取得したidでreserved_seatsテーブルの情報を取得
		$reserved_seats = $this->Reserved_seats->find()->where(['id' => $session_reserved_seats_id]);
		$this->set(compact('tickets', 'screening_schedules', 'movie', 'reserved_seats', 'cardcount'));
	}

	public function dummy()
	{
		$authuser = $this->Auth->user('id');
		$reservations = $this->Reservations->find()->where(['user_id' => $authuser])->first();
		$reserved_seats = $this->Reserved_seats->find()->where(['reservation_id' => $reservations['id']])->first();
		//座席予約テーブルのスケジュールIDでスケジュールテーブルを検索
		$screening_schedules = $this->Screening_schedules->find()->where(['id' => $reserved_seats['screening_schedule_id']])->first();
		$session = $this->getRequest()->getSession();
		$this->viewBuilder()->setLayout('main');
		//次へボタンを押した時にセッションに保存をしてリダイレクト
		if ($this->request->is('post')) {
			$session->write('session.reservations_id', $reservations['id']);
			$session->write('session.reserved_seats_id', $reserved_seats['id']);
			$session->write('session.screening_schedules_id', $screening_schedules['id']);
			return $this->redirect(['action' => 'selectticket']);
		}
		//画面遷移してきたタイミングで保存していたセッションは破棄する
		$session->consume('session.reservations_id');
		$session->consume('session.reserved_seats_id');
		$session->consume('session.screening_schedules_id');
	}
}
