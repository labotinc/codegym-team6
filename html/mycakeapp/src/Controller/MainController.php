<?php

namespace App\Controller;

use App\Controller\AppController;

class MainController extends AppController
{
	public function initialize()
	{
		$this->viewBuilder()->setLayout('main');
		// mypageからの遷移先である予約・決済のModel読み込み
		$this->loadModel('Reservations');
		$this->loadModel('Payments');
		$this->loadModel('Discounts');
		$this->loadModel('Tickets');
	}

	public function index()
	{
	}

	public function mypage()
	{
		// mypageから予約決済に遷移する上で必要なデータをモデル経由で取得しviewにわたす処理（遷移先が作成されてから記述）
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
}
