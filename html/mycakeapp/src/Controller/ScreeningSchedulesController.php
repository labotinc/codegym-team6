<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\ScreeningSchedule;
use Cake\Database\Query;
use Cake\Routing\Router; //追記
use DateTime;
use Cake\Network\Exception\InternalErrorException; //例外的なエラー処理を投げる

/**
 * ScreeningSchedules Controller
 *
 * @property \App\Model\Table\ScreeningSchedulesTable $ScreeningSchedules
 *
 * @method \App\Model\Entity\ScreeningSchedule[]|\Cake\Datasource\all_schedule_ResultSetInterface paginate($object = null, array $settings = [])
 */
class ScreeningSchedulesController extends AppController
{
    public function initialize()
    {
        // Model読み込み
        $this->loadModel('ReservationSeats');
        $this->loadModel('Users');
        $this->loadModel('Movies');
    }

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

    // スケジュールのアクション追加
    public function schedule($date = 0)
    {
        $session = $this->getRequest()->getSession(); //sessionを変数に入れる
        if ($this->request->is('post')) { //sessionで座席予約画面に渡す
            $schedule_id = $this->request->getData('schedule_id');
            $session->write('session.screening_schedules_id', $schedule_id);
            return $this->redirect(['controller' => 'Reservedseats', 'action' => 'seatselect']); //現在ブランチにないアクションですのでエラー画面が出ますがsessionの値は保持できています
        }
        //曜日を定義(ctpに渡す)
        $weekconfig = ["日", "月", "火", "水", "木", "金", "土"];
        // URLの受け渡し
        if ($date < 7) {
            //0-6の数値がctpの日付バーナーからパラメータに渡されたら
            $get_date = date('Y-m-d', strtotime('+' . $date . 'days')); //ctpの変数用に渡す変数
            $week_number = date('w', strtotime('+' . $date . 'days'));
            $header_date = date('m月d日(' . $weekconfig[$week_number] . ')', strtotime('+' . $date . 'days'));
        } else {
            //例外エラー：500に飛ばす
            throw new InternalErrorException;
        }
        // 今日の日付
        $timestamp = time();
        $now = new DateTime();
        // 映画のスケジュールテーブルから今日の日付と放映日が一致する作品レコードを検索
        if ($this->request->is('get')) {
            $schedule_datas = $this->ScreeningSchedules->find()
                ->where([
                    'screening_date LIKE' => $get_date . '%'
                ])
                ->andwhere(['ScreeningSchedules.is_deleted' => 0])
                ->contain('Movies')
                ->order('start_time', 'movie_id')
                ->toArray();
            $schedule_datas_count = $this->ScreeningSchedules->find()
                ->where([
                    'screening_date LIKE' => $get_date . '%'
                ])
                ->andwhere(['ScreeningSchedules.is_deleted' => 0])
                ->count();
        }

        if ($schedule_datas_count >= 1) {
            // 空の配列の用意
            $schedule_arr = [];
            foreach ($schedule_datas as $schedule_data) { //該当日の上映スケジュール分回る
                // 文字列で開始時間と終了時間を入れた変数を用意
                //※ここでmerge後影響出るかも(start_time,end_timeのカラム型変更)
                $display_time = $schedule_data->start_time->i18nFormat('H:mm') . '~' . $schedule_data->end_time->i18nFormat('H:mm'); //開始時間と終了時間
                if (!isset($schedule_arr[$schedule_data->movie_id])) { //同じmovie_idが無い場合
                    $schedule =  array(
                        'schedule_id' => $schedule_data->id,
                        'display_time' => $display_time
                    );
                    $schedule_arr[$schedule_data->movie_id] = array(
                        'movie_id' => $schedule_data->movie_id,
                        'title' => $schedule_data->movie->title,
                        'running_time' => $schedule_data->movie->running_time,
                        'end_date' => $schedule_data->movie->end_date,
                        'top_image_name' => $schedule_data->movie->top_image_name,
                        'is_deleted' => $schedule_data->movie->is_deleted
                    );
                    $schedule_arr[$schedule_data->movie_id]['schedule'][] = array(
                        'schedule_id' => $schedule_data->id,
                        'display_time' => $display_time
                    );
                } else { //同じmovie_idを生成した場合≒2つ目があった場合→配列を結合する
                    $schedule_arr[$schedule_data->movie_id]['schedule'][] = array(
                        'schedule_id' => $schedule_data->id,
                        'display_time' => $display_time
                    );
                }
            }

            //作品ごとの配列の保有キー数(ctp側でスケジュール数繰り返す時に使う)
            $count_sk_col = count($schedule_arr[$schedule_data->movie_id]);
            $this->set(compact('schedule_arr',  'count_sk_col'));
        }

        // DBの全てのデータを結果を代入、結果として取得
        $this->set(compact('header_date', 'weekconfig', 'date', 'schedule_datas_count'));
        //sessionの値を削除処理
        $session->consume('session.screening_schedules_id');
    }
}
