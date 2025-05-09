<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SignUp Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            height: 100vh;
            background: linear-gradient(135deg, #8bf10d, #95f16a);
        }

        .check-done {
            width: 50px;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center text-center bg-success-subtle">

    <div class="card shadow-lg border-0 p-4" style="max-width: 400px;">
        <div class="card-body">
            <div class="text-success mb-3">
                <svg class="check-done " x="0px" y="0px" viewBox="0 0 24 24" style="fill:#198754">
                    <path d="M23.8,12c0,6.5-5.3,11.8-11.8,11.8S0.2,18.5,0.2,12S5.5,0.2,12,0.2S23.8,5.5,23.8,12 M17.9,7.5c-0.4-0.4-1.1-0.4-1.6,0
       c0,0,0,0,0,0l-5.1,6.5L8.1,11c-0.4-0.4-1.1-0.4-1.6,0.1c-0.4,0.4-0.4,1.1,0,1.5l3.9,3.9c0.4,0.4,1.1,0.4,1.6,0c0,0,0,0,0,0L18,9.1
       C18.4,8.7,18.4,8,17.9,7.5L17.9,7.5z" />
                </svg>
            </div>
            <h4 class="card-title mb-3">Signed in Successfully!</h4>
            <p class="card-text text-muted">You're now signed in to your account.</p>
            <a href="../../index.php?page=home" class="btn btn-success rounded-pill mt-3">Go Back</a>
        </div>
    </div>

    <?php
    require_once('../controller/config_session.php');
    unset($_SESSION['form_data']['signup']);
    unset($_SESSION['form_data']);

    ?>
    <!-- Bootstrap Icons (optional) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>

</html>