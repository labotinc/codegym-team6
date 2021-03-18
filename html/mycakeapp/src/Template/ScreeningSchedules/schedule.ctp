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

?>

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
        <?php $weekconfig = ["日", "月", "火", "水", "木", "金", "土"]; //曜日を定義
        ?>
        <?php
        //for文で現在日時から一週間分を表示
        for ($i = 0; $i < 7; $i++) :
        ?>
            <?php
            //現在の曜日
            $w = date("w", strtotime('+' . $i . 'day'));
            //バーナーに表示させる書式
            $display_date = date('m-d' . '(' . $weekconfig[$w] . ')', strtotime('+' . $i . 'days'));
            ?>
            <div class="banner-box" id="banner-box">
                <a class="date-link" href="<?= $this->Url->build([
                                                'controller' => 'ScreeningSchedules',
                                                'action' => 'schedule',
                                                $i
                                            ]); ?>"><?= $display_date; ?></a>
            </div>
        <?php endfor; ?>
    </div>
    <!-- 実際の映画のデータ表示部分 -->
    <div class="movie-schedule-wrapper">
        <!-- バーナーで選択された日にち表示(javaScriptで後で実装) -->
        <div class="selected-date" id="selected-date">
            <!-- 今は今日日付 -->
            <?php
            echo $header_date;
            ?>

            <div>
                <?= $this->Form->create(null, array('novalidate' => true)); ?>
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

                            <?php foreach ($schedule_movie['schedule'] ['button_id']as $schedule_time) : ?>
                                <?php foreach ($schedule_movie['button_id'] as $schedule_id) : ?>
                                <!-- echo Schedule Box -->
                                <div class="movie-time-box">
                                    <!-- 上映時間start_time ~ end_timeをDB(上映スケジュールテーブル)から取得して表示 -->
                                    <p class="running-time"><span class="start-time"><?= h($schedule_time); ?></span></p>

                                    <!-- リンクで座席予約ページに推移させる -->
                                        <?php echo $this->Form->button('予約購入', [
                                            'label' => false,
                                            'type' => 'submit',
                                            'value' => $schedule_id
                                        ]); ?>

                                </div>

                                    <?php endforeach; ?>
                            <?php endforeach; ?>
                            <!-- スライドの隠して上げる部分 -->
                            <div class="box-trim"></div>

                        </div>
                    </div>
                <?php endforeach; ?>
                <?= $this->Form->end() ?>
                <!-- 映画のタイトル詳細ボックス-->
                <!-- 選択されたその日に上映される映画作品分の繰り返しを実行 (作品数はcontrollerから後ほど取得)-->
                <!-- 現在はヒットした映画作品数字を入れている -->
            </div>
</main>

<!-- フッターエレメント読み込み -->
<?= $this->element('footer') ?>
