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

	// 後ほど修正：seatselectへの画面遷移時にセッションがなければ弾く。その処理を書く。
	public function seatSelect()
	{
		$this->viewBuilder()->setLayout('main');
		$authuser = $this->Auth->user('id');

		$reservations = $this->Reservations->newEntity(); //予約
		$reserved_seats = $this->Reserved_seats->newEntity(); //座席予約
		$session = $this->getRequest()->getSession();
		$seatNum = $this->request->getData('seatNum');

		if ($this->request->is('post')) {
			if (isset($seatNum)) {
				//Reservationsテーブルに保存
				$data = array('user_id' => $authuser);
				$reservations = $this->Reservations->patchEntity($reservations, $data);
				if ($this->Reservations->save($reservations)) {
					$reservations_id = $this->Reservations->find('all', array('order' => array('Reservations.created DESC')))->where(['user_id' => $authuser])->enableHydration(false)->toArray();
					// セッションに書き込み
					$session->write('session.reservations_id', $reservations_id[0]['id']);
				}
				//セッションの中の上映スケジュールidを読み込む
				$session_screening_schedule_id = $session->read('session.screening_schedule');
				//Reserved_seatsテーブルに保存
				$data = array(
					'reservation_id' => $reservations_id[0]['id'],
					'screening_schedule_id' => $session_screening_schedule_id,
					'seat' => $seatNum[0],
				);
				$reserved_seats = $this->Reserved_seats->patchEntity($reserved_seats, $data);
				if ($this->Reserved_seats->save($reserved_seats)) {
					// 直前に保存した予約idを使って予約座席idを検索
					$reserved_seats_id = $this->Reserved_seats->find('all', array('order' => array('Reserved_seats.created DESC')))->where(['reservation_id' => $reservations_id[0]['id']])->enableHydration(false)->toArray();
					// セッションに書き込み
					$session->write('session.reserved_seats_id', $reserved_seats_id[0]['id']);
				}
				//リダイレクト先は仮にマイページとする
				return $this->redirect(['controller' => 'Main', 'action' => 'mypage']);
			} else {
				$error = '座席を選択してください';
				$this->set(compact('error'));
			}
		}
		$this->set(compact('reservations', 'reserved_seats'));
		$session->consume('session.reservations_id');
		$session->consume('session.reserved_seats_id');
	}

	public function dummySeat()
	{
		$this->viewBuilder()->setLayout('main');
		//座席予約テーブルのでスケジュールテーブルを検索
		$screening_schedule = $this->Screening_schedules->find()->first();
		$session = $this->getRequest()->getSession();
		//次へボタンを押した時にセッションに保存をしてリダイレクト
		if ($this->request->is('post')) {
			$session->write('session.screening_schedule', $screening_schedule['id']);
			return $this->redirect(['action' => 'seatselect']);
		}
		//画面遷移してきたタイミングで保存していたセッションは破棄する
		$session->consume('session.screening_schedule');
	}
}
