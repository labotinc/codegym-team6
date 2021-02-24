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
?>
<?= $this->layout = false; ?>
<?= $this->element('header') ?>
<!-- 上映スケジュールバーナー -->
<main>
    <!-- バーナータイトル -->
    <div class="banner-title">上映スケジュール</div>
    <!-- バーナー本体 -->
    <!-- この部分は後ほどJavaScript実装 -->
    <!-- 日付のデータはDBからContollerから後ほどとってくる -->
    <div class="week-banner">
        <div class="nav-button" id="nav-button">
            < </div>
                <div class="banner-box" id="banner-box">
                    <p class="banner-date">○月○日(○)</p>
                </div>
                <div class="banner-box" id="banner-box">
                    <p class="banner-date">○月○日(○)</p>
                </div>
                <div class="banner-box" id="banner-box">
                    <p class="banner-date">○月○日(○)</p>
                </div>
                <div class="banner-box" id="banner-box">
                    <p class="banner-date">○月○日(○)</p>
                </div>
                <div class="banner-box" id="banner-box">
                    <p class="banner-date">○月○日(○)</p>
                </div>
                <div class="banner-box" id="banner-box">
                    <p class="banner-date">○月○日(○)</p>
                </div>
                <div class="banner-box" id="banner-box">
                    <p class="banner-date">○月○日(○)</p>
                </div>
                <div class="nav-button" id="nav-button"> > </div>
        </div>
</main>

<?= $this->element('footer') ?>
