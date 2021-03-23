<?php

namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;
use Exception;
use Cake\I18n\Time;

class MainController extends BaseController
{
	public function initialize()
	{
		$this->viewBuilder()->setLayout('main');
		// mypageからの遷移先である予約・決済・ユーザー（削除）のModel読み込み
		$this->loadModel('Reservations');
		$this->loadModel('Payments');
		$this->loadModel('Users');
		$this->loadModel('Discounts');
		$this->loadModel('Tickets');
		$this->loadModel('Movies');
		$this->loadModel('ReservedSeats');
		$this->loadModel('ScreeningSchedules');
		$this->loadComponent('Auth');
	}

	public function mypage()
	{
		// mypageから予約・決済・ユーザーに遷移する上で必要なデータをモデル経由で取得しviewにわたす処理（遷移先が作成されてから記述）
	}

	// 料金割引一覧のアクション
	public function ticketDiscount()
	{
		// レイアウトテンプレートの無効化
		$this->layout = false;
		// DBから情報を取得
		$discounts = $this->Discounts->find()
			->where(['is_deleted' => 0])
			->all();
		$tickets = $this->Tickets->find()
			->where(['is_deleted' => 0])
			->all();
		$this->set(compact('discounts', 'tickets'));
	}

	public function top()
	{
		// レイアウトテンプレートの無効化
		$this->layout = false;
		$movie = $this->Movies->find('all')->enableHydration(false)->toArray();
		$this->set(compact('movie'));
	}

	public function reservationConfirm()
	{
		$this->viewBuilder()->setLayout('main');

		$authuser = $this->Auth->user('id');
		$my_reservations = $this->Reservations->find('all', [
			'conditions' => ['Reservations.user_id' => $authuser],
			'contain' => ['ReservedSeats' => ['ScreeningSchedules' => 'Movies'], 'Payments' => ['Tickets']],
		]);

		$week = array( "日", "月", "火", "水", "木", "金", "土" );

		$now_time = Time::now();

		$this->set(compact('my_reservations', 'week', 'now_time'));
	}
}
