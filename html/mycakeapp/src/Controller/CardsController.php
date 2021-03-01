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
class CardsController extends AppController
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

            $data = array(
                'user_id' => 1, //仮の値
                'card_number' => $this->request->getData('card_number'),
                'expiration_date' => $this->request->getData('expiration_date'),
                'name' => $this->request->getData('name'),
                'is_deleted' => 0,
            );

            //有効期限は日付の'日'の部分は01を指定する
            $data['expiration_date'] = array_merge($data['expiration_date'], array('day' => '01'));
            $card = $this->Cards->patchEntity($card, $data);

            //セキュリティコードのフォームのバリデーション
            $securitycode = $this->request->getData('securitycode');
            if (!$securitycode) { //空白だったら
                $card->errors('securitycode', '空白になっています');
            } elseif (!is_numeric($securitycode)) { //数字じゃなかったら
                $card->errors('securitycode', '半角数字以外の文字が使われています');
            }


            //セキュリティーコードを数字で入力している
            if (is_numeric($_POST['securitycode'])) {
                if ($this->Cards->save($card)) {
                    return $this->redirect(['action' => 'confirm']);
                }
            }

            $this->Flash->error(__('保存に失敗しました。もう一度入力下さい。'));
        }

        $this->set(compact('card'));
    }

    public function confirm()
    {
        $this->viewBuilder()->setLayout('main');
    }
}
