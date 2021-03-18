<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Payments Controller
 *
 * @property \App\Model\Table\PaymentsTable $Payments
 *
 * @method \App\Model\Entity\Payment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaymentsController extends BaseController
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
            'contain' => ['Reservations', 'Taxes', 'Cards', 'Tickets', 'Discounts'],
        ];
        $payments = $this->paginate($this->Payments);

        $this->set(compact('payments'));
    }

    /**
     * View method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $payment = $this->Payments->get($id, [
            'contain' => ['Reservations', 'Taxes', 'Cards', 'Tickets', 'Discounts'],
        ]);

        $this->set('payment', $payment);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $payment = $this->Payments->newEntity();
        if ($this->request->is('post')) {
            $payment = $this->Payments->patchEntity($payment, $this->request->getData());
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $reservations = $this->Payments->Reservations->find('list', ['limit' => 200]);
        $taxes = $this->Payments->Taxes->find('list', ['limit' => 200]);
        $cards = $this->Payments->Cards->find('list', ['limit' => 200]);
        $tickets = $this->Payments->Tickets->find('list', ['limit' => 200]);
        $discounts = $this->Payments->Discounts->find('list', ['limit' => 200]);
        $this->set(compact('payment', 'reservations', 'taxes', 'cards', 'tickets', 'discounts'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $payment = $this->Payments->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $payment = $this->Payments->patchEntity($payment, $this->request->getData());
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $reservations = $this->Payments->Reservations->find('list', ['limit' => 200]);
        $taxes = $this->Payments->Taxes->find('list', ['limit' => 200]);
        $cards = $this->Payments->Cards->find('list', ['limit' => 200]);
        $tickets = $this->Payments->Tickets->find('list', ['limit' => 200]);
        $discounts = $this->Payments->Discounts->find('list', ['limit' => 200]);
        $this->set(compact('payment', 'reservations', 'taxes', 'cards', 'tickets', 'discounts'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $payment = $this->Payments->get($id);
        if ($this->Payments->delete($payment)) {
            $this->Flash->success(__('The payment has been deleted.'));
        } else {
            $this->Flash->error(__('The payment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function payment()
    {
        $this->viewBuilder()->setLayout('main');
        $authuser = $this->Auth->user('id');
        //ログインユーザーのカードを登録した順番で取得
        $cards = $this->Cards->find('all', array('order' => array('Cards.created ASC')))->where(['user_id' => $authuser]);
        $this->set(compact('cards'));
    }
}
