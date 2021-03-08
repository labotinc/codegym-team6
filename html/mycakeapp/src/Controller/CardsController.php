<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Cards Controller
 *
 * @property \App\Model\Table\CardsTable $Cards
 *
 * @method \App\Model\Entity\Card[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CardsController extends BaseController
{
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
		$cards = $this->paginate($this->Cards);

		$this->set(compact('cards'));
	}

	/**
	 * View method
	 *
	 * @param string|null $id Card id.
	 * @return \Cake\Http\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$card = $this->Cards->get($id, [
			'contain' => ['Users', 'Payments'],
		]);

		$this->set('card', $card);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$card = $this->Cards->newEntity();
		if ($this->request->is('post')) {
			$card = $this->Cards->patchEntity($card, $this->request->getData());
			if ($this->Cards->save($card)) {
				$this->Flash->success(__('The card has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The card could not be saved. Please, try again.'));
		}
		$users = $this->Cards->Users->find('list', ['limit' => 200]);
		$this->set(compact('card', 'users'));
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Card id.
	 * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$card = $this->Cards->get($id, [
			'contain' => [],
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$card = $this->Cards->patchEntity($card, $this->request->getData());
			if ($this->Cards->save($card)) {
				$this->Flash->success(__('The card has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The card could not be saved. Please, try again.'));
		}
		$users = $this->Cards->Users->find('list', ['limit' => 200]);
		$this->set(compact('card', 'users'));
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Card id.
	 * @return \Cake\Http\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$card = $this->Cards->get($id);
		if ($this->Cards->delete($card)) {
			$this->Flash->success(__('The card has been deleted.'));
		} else {
			$this->Flash->error(__('The card could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}

	public function credit()
	{
		$this->loadComponent('Flash');
		$this->viewBuilder()->setLayout('main');

		$card = $this->Cards->newEntity();

		if ($this->request->is('post')) {
			$authuser = $this->Auth->user('id');
			$cardcount = $this->Cards->find()->where(['user_id' => $authuser])->count();

			$card_number = $this->request->getData('card_number');
			//正規表現でカード番号の整合性がとれているかチェックする
			$mc = preg_match("/^(5[1-5]\\d{14})|(2(?:22[1-9]|2[3-9][0-9]|[3-6][0-9]{2}|7[0-1][0-9]|720)\\d{12})$/", $card_number);
			$visa = preg_match("/^4\\d{12}(\\d{3})?$/", $card_number);

			//クレジットカードのバリデーションエラーメッセージ
			if (!$card_number) { //空白だったら
				$card->errors('card_number', '空白になっています');
			} elseif (!is_numeric($card_number)) { //半角数字ではない場合
				$card->errors('card_number', '半角数字以外の文字が使われています');
			} elseif (($mc === 0) && ($visa === 0)) {
				$card->errors('card_number', '不正なカード番号です');
			} else if ($cardcount >= 2) {
				$card->errors('card_number', '登録できるカードは１人２枚までです');
			}

			//セキュリティコードのフォームのバリデーションエラーメッセージ
			$securitycode = $this->request->getData('securitycode');
			if (!$securitycode) { //空白だったら
				$card->errors('securitycode', '空白になっています');
			} elseif (!is_numeric($securitycode)) { //半角数字ではない場合
				$card->errors('securitycode', '半角数字以外の文字が使われています');
			}

			$check = $this->request->getData('terms');
			//チェックボックスにチェックがない場合エラーメッセージを表示する
			if (!isset($check['check'])) {
				$card->errors('terms', '登録には利用規約に同意が必要です');
			}

			//暗号化
			$plan_text = $card_number; // 暗号化するデータ(カード番号)
			$method = 'aes-256-ecb'; // 暗号化メソッド
			$key = 'keykeykey'; // 暗号化キー
			$ciphertext = openssl_encrypt($plan_text, $method, $key);

			//エラーメッセージの上書きを避けるためsaveの条件を満たしている時のみ暗号化したカード番号を$dataに登録
			if ((isset($check['check'])) && (is_numeric($securitycode)) && ($mc === 1 || $visa === 1) && ($cardcount <= 1)) {
				$data = array(
					'user_id' => $authuser, //ログインユーザー
					'card_number' => $ciphertext,
					'expiration_date' => $this->request->getData('expiration_date'),
					'name' => $this->request->getData('name'),
					'is_deleted' => 0,
				);
			} else {
				$data = array(
					'user_id' => $authuser, //ログインユーザー
					'expiration_date' => $this->request->getData('expiration_date'),
					'name' => $this->request->getData('name'),
					'is_deleted' => 0,
				);
			}

			//有効期限は日付の'日'の部分は01を指定する
			$data['expiration_date'] = array_merge($data['expiration_date'], array('day' => '01'));
			$card = $this->Cards->patchEntity($card, $data);

			//利用規約にチェックしていて、セキュリティーコードを数字で入力していて、カード番号の整合性がとれていて、カードの登録数が１枚以下の場合にsaveを実行する
			if ((isset($check['check'])) && (is_numeric($securitycode)) && ($mc === 1 || $visa === 1) && ($cardcount <= 1)) {
				if ($this->Cards->save($card)) {
					$session = $this->getRequest()->getSession();
					//セッションに書き込み
					$session->write('session.credit', $card);
					return $this->redirect(['action' => 'confirm']);
				}
			}

			$this->Flash->error(__('保存に失敗しました。もう一度入力下さい。'));
		}

		$this->set(compact('card'));
	}

	public function confirm()
	{
		$session = $this->getRequest()->getSession();
		//セッション情報がない場合、エラー画面に遷移する
		if (!$session->read('session.credit')) {
			//現時点ではエラー画面が未実装なためcreditページにリダイレクト
			return $this->redirect(['action' => 'credit']);
		}

		$this->viewBuilder()->setLayout('main');
		//セッションを読み込み後削除
		$session->consume('session.credit');
	}

	public function mycredit()
	{
		$session = $this->getRequest()->getSession();
		//セッション情報がない場合、エラー画面に遷移する
		if (!$this->request->getSession()->read('Auth.User.id')) {
			//現時点ではエラー画面が未実装なためマイページにリダイレクト
			return $this->redirect(['controller' => 'Main', 'action' => 'mypage']);
		}
		$this->viewBuilder()->setLayout('main');
		$authuser = $this->Auth->user('id');
		$cards = $this->Cards->find()->where(['user_id' => $authuser]);
		$this->set(compact('cards'));
	}
}
