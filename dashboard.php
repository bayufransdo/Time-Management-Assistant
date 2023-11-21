<?php
require_once 'utils/auth.php';
require_once 'utils/functions.php';
session_start();

// check user and token from cookie
if (!isset($_COOKIE["auth_user"]) || !isset($_COOKIE["auth_token"])) {
  // if user not login yet
  header("Location: /sign-in.php");
  exit();
}

// if user not login yet, kick them to the signin page
if (!checkAuthCookie($_COOKIE["auth_user"], $_COOKIE["auth_token"])) {
  header("Location: /sign-in.php");
  exit();
}

// get user data
$user = loginFromCookie($_COOKIE["auth_user"]);

// check session to show an alert
if (isset($_SESSION['message'], $_SESSION['type'])) {
  $message = $_SESSION['message'];
  $type = $_SESSION['type'];
  unset($_SESSION['message']);
  unset($_SESSION['type']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200;300;400;500;600;700&display=swap"
    rel="stylesheet">

  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/sidebar.css">
  <link rel="stylesheet" href="assets/css/dashboard.css">
</head>

<body>
  <?php if (isset($message, $type)): ?>
    <div class="alert alert-<?= $type ?>">
      <img src="assets/images/<?= $type ?>.svg">
      <p class="alert__message">
        <?= $message ?>
      </p>
    </div>
  <?php endif; ?>

  <!-- Sidebar start -->
  <?php
  // destructuring from user data
  ['id_user' => $id_user, 'name' => $name, 'email' => $email] = $user;
  renderSidebar($id_user, $name, $email, 'dashboard');
  ?>
  <!-- Sidebar end -->
  <!-- Main start -->
  <main>
    <!-- banner start -->
    <div class="banner">
      <div class="banner__text">
        <p class="banner__text-greeting">Welcome,
          <?= $name ?>!
        </p>
        <p class="banner__text-description">Welcome to Chrono Dashboard Easily make your task all in one place.</p>
      </div>
      <div class="banner__image">
        <img src="assets/images/dashboard/hero.png">
      </div>
    </div>
    <!-- banner end -->
    <div class="heading">
      <div class="heading__priority">
        <img src="assets/images/dashboard/timer-priority.svg">
        <div class="heading__priority__detail">
          <p class="heading__priority__detail-count">0</p>
          <p>Priority Tasks</p>
        </div>
      </div>
      <div class="heading__overdue">
        <img src="assets/images/dashboard/timer-overdue.svg">
        <div class="heading__overdue__detail">
          <p class="heading__overdue__detail-count">0</p>
          <p>Overdue Tasks</p>
        </div>
      </div>
      <div class="heading__all">
        <img src="assets/images/dashboard/timer-all.svg">
        <div class="heading__all__detail">
          <p class="heading__all__detail-count">0</p>
          <p>All Tasks</p>
        </div>
      </div>
    </div>
    <div class="activity">
      <!-- floatin action start-->
      <button class="activity__action" title="action" onclick="toggleAction()">
        <img class="activity__action-icon" src="./assets/images/dashboard/clock-plus.svg">
        <button class="activity__action-add" title="add" onclick="showModalAdd()">
          <img src="./assets/images/dashboard/add.svg">
        </button>
        <button class="activity__action-edit" title="edit" onclick="toggleEdit()">
          <img src="./assets/images/dashboard/edit.svg">
        </button>
      </button>
      <!-- floatin action end-->
      <div class="activity__heading">
        <p class="activity__heading-text">Current Activites</p>
        <div class="activity__heading-action">
          <div class="activity__heading-action__find">
            <input class="search" type="text" placeholder="Search...">
            <select class="filter">
              <option value="all">All</option>
              <option value="important">Important</option>
              <option value="overdue">overdue</option>
            </select>
          </div>
        </div>
      </div>
      <div class="activity__content">
        <div class="activity__content__empty">
          <img src="./assets/images/dashboard/empty.png">
          <p>No activities yet</p>
        </div>
      </div>
    </div>
  </main>
  <!-- Main end -->

  <!-- Modal add start -->
  <div class="modal">
    <div class="modal__add" id="modalAdd">
      <form class="modal__add__form">
        <p>Task Details</p>
        <input class="modal__add__form-title" type="text" name="title" placeholder="Title">
        <textarea class="modal__add__form-description" name="description" rows="5" placeholder="Description"></textarea>
        <p>Task Date</p>
        <div class="modal__add__form__datetime">
          <input class="modal__add__form__datetime-date" type="date" name="date">
          <input class="modal__add__form__datetime-time" type="time" name="time">
        </div>
        <p>Task Priority</p>
        <div class="modal__add__form__priority">
          <label>
            <input type="radio" name="priority" value="none" checked>
            None
          </label>
          <label>
            <input type="radio" name="priority" value="important">
            Important
          </label>
        </div>
        <p>Task Repetition</p>
        <div class="modal__add__form__repetition">
          <label>
            <input type="radio" name="repetition" value="none" checked>
            None
          </label>
          <label>
            <input type="radio" name="repetition" value="daily">
            Daily
          </label>
          <label>
            <input type="radio" name="repetition" value="weekly">
            Weekly
          </label>
          <label>
            <input type="radio" name="repetition" value="monthly">
            Monthly
          </label>
        </div>
        <div class="modal__add__form__button">
          <button class="modal__add__form__button-cancel" type="reset" title="Cancel"
            onclick="hideModalAdd()">Cancel</button>
          <button class="modal__add__form__button-add" type="submit" title="Add Activity">Add</button>
        </div>
      </form>
    </div>
  </div>
  <!-- Modal add end -->

  <script src="./assets/js/dashboard.js"></script>
</body>

</html>