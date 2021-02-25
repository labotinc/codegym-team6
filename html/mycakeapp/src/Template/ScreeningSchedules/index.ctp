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
 * @var \App\Model\Entity\ScreeningSchedule[]|\Cake\Collection\CollectionInterface $screeningSchedules
 */

$date_time = new DateTime(); //現在日時時刻をサーバーから取得
//配列で曜日を用意
$weekconfig = [
    "日", "月", "火", "水", "木", "金", "土"
];
$date = $date_time->format('Y' . '-' . 'm' . '-' . 'd');
//その日の日付
$today_date = $date;
//指定日の曜日(int)
$today_weeek_int = date("w", strtotime($today_date));
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
        <div class="nav-button" id="nav-button">
            < </div>
                <!-- for文で現在日時から一週間分を表示 -->
                <?php for ($i = 0; $i < 7; $i++) : ?>
                    <div class="banner-box" id="banner-box">
                        <p class="banner-date">
                            <?php
                            $w = date("w", strtotime("+{$i} day", strtotime($today_date))); //現在の曜日
                            echo date('m月d日' . '(' . $weekconfig[$w] . ')', strtotime("+{$i} day", strtotime($today_date)));
                            ?></p>
                    </div>
                <?php endfor; ?>
                <div class="nav-button" id="nav-button"> > </div>
        </div>

        <!-- 実際の映画のデータ表示部分 -->
        <div class="movie-schedule-wrapper">
            <!-- バーナーで選択された日にち表示(javaScriptで後で実装) -->
            <div class="selected-date" id="selected-date">(仮)○月○日(○)</div>

            <!-- 映画のタイトル詳細ボックス-->
            <!-- 選択されたその日に上映される映画作品分の繰り返しを実行 (作品数はcontrollerから後ほど取得)-->
            <?php for ($j = 0; $j < 4; $j++) : ?>
                <div class="box">
                    <!-- タイトル、上映時間、終了時間をcontrollerから取得 -->
                    <div class="box-title">
                        <p>タイトル [ 上映時間 : 100分 ] 　<span class="box-title"> 00月00日(金)終了予定</span></p>
                    </div>
                    <div class="movie-schedule-box">
                        <!-- 映画の画像を表示 -->
                        <?php
                        echo $this->Html->image("test.jpg");
                        ?>
                        <!-- for文で映画のスケジュールタイムを上映回数分表示(上映回数はcontrollerから後ほど取得) -->
                        <?php for ($n = 0; $n < 4; $n++) : ?>
                            <div class="movie-time-box">
                                <!-- 上映時間をDBから取得して表示 -->
                                <p class="running-time"><span class="start-time">00:00~</span>00:00</p>
                                <button type="button">予約購入</button>
                            </div>
                        <?php endfor; ?>
                        <!-- スライドボタン ( JavaScriptで動きつける)-->
                        <div class="schedule-nav-button" id="nav-button">
                            <p> > </p>
                        </div>

                    </div>
                </div>
            <?php endfor; ?>
        </div>
</main>

<!-- フッターエレメント読み込み -->
<?= $this->element('footer') ?>
