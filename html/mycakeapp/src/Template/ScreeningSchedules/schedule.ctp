<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->Html->charset() ?>
    <title>QUEL CINEMAS</title>
    <!-- resetcss読み込み -->
    <?= $this->Html->css('reset') ?>
    <?= $this->Html->css('screenschedule') ?>
    <!-- GoogleFont読み込み -->
    <!-- Noto Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
</head>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ScreeningSchedule $screeningSchedule
 */

// $date_time = new DateTime(); //現在日時時刻をサーバーから取得
//配列で曜日を用意

// $date = $date_time->format('Y' . '-' . 'm' . '-' . 'd');
// //その日の日付
// $today_date = $date;
// //指定日の曜日(int)
// $today_weeek_int = date("w", strtotime($today_date));
?>

<a href="<?= $this->Url->build(['controller' => "screeningSchedules", 'action' => 'schedule']); ?>/<?= $date ?>"></a>

<!-- コンテンツメイン部分は今回レイアウトは読み込まない -->
<?= $this->layout = false; ?>
<!-- ヘッダーエレメント読み込み -->
<?= $this->element('header') ?>
<!-- 上映スケジュールバーナー -->
<main>
    <!-- バーナータイトル -->
    <div class="banner-title">上映スケジュール</div>

    <!-- バーナー本体 -->
    <!-- この部分は後ほどJavaScript実装 -->
    <div class="week-banner">
        <?php
        //曜日を定義
        $weekconfig = ["日", "月", "火", "水", "木", "金", "土"];

        //0現在時刻　システムから取得　一回で済む　＝今日
        //for
        //1指定時刻　０から計算　ex明日、明後日
        //2表示時刻　１からフォーマット
        //3リクエスト値　１からフォーマット
        //endfor
        ?>
        <!-- for文で現在日時から一週間分を表示 -->
        <?php $today = new DateTime(); //0
        ?>
        <?php for ($i = 0; $i < 7; $i++) : ?>
            <?php
            //現在の曜日
            $w = date("w", strtotime("+{$i} day", strtotime($today)));
            //バーナーに表示させる書式
            $display_date = date('m-d' . '(' . $weekconfig[$w] . ')', strtotime('+' . $i . 'days', time()));
            //Controllerに渡す書式
            $get_date = date('Y-m-d', strtotime('+' . $i . 'days', time()));

            $date = strtotime("+{$i} day", strtotime($today));

            dd($date);
            ?>
            <div class="banner-box" id="banner-box<?= $i ?>">
                <p class="banner-date">$date</p>
                <a href="<?php echo $this->Html->link('date', array(
                                'controller' => 'ScreeningSchedules',
                                'action' => 'schedule',
                                'param1' => $date
                            )) ?>"></a>
            </div>
        <?php endfor; ?>
    </div>
    <!-- 実際の映画のデータ表示部分 -->
    <div class="movie-schedule-wrapper">
        <!-- バーナーで選択された日にち表示(javaScriptで後で実装) -->
        <div class="selected-date" id="selected-date">
            <!-- 今は今日日付 -->
            <?php
            echo date('m月d日' . '(' . $weekconfig[$w + 1]   . ')');
            ?>
            <div>
                <?php foreach ($schedule_arr as $schedule_movie) : ?>
                    <!-- echo Movie Box -->
                    <div class="box">
                        <div class="box-title">
                            <p><?= h($schedule_movie['title']); ?> [ 上映時間 : <?= h($schedule_movie['running_time']); ?>分 ] 　<span class="box-title"><?= h($schedule_movie['end_date']->i18nFormat('yyyy年MM月dd日')); ?> 終了予定</span></p>
                        </div>
                        <div class="movie-schedule-box">
                            <!-- 映画の画像top_image_nameを表示 -->
                            <!-- DBのトップ画像を表示 -->
                            <?php echo $this->Html->image('/img/movie/' . ($schedule_movie['top_image_name'])); ?>

                            <?php foreach ($schedule_movie['schedule'] as $schedule_time) : ?>
                                <!-- echo Schedule Box -->
                                <div class="movie-time-box">
                                    <!-- 上映時間start_time ~ end_timeをDB(上映スケジュールテーブル)から取得して表示 -->
                                    <p class="running-time"><span class="start-time"><?= h($schedule_time); ?></span></p>

                                    <!-- リンクで座席予約ページに推移させる -->
                                    <button type="button"><a href="#"></a> 予約購入</button>
                                </div>
                            <?php endforeach; ?>
                            <!-- スライドの隠して上げる部分 -->
                            <div class="box-trim"></div>

                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- 映画のタイトル詳細ボックス-->
                <!-- 選択されたその日に上映される映画作品分の繰り返しを実行 (作品数はcontrollerから後ほど取得)-->
                <!-- 現在はヒットした映画作品数字を入れている -->
            </div>
</main>

<!-- フッターエレメント読み込み -->
<?= $this->element('footer') ?>
