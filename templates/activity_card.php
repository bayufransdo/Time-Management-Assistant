<?php
$priority = $priority == 'none' ? '<p class="activity__content-item__left-priority"></p>' : '<p class="activity__content-item__left-priority">' . $priority . '</p>';
$repetition = $repetition == 'none' ? '<p class="activity__content-item__left-repetition"></p>' : '<p class="activity__content-item__left-repetition">' . $repetition . '</p>';
?>
<div class="activity__content-item">
  <div class="activity__content-item__left">
    <p class="activity__content-item__left-title">
      <?= $title ?>
    </p>
    <?= $priority ?>
    <?= $repetition ?>
    <p class="activity__content-item__left-description">
      <?= $description ?>
    </p>
  </div>
  <div class="activity__content-item__right">
    <div class="activity__content-item__right-time">
      <p>
        <?= date("d M Y", strtotime($date)) ?>
      </p>
      <p>
        <?= $time ?>
      </p>
    </div>
    <div class="activity__content-item__right-action">
      <button class="activity__content-item__right-action-edit btn">
        <img src="./assets/images/dashboard/edit.svg">
      </button>
      <button class="activity__content-item__right-action-delete btn">
        <img src="./assets/images/dashboard/delete.svg">
      </button>
      <button class="activity__content-item__right-action-complete btn">
        <img src="./assets/images/dashboard/complete.svg">
      </button>
    </div>
  </div>
</div>