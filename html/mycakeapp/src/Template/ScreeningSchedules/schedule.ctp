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

<body>

    <!-- 上映スケジュールバーナー -->
    <main>
        <!-- バーナータイトル -->
        <div class="banner-title">上映スケジュール</div>

        <!-- バーナー本体 -->
        <!-- この部分は後ほどJavaScript実装 -->
        <div class="week-banner">
            <!-- 曜日を定義 -->
            <?php $weekconfig = ["日", "月", "火", "水", "木", "金", "土"]; ?>
            <!-- for文で現在日時から一週間分を表示 -->
            <?php for ($i = 0; $i < 7; $i++) : ?>
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
        <!-- 映画詳細情報表示部分 -->
        <div class="movie-schedule-wrapper">
            <div class="selected-date" id="selected-date">
                <!-- 選択された日付 -->
                <?php
                echo $header_date;
                ?>
                <?php if ($schedule_datas_count === 0) : ?>
                    <div>スケジュールがありません</div>
                <?php endif; ?>
                <div>
                    <?= $this->Form->create(null, array('novalidate' => true)); ?>
                    <!-- 映画のタイトル詳細ボックス-->
                    <!-- 縦に映画作品を繰り返し -->
                    <?php if ($schedule_datas_count >= 1) : ?>
                        <?php foreach ($schedule_arr as $schedule_movie) : ?>
                            <div class="box">
                                <div class="box-title">
                                    <p><?= h($schedule_movie['title']); ?> [ 上映時間 : <?= h($schedule_movie['running_time']); ?>分 ] 　<span class="box-title"><?= h($schedule_movie['end_date']->i18nFormat('yyyy年MM月dd日')); ?> 終了予定</span></p>
                                </div>
                                <div class="movie-schedule-box">
                                    <!-- 映画の画像top_image_nameを表示 -->
                                    <!-- DBのトップ画像を表示 -->
                                    <?php echo $this->Html->image('/img/movie/' . ($schedule_movie['top_image_name'])); ?>
                                    <!-- 横に映画の持ってるスケジュール情報を繰り返し -->
                                    <!-- = スケジュールの配列の数繰り返し=$schedule_arrの１作品ごとの保有キー($count_col)-6(movieの情報キー)  -->
                                    <?php foreach ($schedule_movie['schedule'] as $schedule_data) : ?>
                                        <div class="movie-time-box">
                                            <!-- 上映時間start_time ~ end_timeをDB(上映スケジュールテーブル)から取得して表示 -->
                                            <p class="running-time"><span class="start-time"><?= h($schedule_data['display_time']); ?></span></p>

                                            <!-- リンクで座席予約ページに推移させる -->
                                            <?php echo $this->Form->button('予約購入', [
                                                'label' => false,
                                                'type' => 'submit',
                                                'name' => 'schedule_id',
                                                'value' => $schedule_data['schedule_id']
                                            ]); ?>
                                        </div>
                                    <?php endforeach; ?>
                                    <!-- スライドの隠して上げる部分 -->
                                    <div class="box-trim"></div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?= $this->Form->end() ?>
                </div>
    </main>
</body>
<!-- フッターエレメント読み込み -->
<?= $this->element('footer') ?>
<?echo $this->fetch('content');?>

</html>
