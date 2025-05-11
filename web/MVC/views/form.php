<?php

require_once("../controller/config_session.php");
require_once("../main/signup.php");
require_once("../main/signin.php");

function sign_up_form()
{
  $username = $_SESSION['form_data']['signup']['username']['data'] ?? '';
  $pwd = $_SESSION['form_data']['signup']['password']['data'] ?? '';
  $email = $_SESSION['form_data']['signup']['email']['data'] ?? '';
  $username_error = $_SESSION['form_data']['signup']['username']['error'] ?? '';
  $pwd_error = $_SESSION['form_data']['signup']['password']['error'] ?? '';
  $email_error = $_SESSION['form_data']['signup']['email']['error'] ?? '';
  $detailed_password = $_SESSION['form_data']['signup']['password']['detailed_error'] ?? [];

  echo '<form class="px-4 pb-2 auth-form active" id="signup-form" action="../main/signup.php" method="post">
    <div class="mb-3">
      <label for="username-1" class="form-label">User name</label>
      <input type="text" name="username" class="form-control" id="username-1" placeholder="yousef" value="' . htmlspecialchars($username) . '">
      <div>';
  if (!empty($username_error)) {
    echo '<p class="text-danger small fw-light mb-0">' . htmlspecialchars($username_error) . '</p>';
  }
  echo '</div>
    </div>

    <div class="mb-3">
      <label for="email-in-1" class="form-label">Email address</label>
      <input type="email" name="email" class="form-control" id="email-in-1" placeholder="email@example.com" value="' . htmlspecialchars($email) . '">
      <div>';
  if (!empty($email_error)) {
    echo '<p class="text-danger small fw-light mb-0">' . htmlspecialchars($email_error) . '</p>';
  }
  echo '</div>
    </div>

    <div class="mb-3">
      <label for="password-in-1" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="password-in-1" placeholder="new password" value="' . htmlspecialchars($pwd) . '">
      <div>';
  if (!empty($pwd_error)) {
    echo '<p class="text-danger small fw-light mb-0">' . htmlspecialchars($pwd_error) . '</p>';
  }
  if (!empty($detailed_password)) {
    foreach ($detailed_password as $error) {
      echo '<p class="text-danger small fw-light mb-0">' . htmlspecialchars($error) . '</p>';
    }
  }
  echo '</div>
    </div>
  </form>';

}

function sign_in_form()
{
  $pwd = $_SESSION['form_data']['signin']['password']['data'] ?? '';
  $email = $_SESSION['form_data']['signin']['email']['data'] ?? '';
  $pwd_error = $_SESSION['form_data']['signin']['password']['error'] ?? '';
  $email_error = $_SESSION['form_data']['signin']['email']['error'] ?? '';

  echo '<form class="px-4 pb-2 auth-form" id="signin-form" action="../main/signin.php" method="post">
    <div class="mb-3">
      <label for="email-in-2" class="form-label">Email address</label>
      <input type="email" name="email" class="form-control" id="email-in-2" placeholder="email@example.com" value="' . htmlspecialchars($email) . '">
      <div>';
  if (!empty($email_error)) {
    echo '<p class="text-danger small fw-light mb-0">' . htmlspecialchars($email_error) . '</p>';
  }
  echo '</div>
    </div>

    <div class="mb-3">
      <label for="password-in-2" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="password-in-2" placeholder="password" value="' . htmlspecialchars($pwd) . '">
      <div>';
  if (!empty($pwd_error)) {
    echo '<p class="text-danger small fw-light mb-0">' . htmlspecialchars($pwd_error) . '</p>';
  }
  echo '</div>
    </div>
  </form>';
}

function appendix_error()
{
  $global_error = $_SESSION['form_data']['signup']['global_error'] ?? '';
  echo '<div class="px-4 fw-light fs-6 text-danger">';
  if (!empty($global_error)) {
    echo '<p>' . htmlspecialchars($global_error) . '</p>';
  }
  echo '</div>';
}
?>
