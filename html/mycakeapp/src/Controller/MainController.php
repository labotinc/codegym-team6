<?php

namespace App\Controller;

use App\Controller\AppController;

class MainController extends AppController
{
	public function initialize()
	{
		$this->viewBuilder()->setLayout('main');
		$this->loadModel('Discounts');
		$this->loadModel('Tickets');
	}

	public function index()
	{
	}

	// 料金割引一覧のアクション
	public function ticketDiscount(){
		// レイアウトテンプレートの無効化
		$this->layout = false;
		// DBから情報を取得
		$discounts = $this->Discounts->find('all');
		$tickets = $this->Tickets->find('all');
        $this->set(compact('discounts','tickets'));
	}
}
