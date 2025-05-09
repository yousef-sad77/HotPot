<?php
require_once('./form.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Auth Form</title>
  <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" />
  <script defer src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script defer src="../../static/js/debug.js"></script>
  <script defer src="../../static/js/sign.js"></script>
  <script defer src="../../static/js/switch.js"></script>
  <!-- <link rel="stylesheet" href="../../static/css/master.css"> -->
  <link rel="stylesheet" href="../../static/css/switch.css">
  <link rel="stylesheet" href="../../static/css/sign.css">
</head>

<body>

  <div class="auth-container bg-body-tertiary">

    <div class="anti-wiggle d-flex justify-content-center">
      <h2 class="me-1">Sign</h2>
      <label class="switch">
        <input type="checkbox" id="toggle-btn">
        <span class="slider">
        </span>
        <span class="switch-content d-flex justify-content-around">
          <span class=" fw-bolder text-white">in</span>
          <span class=" fw-bolder text-white">up</span>
        </span>
      </label>
    </div>

    <?php
    sign_up_form();
    ?>

    <?php
    sign_in_form();
    ?>

    <?php
    appendix_error();
    ?>

    <div class="control px-4 pb-3">
      <div class="mb-3">
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="dropdownCheck">
          <label class="form-check-label" for="dropdownCheck">
            Remember me
          </label>
        </div>
      </div>
      <div class="d-block d-sm-flex align-items-center">
        <button type="submit" class="btn btn-primary" form="signup-form" id="submit-btn">submit</button>
        <a href="../controller/reset_form.php" class="btn btn-secondary ms-1">Reset</a>

        <a class="btn btn-light mt-1 mt-sm-0 ms-sm-1 remember" id="forget-pass" href="#" style="font-size: .9rem;">Forgot password?</a>
      </div>

    </div>

  </div>
</body>

</html>