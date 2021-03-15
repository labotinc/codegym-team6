<?php

namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;
use Exception;

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
		$this->loadModel('ReservedSeat');
		$this->loadModel('ScreeningSchedule');
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
		$discounts = $this->Discounts->find('all');
		$tickets = $this->Tickets->find('all');
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
	}
}
