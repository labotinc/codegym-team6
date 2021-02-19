<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ScreeningSchedules Controller
 *
 * @property \App\Model\Table\ScreeningSchedulesTable $ScreeningSchedules
 *
 * @method \App\Model\Entity\ScreeningSchedule[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ScreeningSchedulesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Movies'],
        ];
        $screeningSchedules = $this->paginate($this->ScreeningSchedules);

        $this->set(compact('screeningSchedules'));
    }

    /**
     * View method
     *
     * @param string|null $id Screening Schedule id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $screeningSchedule = $this->ScreeningSchedules->get($id, [
            'contain' => ['Movies', 'ReservedSeats'],
        ]);

        $this->set('screeningSchedule', $screeningSchedule);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $screeningSchedule = $this->ScreeningSchedules->newEntity();
        if ($this->request->is('post')) {
            $screeningSchedule = $this->ScreeningSchedules->patchEntity($screeningSchedule, $this->request->getData());
            if ($this->ScreeningSchedules->save($screeningSchedule)) {
                $this->Flash->success(__('The screening schedule has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The screening schedule could not be saved. Please, try again.'));
        }
        $movies = $this->ScreeningSchedules->Movies->find('list', ['limit' => 200]);
        $this->set(compact('screeningSchedule', 'movies'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Screening Schedule id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $screeningSchedule = $this->ScreeningSchedules->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $screeningSchedule = $this->ScreeningSchedules->patchEntity($screeningSchedule, $this->request->getData());
            if ($this->ScreeningSchedules->save($screeningSchedule)) {
                $this->Flash->success(__('The screening schedule has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The screening schedule could not be saved. Please, try again.'));
        }
        $movies = $this->ScreeningSchedules->Movies->find('list', ['limit' => 200]);
        $this->set(compact('screeningSchedule', 'movies'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Screening Schedule id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $screeningSchedule = $this->ScreeningSchedules->get($id);
        if ($this->ScreeningSchedules->delete($screeningSchedule)) {
            $this->Flash->success(__('The screening schedule has been deleted.'));
        } else {
            $this->Flash->error(__('The screening schedule could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
