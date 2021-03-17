<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\ScreeningSchedule;
use Cake\Database\Query;
use Cake\Routing\Router; //追記
use DateTime;

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
    public function schedule($today)
    {
        if($_REQUEST['date']){
            //リクエストある場合＝指定日を表示
            $get_date = date('Y-m-d', strtotime('+' . $_REQUEST['hoge'] . 'days', time()));
        }else{
            //初回表示＝今日を表示
            //$get_date = time()->fotmat('Y-m-d');
        }
        //DBから$get_dateに該当するmovie schedulesを取得
        //// find like $get_date %;

        for ($i = 0; $i < 7; $i++) :
            $display_date = date('m-d', strtotime('+'. $i . 'days', time()));
            $get_date = date('Y-m-d', strtotime('+' . $i . 'days', time()));
            //var_dump($display_date, $get_date);
        endfor;
       // exit();





        if($_REQUEST['param1']){//0-6
            // if param = 0 new date;
            $get_date = strtotime('+'. $_REQUEST['param1']. 'days');//*+0days 動くのか？
        }else{
            $get_date = new DateTime();//今日
        }
        $get_date2 = $get_date->format('Y-m-d');
        // 今日の日付
        // 現在日時時刻をサーバーから取得
        // UNIX TIMESTAMPを取得
        $timestamp = time();
        // date()で日時を出力
        // $today = date('Y-m-d', $timestamp);
        $now = new DateTime();
        $today = $now->format('Y-m-d');

        // 映画のスケジュールテーブルから今日の日付と放映日が一致する作品レコードを検索
        if ($this->request->is('get')) {
            $schedule_datas = $this->ScreeningSchedules->find()
                ->where([
                    'screening_date LIKE' => $today . '%'
                ])
                ->andwhere(['ScreeningSchedules.is_deleted' => 0])
                ->contain('Movies')
                ->order('movie_id', 'start_time')
                ->toArray();
        }
        // 空の配列の用意
        $schedule_arr = [];
        foreach ($schedule_datas as $schedule_data) { //該当日の上映スケジュール分回る
            // 文字列で開始時間と終了時間を入れた変数を用意
            $display_time = $schedule_data->start_time->i18nFormat('H:mm') . '~' . $schedule_data->end_time->i18nFormat('H:mm');
            if (!isset($schedule_arr[$schedule_data->movie_id])) { //同じmovie_idが無い場合
                $schedule_arr[$schedule_data->movie_id] = array(
                    'movie_id' => $schedule_data->movie_id,
                    'title' => $schedule_data->movie->title,
                    'running_time' => $schedule_data->movie->running_time,
                    'end_date' => $schedule_data->movie->end_date,
                    'top_image_name' => $schedule_data->movie->top_image_name,
                    'is_deleted' => $schedule_data->movie->is_deleted,
                    'schedule' => array($display_time)
                );
            } else { //同じmovie_idを生成した場合≒2つ目があった場合→配列を結合する
                array_push($schedule_arr[$schedule_data->movie_id]['schedule'], $display_time);
            }
        }

        $hit  = count($schedule_datas);
        $arr[] = array();

        // ヒットした映画の件数(その日の作品数)
        if ($this->request->is('get')) {
            $movie_find = $this->Movies->find()
                // まだ上映期間中の映画
                ->where(['end_date >=' => $today])
                // かつ削除されていない映画
                ->andwhere(['is_deleted' => 0])
                ->contain('ScreeningSchedules');
            // 今日上映の映画作品数
            $count_movie = $movie_find->count();
        }
        $movie_data = $movie_find->toArray();
        // //  DBの全てのデータを結果を代入、結果として取得
        // $all_movie_result = $movie_data->toArray();
        $this->set(compact('schedule_arr', 'movie_data', 'count_movie'));
    }
}
