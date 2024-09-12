<!DOCTYPE html>
<html lang="en">
<?php require_once 'header.php' ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href=<?= asset('plugins/fontawesome-free/css/all.min.css'); ?>>

    <link rel="stylesheet" href=<?= asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>>

    <link rel="stylesheet" href=<?= asset('dist/css/adminlte.min.css?v=3.2.0') ?>>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href=<?= asset('index2.html') ?>><b>Admin</b>LTE</a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form id="formulariologin" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="login" id="login" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                        </div>

                    </div>
                </form>

                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p>
            </div>

        </div>
    </div>


    <script src=<?= asset('dist/js/login.js') ?>></script>

    <script src=<?= asset('plugins/jquery/jquery.min.js') ?>></script>

    <script src=<?= asset('plugns/bootstrap/js/bootstrap.bundle.min.js') ?>></script>

    <script src=<?= asset('dist/js/adminlte.min.js?v=3.2.0') ?>></script>
</body>

</html>